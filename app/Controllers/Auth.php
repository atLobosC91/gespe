<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function index()
    {
        // Mostrar la vista de login
        return view('login');
    }

    public function login()
    {
        $session = session();
        $usuarioModel = new UsuarioModel();

        // Obtener los datos del formulario
        $usuario = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');

        // Buscar el usuario en la base de datos
        $userData = $usuarioModel->where('usuario', $usuario)->first();

        // Validar si existe el usuario
        if ($userData) {
            // Verificar la contraseña usando password_verify para comparar el hash
            if (password_verify($password, $userData['password'])) {
                // Guardar los datos de usuario en la sesión
                $session->set('id_usuario', $userData['id_usuario']);
                $session->set('usuario', $userData['usuario']);
                $session->set('id_rol', $userData['id_rol']); // Guardar el rol del usuario en la sesión

                // Redirigir al panel de inicio unificado
                return redirect()->to('/gespe/panelInicio');
            } else {
                // Contraseña incorrecta
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->to('/login');
            }
        } else {
            // Usuario no encontrado
            $session->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        // Destruir la sesión y redirigir al login
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
