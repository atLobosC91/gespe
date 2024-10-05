<?php

namespace App\Controllers;

use App\Models\ServicioModel;
use App\Models\ClienteModel;
use App\Models\ProyectoModel;
use App\Models\ImagenModel;

class Home extends BaseController
{
    public function index()
    {
        // Cargamos los modelos
        $servicioModel = new ServicioModel();
        $clienteModel = new ClienteModel();

        // Obtenemos los servicios activos
        $data['servicios'] = $servicioModel->getActiveServices();

        // Obtenemos los clientes activos
        $data['clientes'] = $clienteModel->getActiveClients();

        // Pasamos los datos a la vista 'index' dentro del array $data
        return view('home/header')
            . view('index', $data)  // Pasamos ambos: servicios y clientes
            . view('home/footer');
    }

    /* Puedes habilitar estas funciones si necesitas las demás páginas */
    public function about_us()
    {
        return view('home/header') .
            view('home/about_us') .
            view('home/footer');
    }

    // Controlador para mostrar los proyectos de un servicio
    public function service_project($id_servicio)
    {
        // Cargar modelo del servicio
        $servicioModel = new ServicioModel();
        $servicio = $servicioModel->find($id_servicio);

        // Cargar modelo de proyectos
        $proyectoModel = new ProyectoModel();
        $proyectos = $proyectoModel->where('id_servicio', $id_servicio)->findAll();


        $imagenModel = new ImagenModel();
        // Agregar la primera imagen de cada proyecto
        foreach ($proyectos as &$proyecto) {
            $primeraImagen = $imagenModel->getFirstImageByProject($proyecto['id_proyecto']);
            $proyecto['ruta_imagen'] = $primeraImagen ? $primeraImagen['ruta_imagen'] : null;
        }
        // Pasar los datos a la vista
        $data = [
            'servicio' => $servicio,
            'proyectos' => $proyectos
        ];

        return view('home/header')
            . view('home/service_project', $data)
            . view('home/footer');
    }

    // Mostrar detalles de un proyecto específico
    public function project_detail($id_proyecto)
    {
        // Cargar el modelo de Proyecto
        $proyectoModel = new ProyectoModel();
        $proyecto = $proyectoModel->find($id_proyecto);

        // Cargar el modelo de Imágenes
        $imagenModel = new ImagenModel();
        $imagenes = $imagenModel->getImagesByProject($id_proyecto);

        // Pasar los datos a la vista
        $data = [
            'proyecto' => $proyecto,
            'imagenes' => $imagenes
        ];

        return view('home/header')
            . view('home/project_detail', $data)
            . view('home/footer');
    }
}
