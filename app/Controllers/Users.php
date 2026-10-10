<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        return view('users/index', [
            'users' => $userModel->findAll()
        ]);
    }

    public function new(): string
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => [
                    'required',
                    'max_length[50]',
                    'is_unique[users.username]'
                ]
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => [
                    'required',
                    'max_length[100]'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => [
                    'required',
                    'min_length[8]',
                    'max_length[255]'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'password' => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            )
        ]);

        return redirect()->to(site_url('users'))
            ->with('success', 'User added successfully.');
    }

    public function edit(int $id): string
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User record not found.'
            );
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound(
                'User record not found.'
            );
        }

        $newPassword = (string) $this->request->getPost(
            'password'
        );

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => [
                    'required',
                    'max_length[50]',
                    "is_unique[users.username,id,{$id}]"
                ]
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => [
                    'required',
                    'max_length[100]'
                ]
            ]
        ];

        /*
         * Only validate password fields when the user enters
         * a new password.
         */
        if ($newPassword !== '') {
            $rules['password'] = [
                'label' => 'New password',
                'rules' => [
                    'required',
                    'min_length[8]',
                    'max_length[255]'
                ]
            ];

            $rules['password_confirm'] = [
                'label' => 'Confirm password',
                'rules' => [
                    'required',
                    'matches[password]'
                ]
            ];
        }

        $avatar = $this->request->getFile('avatar');

        $hasAvatar = $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasAvatar) {
            $rules['avatar'] = [
                'label' => 'Profile picture',
                'rules' => [
                    'uploaded[avatar]',
                    'max_size[avatar,2048]',
                    'mime_in[avatar,image/jpeg,image/png]',
                    'ext_in[avatar,jpg,jpeg,png]'
                ],
                'errors' => [
                    'max_size' =>
                        'The profile picture must not exceed 2 MB.',
                    'mime_in' =>
                        'The profile picture must be a JPG or PNG image.',
                    'ext_in' =>
                        'The profile picture must use a JPG, JPEG, or PNG extension.'
                ]
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => trim(
                (string) $this->request->getPost('username')
            ),
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            )
        ];

        /*
         * If no password was entered, the existing password
         * remains unchanged.
         */
        if ($newPassword !== '') {
            $data['password'] = password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );
        }

        if ($hasAvatar) {
            $uploadPath = FCPATH . 'uploads/avatars';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            $newName = $avatar->getRandomName();
            $avatar->move($uploadPath, $newName);

            service('image')
                ->withFile($uploadPath . '/' . $newName)
                ->fit(300, 300, 'center')
                ->save($uploadPath . '/' . $newName);

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to(site_url('users'))
            ->with('success', 'User updated successfully.');
    }
}