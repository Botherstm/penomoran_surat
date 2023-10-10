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
        return view('login',[
             'validation' => \Config\Services::validation()
        ]);
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
        session()->remove(['user_id','instansi_id','bidang_id','slug', 'nip', 'name', 'email', 'no_hp', 'level']);
        return redirect()->to('/');
    }
}