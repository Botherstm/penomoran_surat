<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\UserModel;
use Intervention\Image\ImageManagerStatic as Image;
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
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            return redirect()->to('/admin');
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
        $id = $this->request->getPost('id');
        $user = $this->UserModel->getById($id);
        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password');

        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'no_hp' => 'required|integer',
            'email' => 'required|valid_email',
        ];

        // Tambahkan aturan validasi untuk password lama jika mengubah password
        if (!empty($password_baru)) {
            $rules['password_lama'] = 'required';
        }
        // dd($user['password']);
        // Lakukan validasi formulir
        if ($this->validate($rules)) {
            // Periksa apakah password baru disediakan dan verifikasi password lama
            if (!empty($password_baru)) {
                if (password_verify($password_lama, $user['password'])) {
                    $userData = [
                        'slug' => $this->request->getPost('slug'),
                        'name' => $this->request->getPost('name'),
                        'email' => $this->request->getPost('email'),
                        'no_hp' => $this->request->getPost('no_hp'),
                        'password' => password_hash($password_baru, PASSWORD_DEFAULT), // Hash password baru
                    ];
                    $this->UserModel->update($id, $userData);
                    return redirect()->to('/public/user/profile')->with('success', 'Akun berhasil Di Update !');
                } else {
                    return redirect()->back()->with('error', 'Password lama salah');
                }
            } else {
                // Jika tidak mengubah password, perbarui informasi pengguna lainnya
                $userData = [
                    'slug' => $this->request->getPost('slug'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'no_hp' => $this->request->getPost('no_hp'),
                ];
                $this->UserModel->update($id, $userData);
                return redirect()->to('/public/user/profile')->with('success', 'Akun berhasil Di Update !');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email atau password tidak valid');
        }
    }







    public function updateGambar()
    {

        $userData = session()->get();

        $id = $this->request->getPost('id');
        $gambar = $this->request->getFile('gambar');

        if (!$gambar !== null) {
            $user = $this->UserModel->find($id);
            $gambarLama = $user['gambar'];
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $namaGambar = $uuidString . $gambar->getClientName();
            $gambar->move(ROOTPATH . 'public/userimage', $namaGambar);
            $gambarPath = ROOTPATH . 'public/userimage/' . $namaGambar;
            $image = Image::make($gambarPath);
            $ukuran = 500;
            $image->fit($ukuran, $ukuran);
            $image->save($gambarPath);
            if (!empty($gambarLama)) {
                $gambarLamaPath = ROOTPATH . 'public/userimage/' . $gambarLama;
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }

            $userData['gambar'] = $namaGambar;
            $user = [
                'gambar' => $namaGambar,
            ];
            session()->set($userData);
            $this->UserModel->update($id, $user);
        } else {
            return redirect()->back()->with('error', 'pastikan gambar anda tidak melebihi 10 mb');
        }

        return redirect()->to('/public/user/profile')->with('success', 'Akun Gambar Berhasil di Ganti !');
    }
    public function deleteGambar()
    {

        $userData = session()->get();

        $id = $this->request->getPost('id');
        $user = $this->UserModel->find($id);
        $gambarLama = $user['gambar'];

        if (!empty($gambarLama)) {
            $gambarLamaPath = ROOTPATH . 'public/userimage/' . $gambarLama;
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $userData['gambar'] = null;
        $user = [
            'gambar' => null,
        ];
        session()->set($userData);
        $this->UserModel->update($id, $user);

        return redirect()->to('/public/user/profile')->with('success', 'data gambar berhasil dihapus');
    }
}
