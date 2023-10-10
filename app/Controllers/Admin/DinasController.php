<?php

namespace App\Controllers\Admin; 
use App\Controllers\BaseController;
use App\Models\DinasModel;


class DinasController extends BaseController
{
   
    protected $dinas;
    public function __construct(){
        $this->dinas = new DinasModel();
    }
    public function index()
    {
    if (session()->get('level') != 2 && session()->get('level') != 3) {
        // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
        $result = $this->dinas->get_data();
        // foreach ($result->data as $dinas) {
        //     $dinas[$dinas['id']] = $this->dinas->getByBidangId($dinas['id']);
        // }
        // dd($result);
        return view('admin/dinas/index', [
            'dinass' => json_decode($result),
            'active'=>'dinas'
        ]);
    }

    public function view()
    {
    
        return view('admin/dinas/listdinas', [
            'active'=>'dinas'
        ]);
    }
   
}