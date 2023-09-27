<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','dinas_id', 'name', 'nomor','urutan_surat','create_at','update_at'];
    // public function saveToken($email, $token)
    // {
    //     $this->where('email', $email)->set(['token' => $token])->update();s
    // }

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
    public function getAllWithDinas()
    {
        return $this->select('categories.*, dinas.name as dinas_name')
            ->join('dinas', 'dinas.id = categories.dinas_id')
            ->get()
            ->getResultArray();
    }
   
    //ambil semua data dinas berdasarkan dinas_id
    public function getByDinasId($dinas_id)
    {
        return $this->where('dinas_id', $dinas_id)->findAll();
    }
    

    //ambil 1 data dinas berdasarkan dinas_id
    public function getOneByDinasId($dinas_id)
    {
        return $this->db->table('dinas')
            ->where('id', $dinas_id)
            ->get()
            ->getRowArray();
    }


}