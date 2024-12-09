<?php

namespace App\Models;

use CodeIgniter\Model;

class EspecialidadModel extends Model
{
    protected $table = 'especialidad'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    protected $allowedFields = ['descripcion']; // Campos permitidos para inserción/actualización
}
