<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        $model = new UsuarioModel();

        // Obtener todos los usuarios
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index', $data);
    }

    public function crear()
    {
        return view('usuarios/crear');
    }

    public function guardar()
    {
        $model = new UsuarioModel();

        $data = [
            'usuario' => $this->request->getPost('usuario'),
            'pass' => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'correo' => $this->request->getPost('correo'),
        ];

        $model->save($data);

        return redirect()->to('/usuarios');
    }
}
