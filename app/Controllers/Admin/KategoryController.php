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

    public function index($bidang_id)
    {
    
        $data = $this->Kategory->getByBidangId($bidang_id);
        foreach ($data as $kategori) {
            $bidangId = $kategori['bidang_id'];
            $namaBidang[$bidangId] = $this->bidang->getNamaBidangById($bidangId);
        }
        // dd($namaBidang);
        return view('admin/kategory/index', [
            'active' => 'kategory',
            'kategoris'=>$data,
            'namaBidang' => $namaBidang,
        ]);
    }
    
    public function create()
    {
        return view('admin/kategory/create', [
            'active' => 'kategory',
        ]);
    }
    public function created($bidang_id)
    {
       
    }
    

    public function save()
    {
        // Validasi input data
        $rules = [
            'name' => 'required',
            'dinas' => 'required',
            'nomor' => 'required',
            'urutan_surat' => 'required|numeric', 
        ];

        if ($this->validate($rules)) {
            $dinas_id = $this->request->getPost('dinas');
            $name = $this->request->getPost('name');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'name' => $name,
                'bidang_id' => $dinas_id,
                'urutan_surat' => $this->request->getPost('urutan_surat'),
                'nomor' => $this->request->getPost('nomor'),
            ];
    // dd($data);
            $this->Kategory->insert($data);

            return redirect()->to('/admin/kategory/' . $dinas_id)->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
}