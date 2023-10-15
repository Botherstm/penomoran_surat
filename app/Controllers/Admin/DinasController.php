<?php

namespace App\Controllers\Admin; 
use App\Controllers\BaseController;
use App\Models\DinasModel;
use App\Models\UrutanSuratModel;

class DinasController extends BaseController
{
   
    protected $dinas;
    protected $urutan;
    public function __construct(){
        $this->dinas = new DinasModel();
         $this->urutan = new UrutanSuratModel();
    }
    public function index()
    {
    if (session()->get('level') != 2 && session()->get('level') != 3) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        $result =json_decode( $this->dinas->get_data());
        // foreach ($result->data as $dinas) {
        //     $dinas[$dinas['id']] = $this->dinas->getByBidangId($dinas['id']);
        // }
        // dd($result);

       

        $urutans = [];
        $urutan = $this->urutan->getAll();
        $urutans = [];
        foreach ($result->data as $dinas) {
            $dinasId = $dinas->id_instansi;
            // dd($dinasId);
            $urutanData = $this->urutan->getByInstansi_id($dinasId);
            $urutans[$dinasId] = $urutanData;
        }
        // dd($urutans);
        return view('admin/dinas/index', [
            'dinass' => $result,
            'active'=>'dinas',
            'urutans'=>$urutans
        ]);
    }

    public function view()
    {
        return view('admin/dinas/listdinas', [
            'active'=>'dinas'
        ]);
    }
   
}