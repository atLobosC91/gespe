<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Gespe extends BaseController
{
    protected $usuarioModel;
    protected $session;

    public function __construct()
    {
        // Inicializar el modelo y la sesión
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
    }

    public function gerente()
    {
        // Obtener datos del usuario logueado
        $usuario = $this->getUserData();

        // Pasar los datos a la vista
        return view('gespe/gerente/panelInicio', ['usuario' => $usuario]);
    }

    public function administrador()
    {
        // Obtener datos del usuario logueado
        $usuario = $this->getUserData();

        // Pasar los datos a la vista
        return view('gespe/administrador/panelInicio', ['usuario' => $usuario]);
    }

    public function supervisor()
    {
        // Obtener datos del usuario logueado
        $usuario = $this->getUserData();

        // Pasar los datos a la vista
        return view('gespe/supervisor/panelInicio', ['usuario' => $usuario]);
    }

    public function operativo()
    {
        // Obtener datos del usuario logueado
        $usuario = $this->getUserData();

        // Pasar los datos a la vista
        return view('gespe/operativo/panelInicio', ['usuario' => $usuario]);
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
