<?php

namespace App\Controllers;

use App\Models\SolicitudModel;
use App\Models\PermisoModel;
use App\Models\EstadoSolicitudModel;
use App\Models\UsuarioModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class PermisoController extends BaseController
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

        $id_usuario = session()->get('id_usuario');
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id_usuario);

        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol'],
            'area' => $usuario['id_area']
        ];
    }

    // Mostrar las solicitudes de permisos para operativos y supervisores
    public function misSolicitudes()
    {
        $userData = $this->getUserData();
        $id_usuario = $userData['usuario']['id_usuario'];

        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        $search = $this->request->getGet('search');
        $perPage = 5;

        if ($search) {
            $permisos = $solicitudModel->like('descripcion', $search)
                ->orLike('estado_solicitud', $search)
                ->where('id_usuario', $id_usuario)
                ->paginate($perPage, 'solicitudes');
        } else {
            $permisos = $solicitudModel->where('id_usuario', $id_usuario)
                ->paginate($perPage, 'solicitudes');
        }

        foreach ($permisos as &$permiso) {
            $permiso['tipo_permiso'] = $permisoModel->find($permiso['id_permiso'])['descripcion'];
            $permiso['estado'] = $estadoModel->find($permiso['estado_solicitud'])['estado'];

            $supervisor = $usuarioModel->find($permiso['supervisor_id']);

            if ($supervisor && isset($supervisor['nombres'], $supervisor['apellidos'])) {
                $permiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
            } else {
                $permiso['supervisor'] = 'Sin Supervisor';
            }
        }

        $data = array_merge($userData, [
            'permisos' => $permisos,
            'pager' => $solicitudModel->pager,
            'search' => $search,
            'currentPage' => $this->request->getGet('page') ?? 1,
            'perPage' => $perPage
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/misSolicitudes', $data);
        echo view('gespe/incluir/footer_app', $data);
    }

    public function nuevaSolicitud()
    {
        $userData = $this->getUserData();

        $permisoModel = new PermisoModel();
        $usuarioModel = new UsuarioModel();

        // Obtener supervisores (id_rol = 3) y administradores (id_rol = 2)
        $supervisores = $usuarioModel->where('id_rol', 3)->findAll();  // Supervisores
        $administradores = $usuarioModel->where('id_rol', 2)->findAll();  // Administradores

        $data = array_merge($userData, [
            'tiposPermiso' => $permisoModel->findAll(),
            'supervisores' => $supervisores,
            'administradores' => $administradores,
            'rol' => $userData['rol'] // Pasar el rol a la vista
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/nuevaSolicitud', $data);
        echo view('gespe/incluir/footer_app', $data);
    }



    public function crearSolicitud()
    {
        $userData = $this->getUserData();

        $fecha_hora_inicio = $this->request->getPost('fecha_hora_inicio');
        $fecha_hora_fin = $this->request->getPost('fecha_hora_fin');

        $inicio = new \DateTime($fecha_hora_inicio);
        $fin = new \DateTime($fecha_hora_fin);

        if ($fin < $inicio) {
            return redirect()->back()->withInput()->with('error', 'La fecha de fin no puede ser anterior a la fecha de inicio.');
        }

        $supervisor_id = $this->request->getPost('id_supervisor');
        if (empty($supervisor_id)) {
            $supervisor_id = $this->getAdminDefault();
        }

        $data = [
            'id_usuario' => $userData['usuario']['id_usuario'],
            'id_permiso' => $this->request->getPost('id_permiso'),
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'motivo' => $this->request->getPost('motivo'),
            'supervisor_id' => $supervisor_id,
            'estado_solicitud' => 1 // Estado pendiente
        ];

        $solicitudModel = new SolicitudModel();
        $solicitudModel->insert($data);

        return redirect()->to('gespe/solicitud/misSolicitudes')->with('success', 'Solicitud creada correctamente.');
    }

    public function obtenerDetallesPermiso($id_solicitud)
    {
        $userData = $this->getUserData();

        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        $detallePermiso = $solicitudModel->find($id_solicitud);

        if ($detallePermiso) {
            $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
            $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);
            $detallePermiso['supervisor'] = $supervisor ? $supervisor['nombres'] . ' ' . $supervisor['apellidos'] : 'Sin Supervisor';

            // Verificar si fue derivada
            if (!empty($detallePermiso['administrador_id'])) {
                $administrador = $usuarioModel->find($detallePermiso['administrador_id']);
                $detallePermiso['derivado_a'] = $administrador ? $administrador['nombres'] . ' ' . $administrador['apellidos'] : 'No Derivado';
            }

            // Verificar si fue aprobada o rechazada
            if (!empty($detallePermiso['aprobador_id'])) {
                $aprobador = $usuarioModel->find($detallePermiso['aprobador_id']);
                $detallePermiso['aprobador'] = $aprobador ? $aprobador['nombres'] . ' ' . $aprobador['apellidos'] : 'No aprobado/rechazado';
            }
        }

        $data = array_merge($userData, [
            'detallePermiso' => $detallePermiso
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/detalleSolicitud', $data);
        echo view('gespe/incluir/footer_app');
    }


    private function getAdminDefault()
    {
        $usuarioModel = new UsuarioModel();
        $admin = $usuarioModel->where('id_rol', 2)->first();
        return $admin ? $admin['id_usuario'] : null;
    }



    public function descargarPDF($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener el detalle del permiso
        $detallePermiso = $solicitudModel->find($id_solicitud);

        if ($detallePermiso) {
            $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
            $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);
            $detallePermiso['supervisor'] = $supervisor ? $supervisor['nombres'] . ' ' . $supervisor['apellidos'] : 'Sin Supervisor';

            // Solo permitir descarga si está aprobado
            if ($detallePermiso['estado'] != 'Aprobado') {
                return redirect()->back()->with('error', 'Solo se pueden descargar permisos aprobados.');
            }

            // Crear PDF usando Dompdf
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            $data = [
                'detallePermiso' => $detallePermiso
            ];

            // Generar la vista del PDF
            $html = view('gespe/solicitud/pdfSolicitud', $data);
            $dompdf->loadHtml($html);

            // Configurar el tamaño y la orientación
            $dompdf->setPaper('A4', 'portrait');

            // Renderizar el PDF
            $dompdf->render();

            // Enviar el PDF al navegador
            $dompdf->stream("solicitud_" . $detallePermiso['id_solicitud'] . ".pdf", array("Attachment" => 1));
        } else {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }
    }

    public function eliminarSolicitud($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();

        // Buscar la solicitud y eliminarla
        $solicitud = $solicitudModel->find($id_solicitud);

        if ($solicitud) {
            $solicitudModel->delete($id_solicitud);
            return redirect()->to('gespe/solicitud/misSolicitudes')->with('success', 'Solicitud eliminada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró la solicitud.');
        }
    }
}
