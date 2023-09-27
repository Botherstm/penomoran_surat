<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Models\DinasModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class AdminController extends BaseController
{

    protected $dinas;
    public function __construct(){
        $this->dinas = new DinasModel();
    }
    public function index(): string
    {
        $dinas = $this->dinas->getAll();
     
        return view('admin/index',[
            'active'=>'home',
            'dinas'=>$dinas,
            ]);
        
    }
}