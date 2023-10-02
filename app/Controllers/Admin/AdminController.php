<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Models\DinasModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class AdminController extends BaseController
{


    public function index(): string
    {
  
     
        return view('admin/index',[
            'active'=>'home',
            ]);
        
    }
}