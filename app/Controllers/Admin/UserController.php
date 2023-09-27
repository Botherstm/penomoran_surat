<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Models\DinasModel;
use App\Models\UserModel;
use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class UserController extends BaseController
{ 
    protected $dinas;
    protected $UserModel;
    public function __construct(){
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $dinas = $this->dinas = new DinasModel();
        $user = $this->UserModel->getAll();
        // dd($user);
        return view('admin/users/index',[
            'users' => $user,
            'active'=>'user',
            'dinas' => $dinas,
        ]); // Sesuaikan dengan struktur folder view yang benar
    }

    // Tambahkan fungsi-fungsi lain yang diperlukan untuk controller ini
}