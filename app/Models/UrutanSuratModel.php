<?php

namespace App\Models;

use CodeIgniter\Model;

class UrutanSurat extends Model
{
    protected $table            = 'urutan_surat';
    protected $primaryKey       = 'id';
 
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

     protected $allowedFields    = ['id','instansi_id','slug','urutan_surat','terlewat','create_at','update_at'];

}