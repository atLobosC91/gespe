<?php

namespace App\Controllers;

use App\Models\EspecialidadModel;
use App\Models\UsuarioModel;

class EspecialidadController extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    private function getUserData()
    {
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtener el usuario logueado
        $id_usuario = session()->get('id_usuario');
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id_usuario);

        if (!$usuario) {
            return ['usuario' => null, 'rol' => null];
        }

        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol']
        ];
    }

    public function listaEspecialidad()
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para acceder a esta página.');
        }

        $especialidadModel = new EspecialidadModel();
        $especialidades = $especialidadModel->findAll();

        $data = array_merge($userData, ['especialidades' => $especialidades]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/especialidad/listaEspecialidad', $data);
        echo view('gespe/incluir/footer_app');
    }

    public function nuevaEspecialidad()
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para acceder a esta página.');
        }

        echo view('gespe/incluir/header_app', $userData);
        echo view('gespe/especialidad/nuevaEspecialidad');
        echo view('gespe/incluir/footer_app');
    }

    public function crearEspecialidad()
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[100]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $especialidadModel = new EspecialidadModel();
        $especialidadModel->insert([
            'descripcion' => $this->request->getPost('nombre')
        ]);

        return redirect()->to('/gespe/especialidad/listaEspecialidad')->with('success', 'Especialidad creada exitosamente.');
    }

    public function modificar($id)
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $especialidadModel = new EspecialidadModel();
        $especialidad = $especialidadModel->find($id);

        if (!$especialidad) {
            return redirect()->to('/gespe/especialidad/listaEspecialidad')->with('error', 'Especialidad no encontrada.');
        }

        $data = array_merge($userData, ['especialidad' => $especialidad]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/especialidad/modificarEspecialidad', $data);
        echo view('gespe/incluir/footer_app');
    }

    public function actualizar($id)
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[100]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $especialidadModel = new EspecialidadModel();
        $especialidadModel->update($id, [
            'descripcion' => $this->request->getPost('nombre')
        ]);

        return redirect()->to('/gespe/especialidad/listaEspecialidad')->with('success', 'Especialidad actualizada exitosamente.');
    }

    public function eliminar($id)
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $especialidadModel = new EspecialidadModel();
        $especialidadModel->delete($id);

        return redirect()->to('/gespe/especialidad/listaEspecialidad')->with('success', 'Especialidad eliminada exitosamente.');
    }
}
