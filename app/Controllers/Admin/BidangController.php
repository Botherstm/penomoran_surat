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
        if (session()->get('level') != 2 && session()->get('level') != 3) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        // dd($instansi_id);
        $bidangs = $this->bidang->getAllByInstansiId($instansi_id);


        return view('admin/bidang/index', [

            'bidangs' => $bidangs,
            'active' => 'bidang',
  
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