<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use Ramsey\Uuid\Uuid;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class KategoryController extends BaseController
{
    protected $Kategory;
    protected $bidang;
    public function __construct(){
        $this->Kategory = new KategoryModel();
        $this->bidang = new BidangModel();
    }

    public function index() 
    {
        // if (session()->get('level') != 2 && session()->get('level') != 3) {
        //     // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $data = $this->Kategory->getAll();
        // dd($data);
        return view('admin/kategori/index', [
            'active' => 'kategory',
            'kategoris' => $data,

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
            return redirect()->back()->withInput()->with('validation', $this->validator);
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
                ->withInput()
                ->with('validationErrors', $validation->getErrors());
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