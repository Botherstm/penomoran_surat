<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','name', 'email', 'password','token'];
    public function saveToken($email, $token)
    {
        $this->where('email', $email)->set(['token' => $token])->update();
    }

    public function getAll(){
        
        return $this->findAll();
    }
    // public function albums()
    // {
    //     return $this->hasMany('App\Models\AlbumModel', 'user_id');
    // }

}