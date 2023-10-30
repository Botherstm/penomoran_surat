<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TentangController extends BaseController
{
    public function index()
    {
        return view('tentang');
    }
}
