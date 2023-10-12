<?php

namespace App\Controllers\User; 

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
          return view('public/index');
    }

        


}