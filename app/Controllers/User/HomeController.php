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
<<<<<<< HEAD
          return view('public/home/index');
    }

}
=======
        return view('public/index');
    }
}
>>>>>>> 34666848327b9d22f2275d220088c41d5128513a
