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
use App\Models\UserModel;

class AdminController extends BaseController
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
        $this->bidangs = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }

    public function index(): string
    {
        if (!session()->has('user_id')) {
           return redirect()->to(base_url('/login'));
        }
        if (session()->get('level') != 1 && session()->get('level') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $dinas = $this->dinas->getAll();
        $dinasCount = count($dinas);
        $generate = $this->generate->getAllByInstansi_id(session()->get('instansi_id'));
        $generateCount = count($generate);
        $user = $this->user->getByInstansiId(session()->get('instansi_id'));
        $userCount = count($user);
        $kategori = $this->kategori->getAll();
        $kategoriCount = count($kategori);

        // dd($kategoriCount);
        return view('admin/index', [
            'active' => 'admin',
            'dinas' => $dinasCount,
            'generate' => $generateCount,
            'user' => $userCount,
            'kategori' => $kategoriCount,

        ]);

    }

}