<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoryModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','perihal_id','slug', 'kode', 'name','create_at','update_at'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    //cari semua
    public function getAll(){
        
        return $this->findAll();
    }

    //ambil satu
    public function getOne(){
        return $this->first();
    }
    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
    public function findByid($id)
    {
        return $this->where('id', $id)->first();
    }

    //get semua data dinas
    
    //ambil semua data dinas berdasarkan dinas_id
    


    // public function getOneByDinasId($dinas_id)
    // {
    //     return $this->db->table('dinas')
    //         ->where('id', $dinas_id)
    //         ->get()
    //         ->getRowArray();
    // }


}