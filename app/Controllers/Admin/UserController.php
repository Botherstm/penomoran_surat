<?php

namespace App\Controllers\Admin;

use App\Models\DinasModel;
use App\Models\UserModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $dinas;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $users = $this->UserModel->getAll();
        return view('admin/users/index', [
            'users' => $users,
            'active' => 'user',
        ]);
    }


    public function create($dinas_id)
    {
  
 

        return view('admin/kategory/create', [
            'active' => 'user',
          
  
        ]);
    }
    public function register()
    {
        $userModel = new UserModel();
            $rules = [
                'NIP' => 'required|integer',
                'name' => 'required',
                'username' => 'required|alpha_numeric|min_length[3]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'instansi_id' => 'required',
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'NIP' => $this->request->getPost('NIP'),
                    'name' => $this->request->getPost('name'),
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'instansi_id' => $this->request->getPost('instansi_id'),
                  
                ];

                dd($userData);
                if ($userModel->save($userData)) {
                    return redirect()->to('/login')->with('success', 'Akun berhasil terdaftar.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        return view('auth/register', $data); // Sesuaikan dengan tampilan pendaftaran Anda
    }
}