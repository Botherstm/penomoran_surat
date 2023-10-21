<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class UserController extends BaseController
{
    protected $dinas;
    protected $bidang;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->dinas = new DinasModel();
        $this->bidang = new BidangModel();
    }

    public function index()
    {

        if (!session()->has('user_id')) {
            $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
            // dd($siteKey);
            return view('login', [
                'validation' => \Config\Services::validation(),
                'key' => $siteKey,
            ]);
        }
        $user = $this->UserModel->getByid(session()->get('user_id'));
        $dinas = $this->dinas->getById($user['instansi_id']);
        $bidang = $this->bidang->getById($user['bidang_id']);
        // dd($bidangs,session()->get('instansi_id'),$users);
        // dd($user, $dinas, $bidang);
        return view('public/user/index', [
            'user' => $user,
            'bidang' => $bidang,
            'active' => 'user',
            'dinas' => $dinas,

        ]);
    }

    public function update()
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'no_hp' => 'required|integer',
            'email' => 'required|valid_email',
        ];
        $id = $this->request->getFile('id');

        $gambar = $this->request->getFile('gambar');

        if (!$gambar !== null) {
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();

            $namaGambar = $uuidString . $gambar->getClientName();
            $gambar->move(ROOTPATH . 'public/img', $namaGambar);
        }
        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $userData = [
                'slug' => $this->request->getPost('slug'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'gambar' => $namaGambar,
                'no_hp' => $this->request->getPost('no_hp'),
            ];
            $this->UserModel->update($id, $userData);
            return redirect()->to('/public/user/profile')->with('success', 'Akun berhasil Di Update !');
        } else {
            return redirect()->back()->with('error', 'ada kesalahan periksa kembali data!');
        }
    }
    public function updateGambar()
    {

        $userData = session()->get();

        $id = $this->request->getPost('id');
        $gambar = $this->request->getFile('gambar');

        if (!$gambar !== null) {
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();

            $namaGambar = $uuidString . $gambar->getClientName();
            // $gambar->move(ROOTPATH . 'public/img', $namaGambar);
            $userData['gambar'] = $namaGambar;
            session()->set($userData);
            $this->UserModel->where('id', $id)->update(['gambar' => $namaGambar]);
        } else {
            return redirect()->back()->with('error', 'pastikan gambar anda tidak melebihi 10 mb');
        }

        return redirect()->to('/public/user/profile')->with('success', 'Akun Gambar Berhasil di Ganti !');

    }
}