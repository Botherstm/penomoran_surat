<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table = 'bidang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','instansi_id', 'slug', 'kode','name','create_at','update_at'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    //relasi
    public function instansi()
    {
        return $this->belongsTo('App\Models\DinasModel', 'instansi_id');
    }

    //cari semua
    public function getAll(){
        
        return $this->findAll();
    }

    public function getByInstansiId($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)->findAll();
    }       

}