<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table = 'servicio';  // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id';   // Llave primaria de la tabla
    protected $allowedFields = ['titulo', 'descripcion', 'img']; // Campos permitidos
}
