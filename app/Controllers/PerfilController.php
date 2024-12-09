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
        $especialidadModel = new \App\Models\EspecialidadModel();
        $areaModel = new \App\Models\AreaModel(); // Asegúrate de tener este modelo
        $session = session();
        $usuario_id = $session->get('id_usuario');
        $usuario = $usuarioModel->find($usuario_id);

        if (!$session->get('id_usuario') || !$session->get('id_rol')) {
            return redirect()->to('/login')->with('error', 'Inicia sesión para acceder a tu perfil.');
        }

        // Obtener la lista de especialidades y áreas
        $especialidades = $especialidadModel->findAll();
        $areas = $areaModel->findAll();

        // Datos para la vista
        $data = [
            'usuario' => $usuario,
            'especialidades' => $especialidades, // Enviar especialidades a la vista
            'areas' => $areas, // Enviar áreas a la vista
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
            'id_area' => 'required|is_not_unique[area.id_area]', // Validación para área
            'id_especialidad' => 'required|is_not_unique[especialidad.id]' // Validación para especialidad
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Construir los datos a actualizar
        $updateData = [
            'usuario' => $data['usuario'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'id_area' => $data['id_area'], // Área seleccionada
            'id_especialidad' => $data['id_especialidad'], // Especialidad seleccionada
        ];

        // Procesar la contraseña si se proporciona
        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Actualizar los datos del usuario en la base de datos
        if (!$usuarioModel->update($usuario_id, $updateData)) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el perfil. Intente nuevamente.');
        }

        return redirect()->to('gespe/perfil/mi_perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
