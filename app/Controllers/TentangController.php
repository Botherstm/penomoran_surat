<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TentangController extends BaseController
{
    public function user()
    {
        return view('tentang', ['active' => 'tentang']);
    }

    public function admin()
    {
        return view('admin/tentang', ['active' => 'tentang']);
    }
}
