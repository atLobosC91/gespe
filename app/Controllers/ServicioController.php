<?php

namespace App\Controllers;

use App\Models\ServicioModel; // Asumiendo que tienes un modelo de servicios

class ServicioController extends BaseController
{
    protected $serviciosModel;

    public function __construct()
    {
        $this->serviciosModel = new ServicioModel(); // Inicializamos el modelo
    }

    // Mostrar la lista de servicios
    public function index()
    {
        $data['servicios'] = $this->serviciosModel->findAll(); // Obtener todos los servicios

        return view('servicios', $data); // Cargar la vista de servicios
    }

    // Cargar formulario para agregar un nuevo servicio
    public function nuevo()
    {
        return view('servicio_nuevo'); // Cargar la vista para crear un nuevo servicio
    }

    // Guardar el nuevo servicio en la base de datos
    public function crear()
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        $this->serviciosModel->save($data); // Guardar el nuevo servicio

        return redirect()->to('/servicios'); // Redirigir al listado de servicios
    }

    // Cargar formulario para editar un servicio
    public function editar($id)
    {
        $data['servicio'] = $this->serviciosModel->find($id); // Obtener los datos del servicio por su ID

        return view('servicio_editar', $data); // Cargar la vista de edición de servicio
    }

    // Guardar los cambios de edición de servicio
    public function actualizar($id)
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        $this->serviciosModel->update($id, $data); // Actualizar los datos del servicio

        return redirect()->to('/servicios'); // Redirigir al listado de servicios
    }

    // Eliminar un servicio
    public function eliminar($id)
    {
        $this->serviciosModel->delete($id); // Eliminar el servicio

        return redirect()->to('/servicios'); // Redirigir al listado de servicios
    }
}
