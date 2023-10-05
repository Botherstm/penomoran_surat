<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use Ramsey\Uuid\Uuid;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;
use App\Models\PerihalModel;

class KategoryController extends BaseController
{
    protected $Kategori;
    protected $perihal;
    public function __construct(){
        $this->Kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
    }

    public function index()
    {
        $kategori = $this->Kategori->getAll();
        // $perihal = $this->perihal->g();
        // dd($kategori);
        return view('admin/kategory/index', [
            'active' => 'kategory',
            'kategories' => $kategori,
        ]);
    }
    
    public function create()
    {
        return view('admin/kategory/create', [
            'active' => 'kategory',
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $slug = $this->request->getPost('slug');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
    // dd($data);
            $this->Kategori->insert($data);
            return redirect()->to('/admin/kategory')->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
}