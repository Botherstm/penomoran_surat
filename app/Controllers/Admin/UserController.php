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

        if (!session()->has('user_id')) {
            $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
        // dd($siteKey);
        return view('login',[
             'validation' => \Config\Services::validation(),
             'key'=> $siteKey
        ]);
        }

        if (session()->get('level') == 2) {
            $users = $this->UserModel->getAllSuperAdmin();
            $dinas = [];
            $dinas = $this->dinas->getAll();
            foreach ($users as $user) {
                $userId = $user['instansi_id'];
                $dinas[$userId] = $this->dinas->getById($userId);
            }
            //bidang
            $bidangs = [];
            $bidang = $this->bidangs->getAll();
            foreach ($users as $user) {
                $userId = $user['bidang_id'];
                $bidang = $this->bidangs->getById($userId);
                $bidangs[$userId] = $bidang;
            }
        } elseif (session()->get('level') == 1) {
            $users = $this->UserModel->getAdminByInstansi(session()->get('instansi_id'));
            //bidang
            $bidangs = [];
            $bidang = $this->bidangs->getAll();
            foreach ($users as $user) {
                $userId = $user['bidang_id'];
                $bidang = $this->bidangs->getById($userId);
                $bidangs[$userId] = $bidang;
            }
           $dinas = $this->dinas->getById(session()->get('instansi_id'));
        }

        // $dinass = $this->dinas->getAll();
        // dd($bidangs,session()->get('instansi_id'),$users);
        return view('admin/users/index', [
            'users' => $users,
            'bidangs' => $bidangs,
            'active' => 'user',
            'dinas' => $dinas,
            // 'dinass' => $dinass,
        ]);
    }


    public function create()
    {
        $instansis = $this->dinas->getAll();
        $bidangs = $this->bidangs->getAllByInstansiId(session()->get('instansi_id'));
        $users = $this->UserModel->getAll();
        // dd($bidangs);
        return view('admin/users/create', [
            'active' => 'user',
            'users' => $users,
            'instansis' => $instansis,
            'bidangs' => $bidangs,
        ]);
    }

    public function save()
    {
        $rules = [
            'instansi_id' => 'required',
            'no_hp' => 'required|integer',
            'slug' => 'required|is_unique[users.slug]',
            'name' => 'required|is_unique[users.name]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (session()->get('level') == 2) {
            $level = $this->request->getPost('level');
        } else {
            $level = 0;
        }
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();
        if ($this->validate($rules)) {
            $userData = [
                'id' => $uuidString,
                'instansi_id' => $this->request->getPost('instansi_id'),
                'bidang_id' => $this->request->getPost('bidang_id'),
                'slug' => $this->request->getPost('slug'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $level,
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            // dd($userData);
            $this->UserModel->insert($userData);
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil terdaftar.');
        } else {
            return redirect()->back()->with('error', 'Data Sudah Terdaftar');
        }
    }

    public function edit($slug)
    {
        $user = $this->UserModel->getBySlug($slug);
        $instansi = $this->dinas->getAllById($user['instansi_id']);
        $instansis = $this->dinas->getAll();
        $bidang = $this->bidangs->getById($user['bidang_id']);
        $bidangs = $this->bidangs->getAll();
        // dd($instansi);
        return view('admin/users/edit', [
            'active' => 'user',
            'user' => $user,
            'instansi' => $instansi,
            'instansis' =>$instansis,
            'bidang' => $bidang,
            'bidangs' => $bidangs,
        ]);
    }

    public function update($id)
    {
        $rules = [
            'instansi_id' => 'required',
            'name' => 'required',
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
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
            ];

            // dd($userData);

            $this->UserModel->update($id, $userData);
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil Di Update !');
        } else {
            return redirect()->back()->with('error', 'ada kesalahan periksa kembali data!');
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