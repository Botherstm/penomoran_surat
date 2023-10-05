<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use Ramsey\Uuid\Uuid;

class PerihalController extends BaseController
{

    protected $Kategori;
    protected $perihal;
    public function __construct(){
        $this->Kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
    }
    public function index($slug)
    {
        $kategori = $this->Kategori->findBySlug($slug);
        if (!$kategori) {
            // Handle jika kategori tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        $perihals = $this->perihal->getAllByKategoriId($kategori['id']);

        return view('admin/perihal/index',[
            'active'=>'perihal',
            'perihals'=>$perihals,
            'kategori'=>$kategori,
        ],
        );
        
    }

    public function create($slug)
    {
        $kategori = $this->Kategori->findBySlug($slug);
        if (!$kategori) {
            // Handle jika kategori tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        return view('admin/perihal/create', [
            'active' => 'perihal',
            'kategori'=>$kategori,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'kategori_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $kategori_id = $this->request->getPost('kategori_id');
            $slug = $this->request->getPost('slug');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'kategori_id' => $kategori_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
            // dd($data);
            $this->perihal->insert($data);

            $kategori = $this->Kategori->findByid($kategori_id);
            return redirect()->to('/admin/perihal/'.$kategori['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function getPerihalByCategory($categoryId)
    {
        // Query database untuk mengambil data "Perihal" berdasarkan kategori
        $perihals = $this->perihal->getAllByKategoriId($categoryId);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($perihals as $perihal) {
            $response[] = [
                'id' => $perihal['id'],
                'name' => $perihal['name'],
                'kode' => $perihal['kode'],
            ];
        }

        // Kembalikan data sebagai respons JSON
        return $this->response->setJSON($response);
    }
}