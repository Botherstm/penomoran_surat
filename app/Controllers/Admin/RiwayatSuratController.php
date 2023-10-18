<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\GenerateModel;
use App\Models\SubPerihalModel;
use App\Models\UrutanSuratModel;
use Ramsey\Uuid\Uuid;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;
use App\Models\PerihalModel;
use App\Models\UserModel;

class RiwayatSuratController extends BaseController
{
    protected $user;
    protected $generate;
    protected $urutan;
    protected $bidangs;
    protected $dinas;
    protected $perihal;
    protected $kategori;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
        $this->urutan = new UrutanSuratModel();
        $this->bidangs = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }

    public function index() 
    {


        $generate = $this->generate->getAllByInstansi_id(session()->get('instansi_id'));
            $users = [];
            foreach ($generate as $gen) {
                $userId = $gen['user_id'];
                $user = $this->user->getById($userId);
                $users[$userId] = $user;
            }
        // dd($users);
            $bidangs = [];
            foreach ($generate as $gen) {
                $bidangId = $gen['bidang_id'];
                $bidang = $this->bidangs->getById($bidangId);
                $bidangs[$bidangId] = $bidang;
            }
        // dd($bidangs);

        return view('admin/riwayatsurat/index', [
            'active' => 'riwayatsurat',
            'riwayats' => $generate,
            'users' => $users,
            'bidangs' => $bidangs,
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

            return redirect()->to('/admin/kategori')->with('success', 'Data Kategory berhasil disimpan.');
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
            return redirect()->to('/admin/kategori')->with('success', 'Data berhasil Di Update !');
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
            return redirect()->to('admin/kategori')->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to('admin/kategori')->with('error', 'data not found.');
        }
    }


}