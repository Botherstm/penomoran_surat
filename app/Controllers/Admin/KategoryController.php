<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use Ramsey\Uuid\Uuid;

class KategoryController extends BaseController
{
    protected $Kategory;
    protected $perihal;
    public function __construct()
    {
        $this->Kategory = new KategoryModel();
        $this->perihal = new PerihalModel();
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
        if (session()->get('level') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $kategoris = $this->Kategory->getAll();

        $perihals = [];
        foreach ($kategoris as $kategori) {
            $kategoriId = $kategori['id'];
            $perihalData = $this->perihal->getByKategori_id($kategoriId);
            $perihals[$kategoriId] = $perihalData;
        }
        // dd($perihals);
        return view('admin/kategori/index', [
            'active' => 'kategory',
            'kategoris' => $kategoris,
            'perihals' => $perihals,
        ]);
    }

    public function create()
    {
        return view('admin/kategori/create', [
            'active' => 'kategory',
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        if ($this->validate($rules)) {
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            $slug = $this->request->getPost('slug');
            if ($this->perihal->where('kode', $kode)->first()) {
                return redirect()->back()->with('error', 'Data Sudah terdaftar');
            }

            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'name' => $name,
                'kode' => $kode,
                'slug' => $slug,
            ];
            // dd($data);
            $this->Kategory->insert($data);

            return redirect()->to(base_url('/admin/kategori'))->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }

    public function edit($slug)
    {
        $kategoris = $this->Kategory->getBySlug($slug);
        // dd($instansi);
        return view('admin/kategori/edit', [
            'active' => 'user',
            'kategori' => $kategoris,
        ]);
    }

    public function update($id)
    {
        // Validasi input form
        $rules = [
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        $validation = \Config\Services::validation(); // Mendapatkan instance validasi

        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $kategoriData = [
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($kategoriData);
            // Simpan data pengguna ke dalam database
            $this->Kategory->update($id, $kategoriData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to(base_url('/admin/kategori'))->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->with('validationErrors', 'periksa apakah data sudah terisi dengan benar');
        }
    }

    public function delete($slug)
    {
        // Cari data album berdasarkan ID
        $data = $this->Kategory->getBySlug($slug);
        $kategori = $this->Kategory->find($data['id']);
        // dd($kategori);
        if ($kategori) {
            $this->Kategory->delete($data['id']);
            return redirect()->to(base_url('admin/kategori'))->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to(base_url('admin/kategori'))->with('error', 'data not found.');
        }
    }
}
