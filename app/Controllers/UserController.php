<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('public/home/index');
    }
}
