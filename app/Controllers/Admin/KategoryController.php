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
    $data = $this->Kategory->getAll();

    return view('admin/kategory/index', [
        'active' => 'kategory',
        'kategoris' => $data,

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
            'bidang_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $bidang_id = $this->request->getPost('bidang_id');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'name' => $name,
                'bidang_id' => $bidang_id,
                'kode' => $kode,
            ];
    // dd($data);
            $this->Kategory->insert($data);

            return redirect()->to('/admin/kategory/' . $bidang_id)->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
}