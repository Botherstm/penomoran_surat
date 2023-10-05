<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Controllers\BaseController;
use Ramsey\Uuid\Uuid;

class BidangController extends BaseController
{
    protected $bidang;
    protected $instansi;

    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->instansi = new DinasModel();
    }
    public function index($instansi_id)
    {
        $bidangs = $this->bidang->getByInstansiId($instansi_id);
        $instansi = $this->instansi->get_one_instansi_by_id($instansi_id);
        return view('admin/bidang/index', [
            'bidangs' => $bidangs,
            'active' => 'bidang',
            'instansi' => $instansi, // Mengirim data instansi ke tampilan
        ]);
    }

    
    public function create($instansi_id)
    {
        $instansi = $this->instansi->get_one_instansi_by_id($instansi_id);
        return view('admin/bidang/create', [
            'active' => 'bidang',
            'instansi' =>$instansi, // Mengirim data instansi ke view
        ]);
    }

    

    public function save()
    {
        // Validasi input data
        $validationRules = [
            'instansi_id' => 'required',
            'slug' => 'required',
            'kode' => 'required',
            'name' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        
        // Ambil data dari input form
        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug');
        $instansi_id = $this->request->getPost('instansi_id');
        $kode = $this->request->getPost('kode');
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();
        // Simpan data ke dalam database
        $data = [
            'id'=>$uuidString,
            'instansi_id' => $instansi_id,
            'kode' => $kode,
            'name' => $name,
            'slug' => $slug
        ];
        
        // dd($data);
        $this->bidang->insert($data);
    
        return redirect()->to('/admin/bidang/'.$instansi_id)->with('success', 'Data Bidang berhasil disimpan');
    }
}