<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagen';
    protected $allowedFields = ['id_proyecto', 'ruta_imagen'];

    // Método para obtener las imágenes de un proyecto específico
    public function getImagesByProject($id_proyecto)
    {
        return $this->where('id_proyecto', $id_proyecto)->findAll();
    }

    public function getFirstImageByProject($id_proyecto)
    {
        // Asegúrate de que la columna 'fecha_creacion' existe o cámbiala por la columna correcta
        return $this->where('id_proyecto', $id_proyecto)
            ->orderBy('fecha_creacion', 'ASC')  // Verifica que la columna existe
            ->first();
    }
}
