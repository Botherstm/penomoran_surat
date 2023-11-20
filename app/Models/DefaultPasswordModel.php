<?php

namespace App\Models;

use CodeIgniter\Model;

class DefaultPasswordModel extends Model
{
    protected $table            = 'password_default';
    protected $primaryKey       = 'id';
 
    protected $allowedFields    = ['id','password_default'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
      public function getOne()
    {
        return $this->first();
    }
}