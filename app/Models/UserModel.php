<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','NIP', 'name', 'username','email','password','level','created_at','updated_at'];


    public function getAll(){
        
        return $this->findAll();
    }


}