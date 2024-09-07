<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectoModel extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'descripcion', 'imagen_principal', 'servicio_id']; // Asegúrate de que coincidan con los campos de tu tabla
}
