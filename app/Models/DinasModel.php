<?php

namespace App\Models;

use CodeIgniter\Model;

class DinasModel extends Model
{
    protected $table = 'dinas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'create_at', 'update_at'];
    // public function saveToken($email, $token)
    // {
    //     $this->where('email', $email)->set(['token' => $token])->update();
    // }
    public function getAll()
    {
        return $this->findAll();
    }
    public function dinas()
    {
        return $this->hasMany('App\Models\KategoryModel', 'dinas_id');
    }
}