<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table      = 'area';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields  = ['descripcion'];
}
