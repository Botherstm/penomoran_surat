<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\KategoryModel;

class GenerateController extends BaseController
{  
    protected $bidang;
    protected $dinas;

    protected $kategori;
    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
    }
    public function index()
    {
        $kategories = $this->kategori->getAll();
        return view('generate',
        [
            'kategories'=> $kategories
        ]);
    }
}