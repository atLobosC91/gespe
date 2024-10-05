<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    protected $allowedFields = ['titulo', 'descripcion', 'activo', 'url_imagen'];

    // Método para obtener los servicios activos
    public function getActiveServices()
    {
        return $this->asObject()->where('activo', 1)->findAll();
    }
}
