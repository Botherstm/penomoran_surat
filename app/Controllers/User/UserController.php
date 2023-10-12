<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        //
    }

    public function profile()
    {
        return view('user/profil/index');
    }
    public function beranda()
    {
        return view('user/index');
    }
    public function rinciansurat()
    {
        return view('user/surat/rinciansurat');
    }
}
