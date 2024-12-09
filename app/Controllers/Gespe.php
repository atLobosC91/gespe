<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\SolicitudModel; // Modelo para la tabla de solicitudes

class Gespe extends BaseController
{
    protected $usuarioModel;
    protected $solicitudModel;
    protected $session;

    public function __construct()
    {
        // Inicializar los modelos y la sesión
        $this->usuarioModel = new UsuarioModel();
        $this->solicitudModel = new SolicitudModel();
        $this->session = session();
    }

    public function panelInicio()
    {
        // Obtener datos del usuario logueado
        $usuario = $this->getUserData();

        // Si el usuario no está logueado, redirigir al login
        if (!is_array($usuario)) {
            return $usuario; // Esto redirige al login si no hay sesión activa
        }

        // Obtener el rol del usuario
        $rol = $usuario['id_rol'];

        // Calcular permisos del mes actual
        $currentMonth = date('m');
        $currentYear = date('Y');
        $id_usuario = $usuario['id_usuario'];

        $permisosMesActual = $this->solicitudModel
            ->where('id_usuario', $id_usuario)
            ->where('MONTH(fecha_hora_inicio)', $currentMonth)
            ->where('YEAR(fecha_hora_inicio)', $currentYear)
            ->countAllResults();

        // Calcular permisos totales
        $permisosTotales = $this->solicitudModel
            ->where('id_usuario', $id_usuario)
            ->countAllResults();

        // Cargar la vista unificada con los datos necesarios
        return view('gespe/incluir/header_app', ['usuario' => $usuario, 'rol' => $rol])
            . view('gespe/panelInicio', [
                'usuario' => $usuario,
                'rol' => $rol,
                'permisosMesActual' => $permisosMesActual,
                'permisosTotales' => $permisosTotales
            ])
            . view('gespe/incluir/footer_app');
    }

    // Método privado para obtener los datos del usuario logueado
    private function getUserData()
    {
        // Verificar si el usuario está logueado
        if ($this->session->has('id_usuario')) {
            // Obtener los datos del usuario logueado por su ID
            return $this->usuarioModel->find($this->session->get('id_usuario'));
        } else {
            // Si no hay sesión activa, redirigir al login
            return redirect()->to('/login');
        }
    }
}
