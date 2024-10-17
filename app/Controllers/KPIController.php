<?php

namespace App\Controllers;

use App\Models\SolicitudModel;
use App\Models\UsuarioModel;

class KPIController extends BaseController
{
    protected $solicitudModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->solicitudModel = new SolicitudModel();
        $this->usuarioModel = new UsuarioModel();
    }

    // Método para obtener los datos del usuario logueado (rol incluido)
    private function getUserData()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtener el ID del usuario desde la sesión
        $id_usuario = session()->get('id_usuario');

        // Buscar los datos del usuario en la base de datos
        $usuario = $this->usuarioModel->find($id_usuario);

        // Si el usuario no existe, retornar null
        if (!$usuario) {
            return ['usuario' => null, 'rol' => null];
        }

        // Retornar los datos del usuario y su rol
        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol']
        ];
    }

    // Función para el Dashboard de KPIs
    public function index()
    {
        // Obtener los datos del usuario
        $userData = $this->getUserData();

        // Verificar si getUserData devolvió una redirección (es decir, si el usuario no está autenticado)
        if ($userData instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $userData; // Redirigir al usuario a la página de inicio de sesión
        }

        // Consultas para los permisos según su estado
        $total_permisos = $this->solicitudModel->countAllResults();
        $permisos_aprobados = $this->solicitudModel->where('estado_solicitud', 2)->countAllResults(); // 1: Aprobado
        $permisos_rechazados = $this->solicitudModel->where('estado_solicitud', 3)->countAllResults(); // 2: Rechazado
        $permisos_en_curso = $this->solicitudModel->where('estado_solicitud', 1)->countAllResults(); // 3: En curso

        // Preparar los datos para pasarlos a la vista
        $data = [
            'total_permisos' => $total_permisos,
            'permisos_aprobados' => $permisos_aprobados,
            'permisos_rechazados' => $permisos_rechazados,
            'permisos_en_curso' => $permisos_en_curso,
        ];

        // Combinar los datos del usuario con los de los KPIs
        $data = array_merge($userData, $data);

        // Cargar las vistas
        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/kpi/kpi', $data);
        echo view('gespe/incluir/footer_app', $data);
    }
}
