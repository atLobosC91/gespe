<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente'; // Nombre de la tabla
    protected $primaryKey = 'id_cliente'; // Clave primaria de la tabla
    protected $allowedFields = ['nombre_cliente', 'url_pagina', 'logo', 'activo']; // Campos que se pueden modificar

    // Método para obtener los clientes activos
    public function getActiveClients()
    {
        return $this->where('activo', 1)->asObject()->findAll();  // Asegurarse de que los datos se devuelvan como objetos
    }
}
