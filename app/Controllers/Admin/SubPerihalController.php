<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use Ramsey\Uuid\Uuid;

class SubPerihalController extends BaseController
{

    protected $perihal;
    protected $subperihal;
    public function __construct(){
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
    }
    public function index($slug)
    {
        $perihal = $this->perihal->findBySlug($slug);
        // if (!$perihal) {
        //     // Handle jika perihal tidak ditemukan, misalnya, tampilkan pesan kesalahan
        //     return view('errors/404'); // atau sesuaikan dengan kebijakan Anda
        // }
        $sub_perihals = $this->subperihal->getAllByPerihalId($perihal['id']);

        return view('admin/subperihal/index',[
            'active'=>'subperihal',
            'sub_perihals'=>$sub_perihals,
            'perihal'=>$perihal,
        ],
        );
        
    }

    public function create($slug)
    {
        $perihal = $this->perihal->findBySlug($slug);
        return view('admin/subperihal/create', [
            'active' => 'subperihal',
            'perihal'=>$perihal,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'perihal_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'kode' => 'required',
        ];

        if ($this->validate($rules)) {
            $perihal_id = $this->request->getPost('perihal_id');
            $slug = $this->request->getPost('slug');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $perihal = $this->perihal->findByid($perihal_id);
            $data = [
                'id' => $uuidString,
                'perihal_id' => $perihal_id,
                'slug' => $slug,
                'name' => $name,
                'kode' => $kode,
            ];
    // dd($data);
            $this->subperihal->insert($data);

         
            return redirect()->to('/admin/subperihal/'.$perihal['slug'])->with('success', 'Data Kategory berhasil disimpan.');
        } else {

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
    public function getSubPerihalByPerihal($perihal_id)
    {
        
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $perihal = $this->perihal->findByKode($perihal_id);
        $sub_perihals = $this->subperihal->getAllByPerihalId($perihal['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($sub_perihals as $sub_perihal) {
            $response[] = [
                'id' => $sub_perihal['id'],
                'name' => $sub_perihal['name'],
                'kode' => $sub_perihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }
}