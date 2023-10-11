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
        $perihal = $this->perihal->getById($subperihal['detail_id']);
        // dd($detailsubperihal);
        return view('admin/detailsubperihal/index',[
            'active'=>'detailsubperihal',
            'perihal'=>$perihal,
            'subperihal'=>$subperihal,
            'detailsubperihals'=>$detailsubperihal,
        ],
        );
        
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
            $subperihal = $this->subperihal->getByid($detail_id);
            $data = [
                'id' => $uuidString,
                'detail_id' => $detail_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];

            $this->detailsubperihal->insert($data);

         
            return redirect()->to('/admin/kategori/perihal/subperihal/detailsubperihal/'.$subperihal['slug'])->with('success', 'Data detail berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }


     public function edit($slug)
    {
        $detailsubperihal = $this->detailsubperihal->getBySlug($slug);
        $subperihal = $this->subperihal->getById($detailsubperihal['detail_id']);
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
            'detail_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        if ($this->validate($rules)) {
            $subperihal = $this->request->getPost('detail_id');
            $data = $this->subperihal->getById($subperihal);
            // Data pengguna yang akan disimpan
            $detailsubperihalData = [
                'detail_id' => $subperihal,
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($detailsubperihalData, $data);
            $this->detailsubperihal->update($id, $detailsubperihalData);
            return redirect()->to('/admin/kategori/perihal/subperihal/detailsubperihal/'. $data['slug'])->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()->with('error','periksa apakah data sudah terisi dengan benar');
        }
    }

    public function delete($slug)
    {
        $data = $this->detailsubperihal->getBySlug($slug);
        $detailsubperihal = $this->detailsubperihal->find($data['id']);
        $subperihal = $this->subperihal->getById($detailsubperihal['detail_id']);
        // dd($subperihal);
        if ($detailsubperihal) {
          $this->detailsubperihal->delete($data['id']);
            return redirect()->to('admin/kategori/perihal/subperihal/detailsubperihal/'. $subperihal['slug'])->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to('admin/kategori/perihal/subperihal/detailsubperihal'. $subperihal['slug'])->with('error', 'data not found.');
        }
    }
}