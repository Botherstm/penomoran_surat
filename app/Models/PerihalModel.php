<?php

namespace App\Models;

use CodeIgniter\Model;

class PerihalModel extends Model
{
    protected $table = 'perihal';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'detail_id', 'slug', 'kode', 'name', 'create_at', 'update_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    public function getAll()
    {
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

    public function getByKategori_id($detail_id)
    {
        return $this->where('detail_id', $detail_id)->orderBy('kode', 'ASC')->findAll();
    }

    public function getBykode($kode)
    {
        return $this->where('kode', $kode)->first();
    }
    public function getOneByKategoriId($kategori_id)
    {
        return $this->db->table('kategori')
            ->where('id', $kategori_id)
            ->get()
            ->getRowArray();
    }
}
