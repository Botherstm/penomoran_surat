<?php

namespace App\Controllers\User; 

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function profile()
    {
        return view('user/profil/index');
    }

}