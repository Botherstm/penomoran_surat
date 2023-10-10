<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use Ramsey\Uuid\Uuid;

class PerihalController extends BaseController
{


    protected $Kategory;
    protected $perihal;
    public function __construct(){
        $this->Kategory = new KategoryModel();
        $this->perihal = new PerihalModel();
    }
    public function index($slug)
    {
           if (session()->get('level') != 2 && session()->get('level') != 3) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        $kat = $this->Kategory->getBySlug($slug);
        $kategori = $this->perihal->getOneByKategoriId($kat['id']);
        $perihals = $this->perihal->getByKategori_id($kat['id']);

        return view('admin/perihal/index',[
            'active'=>'perihal',
            'perihals'=>$perihals,
            'kategori'=>$kategori,
            ]
        );
        
    }


    public function create($slug)
    {
         $kat = $this->Kategory->getBySlug($slug);
        //  dd($kat);
        return view('admin/perihal/create', [
            'active' => 'perihal',
            'kategori' => $kat,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'kategori_id' => 'required',
            'kode' => 'required',
            'name' => 'required',
        ];

        if ($this->validate($rules)) {
            $kategori_id = $this->request->getPost('kategori_id');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            $slug = $this->request->getPost('slug');
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'kategori_id' => $kategori_id,
                'kode' => $kode,
                'name' => $name,
                'slug' => $slug,
            ];
            // dd($data);
            $this->perihal->insert($data);
            $kategori = $this->Kategory->getById($kategori_id);
            return redirect()->to('/admin/perihal/' . $kategori['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function tambahperihal()
    {
        return view('admin/perihal/tambahperihal');
    }
    
    public function editperihal()
    {
        return view('admin/perihal/editperihal');
    }
}