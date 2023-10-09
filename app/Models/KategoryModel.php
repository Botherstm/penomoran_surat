<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoryModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','bidang_id', 'name','kode','create_at','update_at'];
   
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

    //ambil satu
    public function getOne(){
        return $this->first();
    }

    //get semua data dinas
    
    //ambil semua data dinas berdasarkan dinas_id
    public function getByBidangId($bidang_id)
    {
        return $this->where('bidang_id', $bidang_id)->findAll();
    }
    


    public function getOneByBidangId($bidang_id)
    {
        return $this->db->table('bidang')
            ->where('id', $bidang_id)
            ->get()
            ->getRowArray();
    }


    public function getPerihalByKategori($kategoriId)
{
    // Query database untuk mengambil data perihal berdasarkan $kategoriId
    $query = $this->db->table('kategori')
        ->where('kategori_id', $kategoriId)
        ->get();

    return $query->getResult();
}

}