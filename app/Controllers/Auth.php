<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('customers'));
        }
        return view('auth/login');
    }

    public function authenticate()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = $userModel
            ->where('username', $username)
            ->first();

        if ($user === null || ! password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Incorrect username or password.');
        }

        session()->regenerate(true);

        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'isLoggedIn' => true
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Login successful.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}