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

   
}