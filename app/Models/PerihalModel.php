<?php

namespace App\Models;

use CodeIgniter\Model;

class PerihalModel extends Model
{
    protected $table = 'perihal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','kategori_id','slug','kode','name','create_at','update_at'];
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

    public function getAllByKategoriId($kategori_id)
    {
        return $this->where('kategori_id', $kategori_id)->findAll();
    }   

    public function findByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }  

    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
    public function findByid($id)
    {
        return $this->where('id', $id)->first();
    }

}