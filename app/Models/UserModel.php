<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'instansi_id', 'bidang_id', 'slug', 'name', 'email', 'no_hp', 'password', 'level', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getAll()
    {

        return $this->findAll();
    }
    public function getAllSuperAdmin()
    {
        return $this->where('level', 2)->orWhere('level', 1)->orderBy('level', 'asc')->findAll();
    }
    public function getAdminByInstansi($instansiId)
    {
        return $this->where('instansi_id', $instansiId)->where('level', 0)->findAll();
    }
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getByid($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getByInstansiId($instansi_id)
    {
        return $this->where('instansi_id', $instansi_id)->findAll();
    }

}
