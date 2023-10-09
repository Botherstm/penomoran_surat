<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        session();
        $email = $this->request->getPost('email');
        $password = (string)$this->request->getPost('password');
        
        // Cari pengguna berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            // Periksa apakah password sesuai
            if (password_verify($password, $user['password'])) {
                // Buat token unik
                // $token = bin2hex(random_bytes(32));

                // Simpan token ke dalam basis data
                // $data = [
                //     'user_id' => $user['id'],
                //     // 'token' => $token
                // ];
                // $this->userModel->saveToken($user['email'], $token);

                // Set session dengan data pengguna
                $userData = [
                    'user_id' => $user['id'],
                    'instansi_id' => $user['instansi_id'],
                    'bidang_id' => $user['bidang_id'],
                    'slug' => $user['slug'],
                    'nip' => $user['nip'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'no_hp' => $user['no_hp'],
                    'level' => $user['level'],
                ];
                session()->set($userData);

                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        // Hapus data pengguna dari session
        session()->remove(['user_id', 'name', 'email', 'is_admin', 'token']);

        return redirect()->to('/');
    }
}