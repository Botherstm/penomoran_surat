<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use Ramsey\Uuid\Uuid;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class KategoryController extends BaseController
{
    protected $Kategory;
    public function __construct(){
        $this->Kategory = new KategoryModel();
    }

    public function index($dinas_id)
    {
        $categories =$this->Kategory->getByDinasId($dinas_id); // Menggunakan method getByDinasId untuk mencari kategori berdasarkan dinas_id
        $nd = $this->Kategory->getOneByDinasId($dinas_id);
        // dd($nd);
        return view('admin/kategory/index', [
            'categories' => $categories,
            'active' => 'kategory',
            'category' => $dinas_id,
            'nama_dinas' => $nd,
        ]);
    }
    
    public function create($dinas_id)
    {
        $dinass = $this->Kategory->getOneByDinasId($dinas_id);

        return view('admin/kategory/create', [
            'active' => 'kategory',
            'dinass' => $dinass,
  
        ]);
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

        // Cek apakah ada data dengan nama yang sama dan dinas_id yang sama
        $existingCategory = $this->Kategory->where('name', $name)
            ->first();

        if ($existingCategory) {
            // Data dengan nama yang sama sudah ada, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Kategory dengan nama yang sama sudah ada.');
        }

        // Data valid, simpan ke dalam database
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();
        $data = [
            'id' => $uuidString,
            'name' => $name,
            'dinas_id' => $dinas_id,
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