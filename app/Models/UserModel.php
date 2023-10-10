<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','instansi_id','bidang_id','slug','nip', 'name','email','no_hp','password','level','created_at','updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAll(){
        
        return $this->findAll();
    }
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

}