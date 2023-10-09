<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Controllers\BaseController;
use App\Models\KategoryModel;
use Ramsey\Uuid\Uuid;

class BidangController extends BaseController
{
    protected $bidang;
    protected $dinas;

    protected $kategori;
    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
    }
    public function index($instansi_id)
    {
        // dd($instansi_id);
        if($instansi_id != null){}
        $dinass = $this->dinas->get_data();
        $data = json_decode($dinass);
        $bidangs = $this->bidang->getAllByInstansiId($instansi_id);
        
        
        $instansiData = []; // Membuat array untuk menyimpan data instansi berdasarkan instansi_id
        // dd($dinass);
        $instansiMap = [];
        foreach ($data->data as $instansi) {
            $instansiMap[$instansi->id_instansi] = $instansi->ket_ukerja;
        }
        $kategories = []; // Membuat array untuk menyimpan data kategori
    
        foreach ($bidangs as $bidang) {
            $kategories[$bidang['id']] = $this->kategori->getByBidangId($bidang['id']);
        }

        return view('admin/bidang/index', [
            'instansiMap' => $instansiMap,
            'bidangs' => $bidangs,
            'active' => 'bidang',
            'instansiData' => $instansiData, // Mengirim data instansi ke tampilan
            'kategories' => $kategories,
        ]);
    }

    
    public function create()
    {
        $dinass = $this->dinas->get_data();
        $data['dinass'] = json_decode($dinass)->data; // Mendapatkan data dari API dan mengkonversinya menjadi array
         
        return view('admin/bidang/create', [
            'active' => 'bidang',
            'dinass' => $data['dinass'], // Mengirim data dinas ke view
        ]);
    }

    

    public function save()
    {
        // Validasi input data
        $validationRules = [
            'instansi_id' => 'required',
            'kode' => 'required',
            'name' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        
        // Ambil data dari input form
        $name = $this->request->getPost('name');
        $instansi_id = $this->request->getPost('instansi_id');
        $kode = $this->request->getPost('kode');
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();
        // Simpan data ke dalam database
        $data = [
            'id'=>$uuidString,
            'instansi_id' => $instansi_id,
            'kode' => $kode,
            'name' => $name
        ];
  
        $this->bidang->insert($data);
    
        return redirect()->to('/admin/bidang')->with('success', 'Data Bidang berhasil disimpan');
    }
}