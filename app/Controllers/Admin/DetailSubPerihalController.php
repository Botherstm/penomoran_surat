<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;

use App\Models\DetailSubPerihalModel;
use App\Models\SubPerihalModel;
use Ramsey\Uuid\Uuid;

class DetailSubPerihalController extends BaseController
{

    protected $sub_perihal;
    protected $detailsubperihal;
    public function __construct(){
        $this->sub_perihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel;
    }
    public function index($slug)
    {
        $sub_perihal = $this->sub_perihal->findBySlug($slug);
        // dd($slug);
        if (!$sub_perihal) {
            // Handle jika detailsubperihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        $detailsubperihal = $this->detailsubperihal->getAllBySubPerihalId($sub_perihal['id']);
        // dd($detailsubperihal);
        return view('admin/detailsubperihal/index',[
            'active'=>'detailsubperihal',
            'sub_perihal'=>$sub_perihal,
            'detailsubperihal'=>$detailsubperihal,
        ],
        );
        
    }

    public function create($slug)
    {
        // dd($slug);
        $sub_perihal = $this->sub_perihal->findBySlug($slug);
        if (!$sub_perihal) {
            // Handle jika detailsubperihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
            return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        }
        return view('admin/detailsubperihal/create', [
            'active' => 'detailsubperihal',
            'sub_perihal'=>$sub_perihal,
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
            $sub_perihal = $this->sub_perihal->findByid($subperihal_id);
            $data = [
                'id' => $uuidString,
                'subperihal_id' => $subperihal_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
    // dd($data);
            $this->detailsubperihal->insert($data);

         
            return redirect()->to('/admin/detailsubperihal/'.$sub_perihal['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }


    public function getDetailSubPerihalBySubPerihal($subPerihalId)
    {
        
        $sub_perihal = $this->sub_perihal->findByKode($subPerihalId);
        $detail_sub_perihals = $this->detailsubperihal->getAllBySubPerihalId($sub_perihal['id']);
        // dd($detail_sub_perihals);
        // Ubah data menjadi format JSON
        $response = [];
        foreach ($detail_sub_perihals as $detail_sub_perihal) {
            $response[] = [
                'id' => $detail_sub_perihal['id'],
                'name' => $detail_sub_perihal['name'],
                'kode' => $detail_sub_perihal['kode'],
            ];
        }
        return $this->response->setJSON($response);
    }



    public function tambahdetailsubperihal()
    {
        return view('admin/subperihal/tambahdetailsubperihal');
    }
    public function editdetailsubperihal()
    {
        return view('admin/subperihal/editdetailsubperihal');
    }
}