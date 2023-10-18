<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\GenerateModel;
use App\Models\UserModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class RiwayatController extends BaseController
{
    protected $user;
    protected $generate;
    protected $dinas;
    protected $bidang;

     public function __construct()
    {
        $this->user = new UserModel();
        $this->dinas = new DinasModel();
        $this->bidang = new BidangModel();
        $this->generate = new GenerateModel();
        $dompdf = new Dompdf();
    }

    public function index()
    {
        session();
        if (!session()->has('user_id')) {
            return view('login', [
                'validation' => \Config\Services::validation()
            ]);
        }
        $user = $this->user->getByid(session()->get('user_id'))??[];
        $generate = $this->generate->getAllByUserId_id(session()->get('user_id'));
        // dd($user);

        return view('public/riwayat/index',[
            'generates'=>$generate,
            'user'=>$user
        ]);
    }

    public function detail($slug)
    {
        $generate = $this->generate->getBySlug($slug);
        // dd($generate);
        $tanggal = date('d F Y', strtotime($generate['tanggal']));
        $dinas = $this->dinas->getById($generate['instansi_id']);
        $bidang = $this->bidang->getById($generate['bidang_id']);

        $options = new Options();
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($generate['pdf']);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
        
        return view('public/riwayat/detail',[
            'generate'=>$generate,
            'dinas'=>$dinas,
            'bidang'=>$bidang,
            'tanggal'=>$tanggal,
        ]);
    }

   
}