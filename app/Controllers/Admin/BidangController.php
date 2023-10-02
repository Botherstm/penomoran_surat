<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Controllers\BaseController;

class BidangController extends BaseController
{
    protected $bidang;
    public function __construct(){
        $this->bidang = new BidangModel();
    }

    protected $dinas;
    public function _construct(){
        $this->dinas = new DinasModel();
    }
    public function index()
    {
        $dinas = $this->dinas->get_data();
        dd($dinas);
        $bidangs =$this->bidang->getAll(); // Menggunakan method getByDinasId untuk mencari kategori berdasarkan dinas_id
        return view('admin/bidang/index', [
            'bidangs' => $bidangs,
            'active' => 'kategory',
        ]);
    }
    
    public function create()
    {

        return view('admin/bidang/create', [
            'active' => 'bidang',
        ]);
    }
    

    public function save()
    {
    //
    }
}