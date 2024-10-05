<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = ['nombre_cliente', 'url_pagina', 'logo', 'activo']; 
    
    // Método para obtener los clientes activos
    public function getActiveClients()
    {
        return $this->where('activo', 1)->asObject()->findAll();  // Asegurarse de que los datos se devuelvan como objetos
    }
}
