<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Models\DinasModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class AdminController extends BaseController
{


    public function index(): string
    {
  
     if (session()->get('level') != 1 && session()->get('level') != 2) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        // dd();
        return view('admin/index',[
            'active'=>'admin',
            ]);
        
    }
}