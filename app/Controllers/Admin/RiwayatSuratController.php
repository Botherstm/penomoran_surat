<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\GenerateModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use App\Models\UrutanSuratModel;
use App\Models\UserModel;

class RiwayatSuratController extends BaseController
{
    protected $user;
    protected $generate;
    protected $urutan;
    protected $bidangs;
    protected $dinas;
    protected $perihal;
    protected $kategori;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
        $this->urutan = new UrutanSuratModel();
        $this->bidangs = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }

    public function index()
    {
        if (session()->get('level') == 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
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
            $bidang = $this->bidangs->getById($bidangId);
            $bidangs[$bidangId] = $bidang;
        }
        // dd($bidangs);

        return view('admin/riwayatsurat/index', [
            'active' => 'riwayatsurat',
            'riwayats' => $generate,
            'users' => $users,
            'bidangs' => $bidangs,
        ]);
    }

}
