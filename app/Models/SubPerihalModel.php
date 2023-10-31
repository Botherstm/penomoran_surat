<?php

namespace App\Models;

use CodeIgniter\Model;

class SubPerihalModel extends Model
{
    protected $table = 'perihal';
    protected $primaryKey = 'id';

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $allowedFields = ['id', 'detail_id', 'slug', 'kode', 'name', 'create_at', 'update_at'];

    public function getByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
    public function getByid($id)
    {
        return $this->where('id', $id)->first();
    }
    public function getAllByPerihalId($detail_id)
    {
        return $this->where('detail_id', $detail_id)->orderBy('kode', 'ASC')->findAll();
    }
}
