<?php

namespace App\Controllers;

use App\Models\UsuarioModel; // Asumiendo que tienes un modelo de usuarios

class UsuarioController extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuarioModel(); // Inicializamos el modelo
    }

    // Mostrar la nómina de usuarios
    public function nomina()
    {
        $data['usuarios'] = $this->usuariosModel->findAll(); // Obtener todos los usuarios

        return view('nomina', $data); // Cargar la vista de nómina
    }

    // Cargar formulario para editar un usuario
    public function editar($id)
    {
        $data['usuario'] = $this->usuariosModel->find($id); // Obtener los datos del usuario por su ID

        return view('usuarios_editar', $data); // Cargar la vista de edición de usuario
    }

    // Guardar los cambios de edición de usuario
    public function actualizar($id)
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'rol' => $this->request->getPost('rol'),
        ];

        $this->usuariosModel->update($id, $data); // Actualizar los datos del usuario

        return redirect()->to('/nomina'); // Redirigir a la nómina de usuarios
    }

    // Eliminar un usuario
    public function eliminar($id)
    {
        $this->usuariosModel->delete($id); // Eliminar el usuario

        return redirect()->to('/nomina'); // Redirigir a la nómina de usuarios
    }
}
