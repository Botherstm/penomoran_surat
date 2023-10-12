<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }

          return view('public/home/index');
    }

}