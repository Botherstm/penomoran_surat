<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateModel extends Model
{    protected $table            = 'generate';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'user_id', 'instansi_id', 'bidang_id', 'slug', 'urutan_id', 'terlewat','tanggal','pdf','perihal','urutan','nomor','create_at','update_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    public function dinas()
    {
        return $this->belongsTo('App\Models\DinasModel', 'dinas_id');
    }


    //cari semua
    public function getAll(){
        
        return $this->findAll();
    }
     public function getById($id)
    {
        return $this->where('id', $id)->first();
    }
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
    public function getAllByUserId_id($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    public function getAllByTanggal($tanggal)
    {
        return $this->where('tanggal', $tanggal)->findAll();
    }
    public function getOneByInstansiId($instansi_id)
    {
        return $this->where('$instansi_id', $instansi_id)->first();
    }
    public function getOneLatestByInstansiId($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)
                    ->orderBy('tanggal', 'desc')
                    ->first();
    }
    public function getAllByInstansi_id($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)
         ->orderBy('created_at', 'desc')->findAll();
    }
}