<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{

    protected $table = 'user_token';
    protected $primaryKey = 'id';

    protected $protectFields = true;
    protected $allowedFields = ['id', 'email', 'token', 'created_at'];

    // Dates

}
