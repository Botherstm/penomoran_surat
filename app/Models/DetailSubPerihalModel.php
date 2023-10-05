<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSubPerihalModel extends Model
{
   
    protected $table            = 'detail_subperihal';
    protected $primaryKey       = 'id';
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields    = ['id','subperihal_id','slug','kode','name','create_at','update_at'];

    public function getAll(){
        
        return $this->findAll();
    }

    //ambil satu
    public function getOne(){
        return $this->first();
    }
    public function getAllBySubPerihalId($subperihal_id)
    {
        return $this->where('subperihal_id', $subperihal_id)->findAll();
    }
}