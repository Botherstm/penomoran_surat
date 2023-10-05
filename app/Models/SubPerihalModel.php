<?php

namespace App\Models;

use CodeIgniter\Model;

class SubPerihalModel extends Model
{
    protected $table            = 'sub_perihal';
    protected $primaryKey       = 'id';
 
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

     protected $allowedFields    = ['id','perihal_id','slug','kode','name','create_at','update_at'];


     public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
    public function findByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }  
     public function findByid($id)
    {
        return $this->where('id', $id)->first();
    }
     public function getAllByPerihalId($perihal_id)
    {
        return $this->where('perihal_id', $perihal_id)->findAll();
    }   
}