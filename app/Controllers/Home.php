<?php

namespace App\Controllers;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;

class Home extends BaseController
{
    protected $kategori;
    protected $perihal;
    protected $subperihal;
    protected $detailsubperihal;
    protected $bidang;
    public function __construct(){
        $this->bidang = new BidangModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel;
    }
    public function index(): string
    {
        $bidang = $this->bidang->getAll();
        $kategoris = $this->kategori->getAll();
        // dd($kategoris);
        return view('view', [
            'bidang' => $bidang,
            'kategoris' => $kategoris,
            'active' => 'bidang',// Mengirim data instansi ke tampilan
        ]);
    }
}