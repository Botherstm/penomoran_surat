<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\GenerateModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class RiwayatController extends BaseController
{
    protected $user;
    protected $generate;

     public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
        $dompdf = new Dompdf();
    }

    public function index($slug)
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }
        $user = $this->user->getBySlug($slug);
        $generate = $this->generate->getAllByUserId_id($user['id']);
        // dd($generate);

        return view('public/riwayat/index',[
            'generates'=>$generate,
            'user'=>$user
        ]);
    }

    public function detail($slug)
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }


        $generate = $this->generate->getBySlug($slug);
        dd($generate);

        return view('public/riwayat/index',[
            'generate'=>$generate,
        ]);
    }

   
}