<?php

namespace App\Controllers;

use App\Models\ProyectoModel;
use CodeIgniter\Controller;

class ProyectoController extends Controller
{
    public function index()
    {
        // Cargar el modelo
        $proyectoModel = new ProyectoModel();

        // Obtener los proyectos
        $data['proyectos'] = $proyectoModel->get_proyectos();

        // Cargar la vista con los datos
        return view('home/project', $data);
    }
}
