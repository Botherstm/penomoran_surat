<?php

namespace App\Models;

use CodeIgniter\Model;

class UrutanSuratModel extends Model
{
    protected $table            = 'urutan_surat';
    protected $primaryKey       = 'id';
 
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

     protected $allowedFields    = ['id','instansi_id','urutan','create_at','update_at'];



 
     public function getByid($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getAll(){
        
        return $this->findAll();
    }
    public function getByInstansi_id($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)->findAll();
    }

     public function getOneByInstansiId($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)->first();
    }
}