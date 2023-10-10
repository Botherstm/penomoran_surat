<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoryModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','bidang_id','slug', 'name','kode','create_at','update_at'];
   
    // public function saveToken($email, $token)
    // {
    //     $this->where('email', $email)->set(['token' => $token])->update();s
    // }

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //relasi
    public function dinas()
    {
        return $this->belongsTo('App\Models\DinasModel', 'dinas_id');
    }

    //cari semua
    public function getAll(){
        
        return $this->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    //ambil satu
    public function getOne(){
        return $this->first();
    }

    public function getKategoriByid($kode)
    {
        return $this->where('kode', $kode)->first();
    }

}