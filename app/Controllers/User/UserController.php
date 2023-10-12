<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function profile()
    {
        return view('user/profil/index');
    }


}

