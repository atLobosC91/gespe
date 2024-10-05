<?php

namespace App\Controllers;

use App\Models\PermisoModel;

class PermisoController extends BaseController
{
    protected $permisosModel;

    public function __construct()
    {
        $this->permisosModel = new PermisoModel(); // Inicializamos el modelo
    }

    // Muestra la lista de permisos para el administrador
    public function index()
    {
        $data['permisos'] = $this->permisosModel->findAll(); // Obtener todos los permisos

        return view('permisos_adm', $data); // Cargar la vista de permisos
    }

    // Cargar formulario para crear un nuevo permiso
    public function nuevo()
    {
        return view('permisos/permisoNuevo'); // Cargar la vista para crear un nuevo permiso
    }

    // Guardar el nuevo permiso en la base de datos
    public function crear()
    {
        $data = [
            'motivo' => $this->request->getPost('motivo'),
            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
            'fecha_fin' => $this->request->getPost('fecha_fin'),
            'estado' => 'Pendiente',
        ];

        $this->permisosModel->save($data); // Guardar el nuevo permiso

        return redirect()->to('/permisos_adm'); // Redirigir al listado de permisos
    }

    // Aceptar un permiso
    public function aceptar($id)
    {
        $this->permisosModel->update($id, ['estado' => 'Aceptado']); // Actualizar el estado del permiso

        return redirect()->to('/permisos_adm'); // Redirigir al listado de permisos
    }

    // Rechazar un permiso
    public function rechazar($id)
    {
        $this->permisosModel->update($id, ['estado' => 'Rechazado']); // Actualizar el estado del permiso

        return redirect()->to('/permisos_adm'); // Redirigir al listado de permisos
    }
}
