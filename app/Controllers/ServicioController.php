<?php

namespace App\Controllers;

use App\Models\ServicioModel;

class ServicioController extends BaseController
{
    public function index()
    {
        // Cargar el modelo
        $servicioModel = new ServicioModel();

        // Obtener todos los servicios
        $data['servicios'] = $servicioModel->findAll();

        // Cargar la vista y pasar los datos
        return view('home/services', $data);
    }
}
