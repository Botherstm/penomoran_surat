<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSubPerihalModel extends Model
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

    public function getAll()
    {

        return $this->findAll();
    }

    //ambil satu
    public function getOne()
    {
        return $this->first();
    }
    public function getAllBySubPerihalId($detail_id)
    {
        return $this->where('detail_id', $detail_id)->orderBy('kode', 'ASC')->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getSubPerihalByid($kode)
    {
        return $this->where('kode', $kode)->first();
    }
}
