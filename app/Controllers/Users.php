<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;           

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $data = [
            'users' => $userModel->findAll()
        ];

        return view('users/index', $data);
    }

    public function new(): string
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[8]|max_length[255]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'password'  => password_hash(
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

        $rules = [
            'username' => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]'
        ];

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
                    'max_size' => 'The profile picture must not exceed 2 MB.',
                    'mime_in' => 'The profile picture must be a JPG or PNG image.',
                    'ext_in' => 'The profile picture must use a JPG, JPEG, or PNG extension.'
                ]
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name'))
        ];

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