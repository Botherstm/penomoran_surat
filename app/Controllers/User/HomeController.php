<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\GenerateModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use App\Models\UserModel;
use DateTime;

class HomeController extends BaseController
{
    protected $user;
    protected $generate;
    protected $bidang;
    protected $dinas;
    protected $perihal;
    protected $kategori;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }
    public function index()
    {
        if (!session()->has('user_id')) {
            $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
            // dd($siteKey);
            return view('login', [
                'validation' => \Config\Services::validation(),
                'key' => $siteKey,
            ]);
        }
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            return redirect()->to(base_url('/admin'));
        }

        $generate = $this->generate->getAllByInstansi_id(session()->get('instansi_id'));
        $users = [];
        foreach ($generate as $gen) {
            $userId = $gen['user_id'];
            $user = $this->user->getById($userId);
            $users[$userId] = $user;
        }
        // dd($users);
        $bidangs = [];
        foreach ($generate as $gen) {
            $bidangId = $gen['bidang_id'];
            $bidang = $this->bidang->getById($bidangId);
            $bidangs[$bidangId] = $bidang;
        }
        // dd($bidangs);
        $bidang = $this->bidang->getById(session()->get('bidang_id'));
        $dinas = $this->dinas->getById(session()->get('instansi_id'));
        $kategories = $this->kategori->getAll();
        $generates = $this->generate->getOneLatestByInstansiId(session()->get('instansi_id'));
        // dd($generates['urutan']);
        $urutan = $generates['urutan'];
        $urutanPlusOne = $urutan + 1;
        // dd($urutanPlusOne);

        $tanggalSaatIni = new DateTime();
        $tanggalMaksimum = $tanggalSaatIni->format('Y-m-d');
        return view('public/home/index', [
            'active' => 'home',
            'riwayats' => $generate,
            'users' => $users,
            'bidangs' => $bidangs,
            'kategories' => $kategories,
            'bidang' => $bidang,
            'dinas' => $dinas,
            'generate' => $generates,
            'tanggalmax' => $tanggalMaksimum,
            'urutanPlusOne' => $urutanPlusOne,
        ]);

    }

}