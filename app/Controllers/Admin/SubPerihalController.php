<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;
use App\Models\DetailSubPerihalModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use Ramsey\Uuid\Uuid;

class SubPerihalController extends BaseController
{
    protected $kategori;
    protected $perihal;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct(){
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }
    public function index($slug)
    {
        $perihal = $this->perihal->getBySlug($slug);
        // if (!$perihal) {
        //     // Handle jika perihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
        //     return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        // }
        $subperihals = $this->subperihal->getAllByPerihalId($perihal['id']);
        $kategori = $this->kategori->getById($perihal['kategori_id']);
        $detailSubPerihals = [];

        foreach ($subperihals as $subperihal) {
                $subPerihalId = $subperihal['id'];
                $detailSubPerihal = $this->detailsubperihal->getAllBySubPerihalId($subPerihalId);
                $detailSubPerihals[$subPerihalId] = $detailSubPerihal;
            }
   
        // dd($detailSubPerihals);

        return view('admin/subperihal/index',[
            'active'=>'subperihal',
            'subperihals'=>$subperihals,
            'perihal'=>$perihal,
            'kategori'=>$kategori,
            'detailsubperihals'=>$detailSubPerihals
        ],
        );
    }


    public function create($slug)
    {
        $perihal = $this->perihal->getBySlug($slug);
        return view('admin/subperihal/create', [
            'active' => 'subperihal',
            'perihal'=>$perihal,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'detail_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $detail_id = $this->request->getPost('detail_id');
            $slug = $this->request->getPost('slug');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $perihal = $this->perihal->getById($detail_id);
            $data = [
                'id' => $uuidString,
                'detail_id' => $detail_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
    // dd($data);
            $this->subperihal->insert($data);

         
            return redirect()->to('/admin/kategori/perihal/subperihal/'.$perihal['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function edit($slug)
    {
        $subperihal = $this->subperihal->getBySlug($slug);
        $perihal = $this->perihal->getById($subperihal['detail_id']);
        // dd($subperihal,$perihal);
        return view('admin/subperihal/edit', [
            'active' => 'user',
            'perihal' => $perihal,
            'subperihal' => $subperihal,
        ]);
    }


    public function update($id)
    {
        // Validasi input form
        $rules = [
            'detail_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        $validation = \Config\Services::validation(); // Mendapatkan instance validasi

        if ($this->validate($rules)) {
            $perihal = $this->request->getPost('detail_id');
            $data = $this->perihal->getById($perihal);
            // Data pengguna yang akan disimpan
            $subperihalData = [
                'detail_id' => $perihal,
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($subperihalData);
            // Simpan data pengguna ke dalam database
            $this->subperihal->update($id, $subperihalData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to('/admin/kategori/perihal/subperihal/'. $data['slug'])->with('success', 'Data berhasil Di Update !');
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
        
        $data = $this->subperihal->getBySlug($slug);
        $subperihal = $this->subperihal->find($data['id']);
        $perihal = $this->perihal->getById($subperihal['detail_id']);
        // dd($perihal);
        if ($subperihal) {
          $this->subperihal->delete($data['id']);
            return redirect()->to('admin/kategori/perihal/subperihal/'. $perihal['slug'])->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to('admin/kategori/perihal/subperihal'. $perihal['slug'])->with('error', 'data not found.');
        }
    }

}