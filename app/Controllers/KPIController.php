<?php

namespace App\Controllers;

use App\Models\ProyectoModel; // Modelo para gestionar proyectos
use App\Models\PermisoModel;  // Modelo para gestionar permisos

class KpiController extends BaseController
{
    protected $proyectosModel;
    protected $permisosModel;

    public function __construct()
    {
        $this->proyectosModel = new ProyectoModel(); // Inicializamos el modelo de proyectos
        $this->permisosModel = new PermisoModel();   // Inicializamos el modelo de permisos
    }

    // Mostrar el dashboard de KPIs
    public function index()
    {
        $data['total_proyectos'] = $this->proyectosModel->countAllResults(); // Contar total de proyectos
        $data['permisos_aprobados'] = $this->permisosModel->where('estado', 'Aceptado')->countAllResults(); // Contar permisos aprobados

        return view('kpi', $data); // Cargar la vista de KPIs
    }
}
