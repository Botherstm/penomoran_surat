<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;

class PerihalController extends BaseController
{


    public function index(): string
    {
        return view('admin/perihal/index',[
            'active'=>'perihal',
            ]
        );
        
    }

    public function create()
    {
        return view('admin/perihal/create', [
            'active' => 'perihal',
        ]);
    }
}