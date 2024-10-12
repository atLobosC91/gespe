<?php

namespace App\Controllers;

use App\Models\SolicitudModel;
use App\Models\PermisoModel;
use App\Models\EstadoSolicitudModel;

class SolicitudController extends BaseController
{
    public function misPermisos()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtiene el ID del usuario que ha iniciado sesión
        $id_usuario = session()->get('id_usuario');

        // Obtén la información del usuario desde la base de datos
        $usuarioModel = new \App\Models\UsuarioModel();  // Suponiendo que tienes este modelo
        $usuario = $usuarioModel->find($id_usuario);

        // Instancia los modelos adicionales
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();

        // Obtén los permisos del usuario
        $permisos = $solicitudModel->where('id_usuario', $id_usuario)->findAll();

        // Para cada permiso, agrega la descripción del tipo de permiso y del estado
        foreach ($permisos as &$permiso) {
            $permiso['tipo_permiso'] = $permisoModel->find($permiso['id_permiso'])['descripcion'];
            $permiso['estado'] = $estadoModel->find($permiso['estado_solicitud'])['estado'];
        }

        // Pasar los permisos con los datos adicionales a la vista
        $data['permisos'] = $permisos;
        $data['usuario'] = $usuario;  // Asegúrate de pasar la variable usuario

        // Verificar si se solicitó el detalle de una solicitud específica
        $id_solicitud = $this->request->getGet('id_solicitud');
        if ($id_solicitud) {
            // Busca la solicitud seleccionada
            $data['detallePermiso'] = $solicitudModel->find($id_solicitud);

            // Agregar los detalles adicionales (descripción de permiso y estado)
            $data['detallePermiso']['tipo_permiso'] = $permisoModel->find($data['detallePermiso']['id_permiso'])['descripcion'];
            $data['detallePermiso']['estado'] = $estadoModel->find($data['detallePermiso']['estado_solicitud'])['estado'];
        } else {
            $data['detallePermiso'] = null;
        }

        // Carga las vistas
        echo view('gespe/incluir/header_app', $data);  // Aquí se pasa el dato $usuario
        echo view('gespe/solicitud/misSolicitudes', $data);
        echo view('gespe/incluir/footer_app', $data);
    }

    public function nuevaSolicitud()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Instancia el modelo de permisos para obtener los tipos de permisos
        $permisoModel = new PermisoModel();
        $data['tiposPermiso'] = $permisoModel->findAll();  // Obtén los tipos de permisos disponibles

        // Cargar la vista del formulario para crear una nueva solicitud
        echo view('gespe/incluir/header_app');
        echo view('gespe/solicitud/nuevaSolicitud', $data);
        echo view('gespe/incluir/footer_app');
    }


    public function crearSolicitud()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Recibe los datos del formulario
        $data = [
            'id_usuario' => session()->get('id_usuario'),
            'id_permiso' => $this->request->getPost('id_permiso'),
            'fecha_hora_inicio' => $this->request->getPost('fecha_hora_inicio'),
            'fecha_hora_fin' => $this->request->getPost('fecha_hora_fin'),
            'motivo' => $this->request->getPost('motivo'),
            
            'estado_solicitud' => 1,  // Estado inicial (e.g. "en curso")
        ];

        // Mostrar los datos recibidos para depuración
        /* print_r($data);
        exit();  // Detener la ejecución temporalmente para inspeccionar los datos */

        // Instancia el modelo y guarda los datos
        $solicitudModel = new SolicitudModel();
        $solicitudModel->insert($data);

        // Redirige de vuelta a la lista de solicitudes
        return redirect()->to('gespe/solicitud/misSolicitudes');
    }
}
