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

        // Cargar la vista unificada con el rol y los datos del usuario
        return view('gespe/incluir/header_app', ['usuario' => $usuario, 'rol' => $rol])
            . view('gespe/panelInicio', ['usuario' => $usuario, 'rol' => $rol])
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
