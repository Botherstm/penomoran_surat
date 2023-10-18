<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PengaturanController extends BaseController
{
    public function index()
    {
        return view('/pengaturan');
    }
}
