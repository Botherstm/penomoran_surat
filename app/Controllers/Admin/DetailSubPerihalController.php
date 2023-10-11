<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;

use App\Models\DetailSubPerihalModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use Ramsey\Uuid\Uuid;

class DetailSubPerihalController extends BaseController
{

    protected $perihal;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct(){
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel;
    }
    public function index($slug)
    {
        $subperihal = $this->subperihal->getBySlug($slug);
        // dd($slug);
        if (!$subperihal) {
            // Handle jika detailsubperihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        $detailsubperihal = $this->detailsubperihal->getAllBySubPerihalId($subperihal['id']);
        $perihal = $this->perihal->getById($subperihal['perihal_id']);
        // dd($detailsubperihal);
        return view('admin/detailsubperihal/index',[
            'active'=>'detailsubperihal',
            'perihal'=>$perihal,
            'subperihal'=>$subperihal,
            'detailsubperihals'=>$detailsubperihal,
        ],
        );
        
    }

    public function view()
    {
        return view('admin/detailsubperihal/listdetailsubperihal', [
            'active' => 'detailsubperihal',
        ]);
    }

    public function create($slug)
    {
        // dd($slug);
        $subperihal = $this->subperihal->getBySlug($slug);
        if (!$subperihal) {
            // Handle jika detailsubperihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        return view('admin/detailsubperihal/create', [
            'active' => 'detailsubperihal',
            'subperihal'=>$subperihal,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'subperihal_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $subperihal_id = $this->request->getPost('subperihal_id');
            $slug = $this->request->getPost('slug');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $subperihal = $this->subperihal->getByid($subperihal_id);
            $data = [
                'id' => $uuidString,
                'subperihal_id' => $subperihal_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
    // dd($data);
            $this->detailsubperihal->insert($data);

         
            return redirect()->to('/admin/kategori/perihal/subperihal/detailsubperihal/'.$subperihal['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }


     public function edit($slug)
    {
        $detailsubperihal = $this->detailsubperihal->getBySlug($slug);
        $subperihal = $this->subperihal->getById($detailsubperihal['subperihal_id']);
        // dd($detailsubperihal,$subperihal);
        return view('admin/detailsubperihal/edit', [
            'active' => 'user',
            'subperihal' => $subperihal,
            'detailsubperihal' => $detailsubperihal,
        ]);
    }

    public function update($id)
    {
        // Validasi input form
        $rules = [
            'subperihal_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        $validation = \Config\Services::validation(); // Mendapatkan instance validasi

        if ($this->validate($rules)) {
            $subperihal = $this->request->getPost('subperihal_id');
            $data = $this->subperihal->getById($subperihal);
            // Data pengguna yang akan disimpan
            $detailsubperihalData = [
                'subperihal_id' => $subperihal,
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($detailsubperihalData, $data);
            // Simpan data pengguna ke dalam database
            $this->detailsubperihal->update($id, $detailsubperihalData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to('/admin/kategori/perihal/subperihal/detailsubperihal/'. $data['slug'])->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->withInput()
                ->with('validationErrors', $validation->getErrors());
        }
    }

    public function delete($slug)
    {
        // Cari data album berdasarkan ID
        
        $data = $this->detailsubperihal->getBySlug($slug);
        $detailsubperihal = $this->detailsubperihal->find($data['id']);
        $subperihal = $this->subperihal->getById($detailsubperihal['subperihal_id']);
        // dd($subperihal);
        if ($detailsubperihal) {
          $this->detailsubperihal->delete($data['id']);
            return redirect()->to('admin/kategori/perihal/subperihal/detailsubperihal/'. $subperihal['slug'])->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to('admin/kategori/perihal/subperihal/detailsubperihal'. $subperihal['slug'])->with('error', 'data not found.');
        }
    }
}