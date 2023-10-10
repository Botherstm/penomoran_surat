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
    public function index($kategori_id)
    {
           if (session()->get('level') != 2 && session()->get('level') != 3) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        $data = $this->perihal->getByKategori_id($kategori_id);
        $kat = $this->perihal->getOneByKategoriId($kategori_id);
    // dd($kat);
        return view('admin/perihal/index',[
            'active'=>'perihal',
            'perihals'=>$data,
            'kat'=>$kategori_id,
            'katname'=>$kat
            ]
        );
        
    }

    public function view( )
    {
        return view('admin/perihal/listperihal', [
            'active' => 'perihal',

        ]);
    }

    public function create($kategori_id)
    {
        return view('admin/perihal/create', [
            'active' => 'perihal',
            'kat' => $kategori_id,
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
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'kategori_id' => $kategori_id,
                'kode' => $kode,
                'name' => $name,
            ];
            // dd($data);
            $this->perihal->insert($data);

            return redirect()->to('/admin/perihal/' . $kategori_id)->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
}