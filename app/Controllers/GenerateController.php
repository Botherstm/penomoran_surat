<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;

class GenerateController extends BaseController
{  
    protected $bidang;
    protected $dinas;
    protected $perihal;

    protected $kategori;
    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
    }
    public function index()
    {
        $kategories = $this->kategori->getAll();
        return view('generate',
        [
            'kategories'=> $kategories
        ]);
    }

    public function getPerihalByKategori()
    {
        $kategoriId = $this->request->getPost('kategori_id'); // Ambil ID kategori dari AJAX request
        // Lakukan query untuk mendapatkan data perihal berdasarkan $kategoriId
        $perihals = $this->kategori->getPerihalByKategori($kategoriId);
        // dd($perihals);
        return json_encode($perihals); // Kembalikan data perihal dalam format JSON
    }


    public function getPerihalByCategory($perihal_id)
    {
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $perihals = $this->perihal->getByKategori_id($perihal_id);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($perihals as $perihal) {
            $response[] = [
                'id' => $perihal['id'],
                'name' => $perihal['name'],
                'kode' => $perihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }
}