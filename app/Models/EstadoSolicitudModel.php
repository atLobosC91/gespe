<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoSolicitudModel extends Model
{
    protected $table      = 'estado_solicitud';  // Nombre correcto de la tabla
    protected $primaryKey = 'id';  // La clave primaria
    protected $allowedFields = ['estado'];  // Campo que contiene la descripción del estado
}
