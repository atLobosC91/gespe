<?php

namespace App\Controllers;

use App\Models\UsuarioModel;  // Importa tu modelo de usuario

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
            // Verificar la contraseña
            if ($userData['password'] == $password) {
                // Guardar los datos de usuario en la sesión
                $session->set('id_usuario', $userData['id_usuario']);
                $session->set('usuario', $userData['usuario']);
                $session->set('id_rol', $userData['id_rol']);

                // Redirigir según el rol
                switch ($userData['id_rol']) {
                    case 1: // Gerente
                        return redirect()->to('/gespe/gerente/panelInicio');
                    case 2: // Administrador
                        return redirect()->to('/gespe/administrador/panelInicio');
                    case 3: // Supervisor
                        return redirect()->to('/gespe/supervisor/panelInicio');
                    case 4: // Operativo
                        return redirect()->to('/gespe/operativo/panelInicio');
                    default:
                        return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
