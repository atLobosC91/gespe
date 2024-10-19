<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class PerfilController extends Controller
{
    public function mi_perfil()
    {
        // Obtener la información del usuario actual
        $usuarioModel = new UsuarioModel();
        $session = session();
        $usuario_id = $session->get('id_usuario'); // Asumiendo que guardaste el ID del usuario en la sesión
        $usuario = $usuarioModel->find($usuario_id);

        // Verificar si el usuario está logueado
        if (!$session->get('id_usuario') || !$session->get('id_rol')) {
            return redirect()->to('/login')->with('error', 'Inicia sesión para acceder a tu perfil.');
        }

        // Crear la variable $data para pasar a las vistas
        $data = [
            'usuario' => $usuario,
            'rol' => $session->get('id_rol')
        ];

        // Cargar la vista de perfil con los datos del usuario
        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/perfil/mi_perfil', $data);
        echo view('gespe/incluir/footer_app', $data);
    }


    public function actualizarPerfil()
    {
        // Instancia del modelo de usuario
        $usuarioModel = new UsuarioModel();
        $session = session();
        $usuario_id = $session->get('id_usuario');

        // Validar los datos del formulario
        $data = $this->request->getPost();
        $rules = [
            'usuario' => 'required|min_length[3]|max_length[20]',
            'nombres' => 'required|min_length[2]|max_length[100]',
            'apellidos' => 'required|min_length[2]|max_length[100]',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'correo' => 'required|valid_email',
            'direccion' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Actualizar los datos del usuario en la base de datos
        $usuarioModel->update($usuario_id, $data);

        return redirect()->to('gespe/perfil/mi_perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
