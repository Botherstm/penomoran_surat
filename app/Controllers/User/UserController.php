<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
    }

    public function profile()
    {
        return view('public/user/profil/index');
    }
    public function beranda()
    {
        return view('user/index');
    }
    public function rinciansurat()
    {
        return view('public/user/surat/rinciansurat');
    }
    public function generate()
    {
        return view('generate');
    }
}
