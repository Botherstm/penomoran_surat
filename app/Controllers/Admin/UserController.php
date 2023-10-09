<?php

namespace App\Controllers\Admin;

use App\Models\DinasModel;
use App\Models\UserModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;
use App\Models\BidangModel;

class UserController extends BaseController
{
    protected $dinas;
    protected $bidangs;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->dinas = new DinasModel();
        $this->bidangs = new BidangModel();
    }

    public function index()
    {
        $users = $this->UserModel->getAll();
        return view('admin/users/index', [
            'users' => $users,
            'active' => 'user',
        ]);
    }


    public function create()
    {
        $dinass = $this->dinas->get_data();
        // dd($dinass);
        $bidangs = $this->bidangs->findAll();
        $users = $this->UserModel->getAll();
        return view('admin/users/create', [
            'active' => 'user',
            'users' => $users,
            'dinass' => json_decode($dinass),
            'bidangs' => $bidangs,
        ]);
    }
    
}