<?php

namespace App\Controllers\Admin;

use App\Models\DinasModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;
use App\Models\BidangModel;

class UserController extends BaseController
{
    protected $dinas;
    protected $bidangs;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->dinas = new DinasModel();
        $this->bidangs = new BidangModel();
    }

    public function index()
    {



        if (session()->get('level') == 2) {
            $users = $this->UserModel->getAll();

            //bidang
            $bidangs = [];
            $bidang = $this->bidangs->getAll();
            foreach ($users as $user) {
                $userId = $user['bidang_id'];
                $bidang = $this->bidangs->getById($userId);
                $bidangs[$userId] = $bidang;
            }
        } elseif (session()->get('level') == 1) {
            $users = $this->UserModel->getByInstansiId(session()->get('instansi_id'));
            //bidang
            $bidangs = [];
            $bidang = $this->bidangs->getAll();
            foreach ($users as $user) {
                $userId = $user['bidang_id'];
                $bidang = $this->bidangs->getById($userId);
                $bidangs[$userId] = $bidang;
            }
        }
        // dd($bidangs);
        return view('admin/users/index', [
            'users' => $users,
            'bidangs' => $bidangs,
            'active' => 'user',
        ]);
    }


    public function create()
    {
        $instansis = $this->dinas->getAll();
        $bidangs = $this->bidangs->findAll();
        $users = $this->UserModel->getAll();
        return view('admin/users/create', [
            'active' => 'user',
            'users' => $users,
            'instansis' => $instansis,
            'bidangs' => $bidangs,
        ]);
    }

    public function save()
    {
        // Aturan validasi
        $rules = [
            'instansi_id' => 'required',
            'bidang_id' => 'required',
            'nip' => 'required|integer|is_unique[users.nip]',
            'no_hp' => 'required|integer',
            'slug' => 'required|is_unique[users.slug]',
            'name' => 'required|is_unique[users.name]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (session()->get('level') == 2) {
            $level = 1;
        } else {
            $level = 0;
        }
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();
        // Lakukan validasi
        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $userData = [
                'id' => $uuidString,
                'instansi_id' => $this->request->getPost('instansi_id'),
                'bidang_id' => $this->request->getPost('bidang_id'),
                'slug' => $this->request->getPost('slug'),
                'nip' => $this->request->getPost('nip'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $level,
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            // dd($userData);
            // Simpan data pengguna ke dalam database
            $this->UserModel->insert($userData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil terdaftar.');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
    }

    public function edit($slug)
    {
        $user = $this->UserModel->getBySlug($slug);
        $instansi = $this->dinas->get_instansi_by_id($user['instansi_id']);
        $instansis = $this->dinas->get_data();
        $bidang = $this->bidangs->getById($user['bidang_id']);
        $bidangs = $this->bidangs->getAll();
        // dd($instansi);
        return view('admin/users/edit', [
            'active' => 'user',
            'user' => $user,
            'instansi' => $instansi,
            'instansis' => json_decode($instansis),
            'bidang' => $bidang,
            'bidangs' => $bidangs,
        ]);
    }

    public function update($id)
    {
        // Validasi input form
        $rules = [
            'instansi_id' => 'required',
            'bidang_id' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'nip' => 'required|integer',
            'no_hp' => 'required|integer',
            'email' => 'required|valid_email',
        ];

        $validation = \Config\Services::validation(); // Mendapatkan instance validasi

        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $userData = [
                'instansi_id' => $this->request->getPost('instansi_id'),
                'bidang_id' => $this->request->getPost('bidang_id'),
                'slug' => $this->request->getPost('slug'),
                'nip' => $this->request->getPost('nip'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
            ];

            // dd($userData);

            $this->UserModel->update($id, $userData);


            return redirect()->to('/admin/users')->with('success', 'Akun berhasil Di Update !');
        } else {
            return redirect()->back()

                ->with('error', 'ada kesalahan periksa kembali data!');
        }
    }
    public function delete($slug)
    {
        // Cari data album berdasarkan ID
        $data = $this->UserModel->getBySlug($slug);
        $user = $this->UserModel->find($data['id']);
        // dd($user);
        if ($user) {
            $this->UserModel->delete($data['id']);
            return redirect()->to('admin/users')->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to('admin/users')->with('error', 'data not found.');
        }
    }


    public function profile()
    {
        return view('public/user/profil/index');
    }
}
