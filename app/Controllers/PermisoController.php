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

        // Determinar si se ha seleccionado un supervisor o administrador
        $tipo_responsable = $this->request->getPost('tipo_responsable');

        if ($tipo_responsable === 'supervisor') {
            $responsable_id = $this->request->getPost('supervisor_id');
        } else {
            $responsable_id = $this->request->getPost('administrador_id');
        }

        if (empty($responsable_id)) {
            return redirect()->back()->with('error', 'Debe seleccionar un responsable para la solicitud.');
        }

        $data = [
            'id_usuario' => $userData['usuario']['id_usuario'],
            'id_permiso' => $this->request->getPost('id_permiso'),
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'motivo' => $this->request->getPost('motivo'),
            'supervisor_id' => ($tipo_responsable === 'supervisor') ? $responsable_id : null, // Guardar en `supervisor_id` solo si es supervisor
            'administrador_id' => ($tipo_responsable === 'administrador') ? $responsable_id : null, // Guardar en `administrador_id` si es administrador
            'estado_solicitud' => 1 // Estado en curso
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

            // Verificación del supervisor
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);
            $detallePermiso['supervisor'] = ($supervisor && isset($supervisor['nombres']) && isset($supervisor['apellidos']))
                ? $supervisor['nombres'] . ' ' . $supervisor['apellidos']
                : 'Sin Supervisor';

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

    public function solicitudesDerivadas()
    {
        $userData = $this->getUserData();
        $id_usuario = $userData['usuario']['id_usuario'];
        $rol = $userData['rol'];

        $model = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $usuarioModel = new UsuarioModel();

        $search = $this->request->getGet('search');
        $perPage = 5;

        $solicitudes = [];

        if ($rol == 2) { // Administrador
            if ($search) {
                $solicitudes = $model->like('tipo_permiso', $search)
                    ->orLike('estado_solicitud', $search)
                    ->where('administrador_id', $id_usuario)
                    ->paginate($perPage);
            } else {
                $solicitudes = $model->where('administrador_id', $id_usuario)
                    ->paginate($perPage);
            }
        } elseif ($rol == 3) { // Supervisor
            if ($search) {
                $solicitudes = $model->like('tipo_permiso', $search)
                    ->orLike('estado_solicitud', $search)
                    ->where('supervisor_id', $id_usuario)
                    ->paginate($perPage);
            } else {
                $solicitudes = $model->where('supervisor_id', $id_usuario)
                    ->paginate($perPage);
            }
        }

        // Agregar información adicional (supervisor, administrador, solicitante)
        foreach ($solicitudes as &$solicitud) {
            $permiso = $permisoModel->find($solicitud['id_permiso']);
            $solicitud['tipo_permiso'] = $permiso ? $permiso['descripcion'] : 'N/A';

            // Obtener nombre del solicitante
            $usuario = $usuarioModel->find($solicitud['id_usuario']);
            $solicitud['solicitado_por'] = ($usuario && isset($usuario['nombres']) && isset($usuario['apellidos']))
                ? $usuario['nombres'] . ' ' . $usuario['apellidos']
                : 'Usuario no encontrado';

            // Obtener nombre del supervisor
            $supervisor = $usuarioModel->find($solicitud['supervisor_id']);
            $solicitud['supervisor'] = ($supervisor && isset($supervisor['nombres']) && isset($supervisor['apellidos']))
                ? $supervisor['nombres'] . ' ' . $supervisor['apellidos']
                : 'Sin Supervisor';

            // Obtener nombre del administrador si está derivada
            $administrador = $usuarioModel->find($solicitud['administrador_id']);
            $solicitud['administrador'] = ($administrador && isset($administrador['nombres']) && isset($administrador['apellidos']))
                ? $administrador['nombres'] . ' ' . $administrador['apellidos']
                : 'No Derivada';
        }

        $data['solicitudesDerivadas'] = $solicitudes;
        $data['pager'] = $model->pager;
        $data['search'] = $search;
        $data = array_merge($userData, $data);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitudesDerivadas/solicitudesDerivadas', $data);
        echo view('gespe/incluir/footer_app', $data);
    }


    public function obtenerDetalleSolicitudDerivada($id_solicitud)
    {
        $userData = $this->getUserData();

        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener los detalles de la solicitud
        $detallePermiso = $solicitudModel->find($id_solicitud);

        if ($detallePermiso) {
            // Obtener tipo de permiso, estado y el supervisor
            $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
            $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];

            // Verificar y obtener el supervisor
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);
            $detallePermiso['supervisor'] = ($supervisor && isset($supervisor['nombres']) && isset($supervisor['apellidos']))
                ? $supervisor['nombres'] . ' ' . $supervisor['apellidos']
                : 'Sin Supervisor';

            // Verificar y obtener el solicitante
            $solicitante = $usuarioModel->find($detallePermiso['id_usuario']);
            $detallePermiso['solicitado_por'] = ($solicitante && isset($solicitante['nombres']) && isset($solicitante['apellidos']))
                ? $solicitante['nombres'] . ' ' . $solicitante['apellidos']
                : 'Usuario no encontrado';
        }

        // Obtener los administradores a quienes se puede derivar (id_rol = 2)
        $administradores = $usuarioModel->where('id_rol', 2)->findAll();

        $data = array_merge($userData, [
            'detallePermiso' => $detallePermiso,
            'administradores' => $administradores,
            'rol' => $userData['rol'], // Incluye el rol en los datos
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitudesDerivadas/detalleSolicitudDerivada', $data);
        echo view('gespe/incluir/footer_app');
    }


    public function derivarSolicitud($id_solicitud)
    {
        // Obtener el administrador seleccionado desde el formulario
        $administrador_id = $this->request->getPost('administrador_id');

        if (empty($administrador_id)) {
            return redirect()->back()->with('error', 'Debe seleccionar un administrador para derivar.');
        }

        // Actualizar la solicitud con el administrador seleccionado y el estado a "Derivada"
        $solicitudModel = new SolicitudModel();
        $data = [
            'administrador_id' => $administrador_id,
            'estado_solicitud' => 4  // Cambiar el estado a "Derivada"
        ];

        $solicitudModel->update($id_solicitud, $data);

        return redirect()->to('gespe/solicitudesDerivadas')->with('success', 'Solicitud derivada correctamente al administrador.');
    }




    public function rechazarSolicitudDerivada($id_solicitud)
    {
        $motivo = $this->request->getPost('motivo');

        // Aquí actualizarías la base de datos para rechazar la solicitud y guardar el motivo.
        return redirect()->back()->with('success', 'Solicitud rechazada con motivo: ' . $motivo);
    }

    public function aprobarSolicitud($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();

        // Actualizar el estado de la solicitud a "Aprobada"
        $data = [
            'estado_solicitud' => 2,  // 2 será el estado correspondiente a "Aprobada"
            'aprobador_id' => session()->get('id_usuario'), // Guardar quién aprobó
        ];

        // Actualizar el registro en la base de datos
        $solicitudModel->update($id_solicitud, $data);

        return redirect()->to('gespe/solicitudesDerivadas')->with('success', 'Solicitud aprobada correctamente.');
    }

    public function derivadoPDF($id_solicitud)
    {
        // Obtener datos del usuario logueado
        $userData = $this->getUserData();

        // Verificar que el usuario sea supervisor o administrador
        if ($userData['rol'] != 2 && $userData['rol'] != 3) {
            return redirect()->back()->with('error', 'No tienes permiso para descargar este archivo.');
        }

        // Cargar los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener los detalles de la solicitud
        $detallePermiso = $solicitudModel->find($id_solicitud);

        if ($detallePermiso) {
            // Obtener datos adicionales
            $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
            $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];

            // Verificar si existe un supervisor
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);
            if ($supervisor && isset($supervisor['nombres'], $supervisor['apellidos'])) {
                $detallePermiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
            } else {
                $detallePermiso['supervisor'] = 'Sin Supervisor';
            }

            // Verificar si existe el solicitante
            $solicitante = $usuarioModel->find($detallePermiso['id_usuario']);
            if ($solicitante && isset($solicitante['nombres'], $solicitante['apellidos'])) {
                $detallePermiso['solicitado_por'] = $solicitante['nombres'] . ' ' . $solicitante['apellidos'];
            } else {
                $detallePermiso['solicitado_por'] = 'Usuario no encontrado';
            }

            // Verificar si la solicitud está aprobada
            if ($detallePermiso['estado'] != 'Aprobada') {
                return redirect()->back()->with('error', 'Solo se pueden descargar solicitudes aprobadas.');
            }
        } else {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }

        // Crear la vista que quieres renderizar como PDF
        $data = [
            'detallePermiso' => $detallePermiso
        ];

        // Cargar Dompdf
        $dompdf = new Dompdf();
        $html = view('gespe/solicitud/pdfSolicitudDerivada', $data);
        $dompdf->loadHtml($html);

        // Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Guardar el PDF en una carpeta del servidor
        $output = $dompdf->output();
        $pdfFilePath = WRITEPATH . 'pdfs/solicitud_derivada_' . $id_solicitud . '.pdf';
        file_put_contents($pdfFilePath, $output);

        // Devolver el PDF como descarga
        return $this->response->download($pdfFilePath, null)->setFileName('solicitud_derivada_' . $id_solicitud . '.pdf');
    }
}
