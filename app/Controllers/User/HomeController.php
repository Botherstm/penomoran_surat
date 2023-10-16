<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;

class HomeController extends BaseController
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
        return view('public/home/index', [
            'kategories' => $kategories
        ]);
    }


    public function terlewat()
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }
        $kategories = $this->kategori->getAll();
        return view('public/home/terlewat', [
            'kategories' => $kategories
        ]);
    }
}
