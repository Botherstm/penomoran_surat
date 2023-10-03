<?php

namespace App\Models;

use CodeIgniter\Model;

class PerihalModel extends Model
{
    protected $table            = 'perihal';
    protected $primaryKey       = 'id';

    protected $allowedFields    = ['id','kategori_id','sub_perihal_id','kode','name','create_at','update_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    public function getAll(){
        
        return $this->findAll();
    }


    public function getByKategori_id($kategori_id)
    {
        return $this->where('kategori_id', $kategori_id)->findAll();
    }

    public function getOneByKategoriId($kategori_id)
    {
        return $this->db->table('kategori')
            ->where('id', $kategori_id)
            ->get()
            ->getRowArray();
    }
    
}