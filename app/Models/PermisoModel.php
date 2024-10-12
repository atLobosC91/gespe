<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisoModel extends Model
{
    protected $table      = 'permiso';
    protected $primaryKey = 'id_permiso';  // La clave primaria correcta
    protected $allowedFields = ['descripcion'];  // Campo de la descripción del permiso
}
