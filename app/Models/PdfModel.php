<?php

namespace App\Models;

use CodeIgniter\Model;

class PdfModel extends Model
{
    protected $table = 'pdf';
    protected $primaryKey = 'id';
    protected $useTimestamp = true;
    protected $allowedFields = ['name'];
}