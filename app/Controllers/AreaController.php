<?php

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\UsuarioModel;

class AreaController extends BaseController
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

        // Si no existe el usuario, retornar un error o redirigir
        if (!$usuario) {
            return ['usuario' => null, 'rol' => null];
        }

        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol']
        ];
    }

    public function listaArea()
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para acceder a esta página.');
        }

        $areaModel = new AreaModel();
        $areas = $areaModel->findAll();

        $data = array_merge($userData, ['areas' => $areas]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/area/listaArea', $data);
        echo view('gespe/incluir/footer_app');
    }

    public function nuevaArea()
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para acceder a esta página.');
        }

        echo view('gespe/incluir/header_app', $userData);
        echo view('gespe/area/nuevaArea');
        echo view('gespe/incluir/footer_app');
    }

    public function crearArea()
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

        $areaModel = new AreaModel();
        $areaModel->insert([
            'descripcion' => $this->request->getPost('nombre')
        ]);

        return redirect()->to('/gespe/area/listaArea')->with('success', 'Área creada exitosamente.');
    }

    // Modificar Área (formulario)
    public function modificar($id)
    {
        $userData = $this->getUserData();
        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }
        $areaModel = new AreaModel();
        $area = $areaModel->find($id);
        if (!$area) {
            return redirect()->to('/gespe/area/listaArea')->with('error', 'Área no encontrada.');
        }
        $data = array_merge($userData, ['area' => $area]);
        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/area/modificarArea', $data);
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
        $areaModel = new AreaModel();
        $areaModel->update($id, [
            'descripcion' => $this->request->getPost('nombre')
        ]);
        return redirect()->to('/gespe/area/listaArea')->with('success', 'Área actualizada exitosamente.');
    }


    // Eliminar Área
    public function eliminar($id)
    {
        $userData = $this->getUserData();

        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $areaModel = new AreaModel();
        $areaModel->delete($id);

        return redirect()->to('/gespe/area/listaArea')->with('success', 'Área eliminada exitosamente.');
    }
}
