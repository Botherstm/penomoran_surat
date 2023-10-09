<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisterController extends BaseController
{

    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();

    }
    public function index()
    {
        //
    }

   public function save()
{
    $userModel = new UserModel();

    // Aturan validasi
    $rules = [
        'NIP' => 'required|integer',
        'slug' => 'required',
        'name' => 'required',
        'username' => 'required|alpha_numeric|min_length[3]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'instansi_id' => 'required',
        'bidang_id' => 'required',
    ];

    // Lakukan validasi
    if ($this->validate($rules)) {
        // Data pengguna yang akan disimpan
        $userData = [
            'instansi_id' => $this->request->getPost('instansi_id'),
            'bidang_id' => $this->request->getPost('bidang_id'),
            'slug' => $this->request->getPost('slug'),
            'nip' => $this->request->getPost('nip'),
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
            dd();
        // Simpan data pengguna ke dalam database
        $userModel->insert($userData);

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->to('/admin/user')->with('success', 'Akun berhasil terdaftar.');
    } else {
        // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }
}
}