<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\DetailSubPerihal;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;

class GenerateController extends BaseController
{
    protected $bidang;
    protected $dinas;
    protected $perihal;
    protected $kategori;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }
    public function index()
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }
        $kategories = $this->kategori->getAll();
        return view(
            'generate',
            [
                'kategories' => $kategories
            ]
        );
    }


    public function getPerihalByCategory($kategori_id)
    {
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $kategories = $this->kategori->getKategoriByid($kategori_id);
        $perihals = $this->perihal->getByKategori_id($kategories['id']);

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
    public function getSubPerihalByPerihal($perihal_slug)
    {
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $perihals = $this->perihal->getBykode($perihal_slug);
        $subperihals = $this->subperihal->getAllByPerihalId($perihals['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($subperihals as $subperihal) {
            $response[] = [
                'id' => $subperihal['id'],
                'name' => $subperihal['name'],
                'kode' => $subperihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }

    public function getdetailSubPerihalByPerihal($subperihal_id)
    {
        $subperihals = $this->subperihal->getByKode($subperihal_id);
        $detailsubperihals = $this->detailsubperihal->getAllBySubPerihalId($subperihals['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($detailsubperihals as $detailsubperihal) {
            $response[] = [
                'id' => $detailsubperihal['id'],
                'name' => $detailsubperihal['name'],
                'kode' => $detailsubperihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }

    public function generate()
    {
         session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }
        $kategories = $this->kategori->getAll();
        return view(
            'generate',
            [
                'kategories' => $kategories
            ]
        );
        return view('generate');
    }
}