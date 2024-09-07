<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login/login');  // Muestra la vista de login
    }

   /*  public function login()
    {
        $model = new UsuarioModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $usuario = $model->verificarUsuario($email, $password);

        if ($usuario) {
            // Usuario encontrado, guardar datos en la sesión
            $this->session->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'logged_in' => true
            ]);

            // Redirigir al dashboard según el rol
            if ($usuario['rol'] == '1') {
                return redirect()->to('/dashboard/administrador');
            } elseif ($usuario['rol'] == '2') {
                return redirect()->to('/dashboard/supervisor');
            } elseif ($usuario['rol'] == '3') {
                return redirect()->to('/dashboard/operativo');
            } else {
                return redirect()->to('/dashboard/gerente');  // Rol por defecto
            }

        } else {
            // Usuario no encontrado o contraseña incorrecta
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    } */
}