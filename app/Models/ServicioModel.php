<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table = 'servicio'; // Nombre de la tabla
    protected $primaryKey = 'id_servicio'; // Clave primaria
    protected $allowedFields = ['titulo', 'descripcion', 'activo', 'url_imagen']; // Campos permitidos para insertar/actualizar

    // Método para obtener los servicios activos como objetos
    public function getActiveServices()
    {
        return $this->asObject()->where('activo', 1)->findAll();  // Devolvemos los servicios como objetos
    }
}
