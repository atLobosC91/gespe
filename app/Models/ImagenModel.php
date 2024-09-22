<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table = 'imagenes'; // Nombre de la tabla
    protected $primaryKey = 'id_imagen'; // Clave primaria de la tabla
    protected $allowedFields = ['id_proyecto', 'ruta_imagen']; // Campos que se pueden modificar

    // Método para obtener las imágenes de un proyecto específico
    public function getImagesByProject($id_proyecto)
    {
        return $this->where('id_proyecto', $id_proyecto)->findAll();
    }
}
