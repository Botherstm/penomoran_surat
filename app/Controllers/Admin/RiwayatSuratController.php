<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class RiwayatSuratController extends BaseController
{
    public function index()
    {
        return view('admin/urutansurat/index', [
        'active' => 'urutan surat',
    ]);
    }



public function view2()
{
    return view('admin/riwayatsurat/index', [
        'active' => 'kategory',
    ]);
}

public function view3()
{
    return view('admin/riwayatsurat/rinciansurat', [
        'active' => 'kategory',
    ]);
}
}