<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/tasks');
        }

        $data['title'] = 'Login';
        return view('login_page', $data);
    }

        public function attemptLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        // Automatically hash plain-text password on first login
        if ($user && $password === $user['password']) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $userModel->update($user['id'], ['password' => $hashed]);
            $user['password'] = $hashed;
        }

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'full_name'  => $user['full_name'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/tasks');
        }

        return redirect()->to('/login')->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
