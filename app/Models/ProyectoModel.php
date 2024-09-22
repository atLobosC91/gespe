<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectoModel extends Model
{
    protected $table = 'proyecto';  // Nombre de la tabla
    protected $primaryKey = 'id_proyecto';  // Clave primaria
    protected $allowedFields = ['titulo', 'descripcion', 'fecha', 'id_servicio', 'id_cliente', 'fecha_creacion', 'fecha_modificacion'];

    // Método para obtener los proyectos de un servicio
    public function getProjectsByService($id_servicio)
    {
        return $this->where('id_servicio', $id_servicio)->findAll();
    }
}
