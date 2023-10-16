<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\GenerateModel;
use App\Models\UserModel;

class RiwayatController extends BaseController
{
    protected $user;
    protected $generate;

     public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
    }

    public function index($slug)
    {
        $user = $this->user->getBySlug($slug);
        $generate = $this->generate->getAllByUserId_id($user['id']);
        // dd($generate);
        return view('public/riwayat/index',[
            'generates'=>$generate,
            'user'=>$user
        ]);
    }

   
}