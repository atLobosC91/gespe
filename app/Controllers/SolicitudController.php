<?php

namespace App\Controllers;

use App\Models\SolicitudModel;
use App\Models\PermisoModel;
use App\Models\EstadoSolicitudModel;
use App\Models\UsuarioModel;

class SolicitudController extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }
    public function misPermisos()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtiene el ID del usuario que ha iniciado sesión
        $id_usuario = session()->get('id_usuario');

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();

        // Configura cuántos permisos mostrar por página (5 por página)
        $perPage = 5;

        // Obtener las solicitudes paginadas para el usuario
        $permisos = $solicitudModel->where('id_usuario', $id_usuario)
            ->paginate($perPage, 'solicitudes');  // Paginación

        // Para cada permiso, agrega la descripción del tipo de permiso y estado
        foreach ($permisos as &$permiso) {
            $permiso['tipo_permiso'] = $permisoModel->find($permiso['id_permiso'])['descripcion'];
            $permiso['estado'] = $estadoModel->find($permiso['estado_solicitud'])['estado'];

            // Comprobar si se encuentra el supervisor
            $supervisor = (new \App\Models\UsuarioModel())->find($permiso['supervisor_id']);
            if ($supervisor && isset($supervisor['nombres'])) {
                $permiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
            } else {
                $permiso['supervisor'] = 'Supervisor no encontrado';
            }
        }

        // Obtener la página actual para pasarlo a la vista
        $currentPage = $this->request->getGet('page') ?? 1; // Default a la página 1 si no está presente

        // Pasar los permisos con los datos adicionales a la vista
        $data['permisos'] = $permisos;
        $data['pager'] = $solicitudModel->pager;  // Añadir el paginador al array de datos
        $data['currentPage'] = $currentPage; // Pasar la página actual
        $data['perPage'] = $perPage; // Pasar el número de elementos por página a la vista

        // Verificar si se ha seleccionado una solicitud para ver sus detalles
        $id_solicitud = $this->request->getGet('id_solicitud');
        if ($id_solicitud) {
            $detallePermiso = $solicitudModel->find($id_solicitud);
            if ($detallePermiso) {
                $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
                $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];

                $supervisor = (new \App\Models\UsuarioModel())->find($detallePermiso['supervisor_id']);
                if ($supervisor && isset($supervisor['nombres'])) {
                    $detallePermiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
                } else {
                    $detallePermiso['supervisor'] = 'Supervisor no encontrado';
                }
                $data['detallePermiso'] = $detallePermiso;
            }
        } else {
            $data['detallePermiso'] = null;
        }

        // Cargar las vistas
        echo view('gespe/incluir/header_app', $data);
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

        // Obtener la lista de supervisores (id_rol = 3 en este ejemplo)
        $usuarioModel = new \App\Models\UsuarioModel();
        $data['supervisores'] = $usuarioModel->findUsersByRole(3);  // Asumiendo que el rol 3 es de supervisor

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
        $fecha_hora_inicio = $this->request->getPost('fecha_hora_inicio');
        $fecha_hora_fin = $this->request->getPost('fecha_hora_fin');

        // Convertir las fechas y horas a objetos DateTime para compararlas
        $inicio = new \DateTime($fecha_hora_inicio);
        $fin = new \DateTime($fecha_hora_fin);

        // Validar que la fecha de término no sea anterior a la de inicio
        if ($fin < $inicio) {
            return redirect()->back()->withInput()->with('error', 'La fecha y hora de término no puede ser anterior a la de inicio.');
        }

        // Validar si la fecha de inicio y término son iguales, entonces la hora de término debe ser posterior a la de inicio
        if ($inicio->format('Y-m-d') === $fin->format('Y-m-d')) {
            if ($fin <= $inicio) {
                return redirect()->back()->withInput()->with('error', 'La hora de término debe ser posterior a la hora de inicio cuando las fechas son iguales.');
            }
        }

        // Si las validaciones pasan, crear la solicitud
        $data = [
            'id_usuario' => session()->get('id_usuario'),
            'id_permiso' => $this->request->getPost('id_permiso'),
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'motivo' => $this->request->getPost('motivo'),
            'supervisor_id' => $this->request->getPost('id_supervisor'),
            'estado_solicitud' => 1,  // Estado inicial (por ejemplo, "en curso")
        ];

        // Instancia el modelo y guarda los datos
        $solicitudModel = new SolicitudModel();
        $solicitudModel->insert($data);

        // Redirige de vuelta a la lista de solicitudes
        return redirect()->to('gespe/solicitud/misSolicitudes')->with('success', 'Solicitud creada exitosamente.');
    }

    public function mi_perfil()
    {
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtener el usuario actual
        $id_usuario = session()->get('id_usuario');
        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find($id_usuario);

        // Obtener el rol del usuario
        $rol = $usuario['id_rol'];

        // Pasar los datos a la vista
        $data = [
            'usuario' => $usuario,
            'rol' => $rol  // Asegúrate de pasar la variable rol
        ];
        echo view('gespe/incluir/header_app');
        echo view('gespe/perfil/mi_perfil', $data);
        echo view('gespe/incluir/footer_app');
    }

    public function actualizarPerfil()
    {
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Validación de los datos recibidos
        $validation = \Config\Services::validation();

        $validation->setRules([
            'usuario' => 'required|min_length[3]|max_length[50]',
            'nombres' => 'required|min_length[3]|max_length[100]',
            'apellidos' => 'required|min_length[3]|max_length[100]',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'correo' => 'required|valid_email',
            'direccion' => 'required|max_length[100]'
        ]);

        // Si se ingresa una nueva contraseña, validarla.
        if ($this->request->getPost('password')) {
            $validation->setRule('password', 'Contraseña', 'min_length[8]|max_length[255]');
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id_usuario = session()->get('id_usuario');
        $usuarioModel = new \App\Models\UsuarioModel();

        // Construir los datos a actualizar
        $dataToUpdate = [
            'usuario' => $this->request->getPost('usuario'),
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'telefono' => $this->request->getPost('telefono'),
            'correo' => $this->request->getPost('correo'),
            'direccion' => $this->request->getPost('direccion')
        ];

        // Solo actualizar la contraseña si el campo no está vacío
        if ($this->request->getPost('password')) {
            $dataToUpdate['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id_usuario, $dataToUpdate);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }


  
    public function solicitudesDerivadas()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtiene el ID del supervisor que ha iniciado sesión
        $id_supervisor = session()->get('id_usuario');

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener todas las solicitudes donde el supervisor_id es el del usuario logueado
        $solicitudes = $solicitudModel->where('supervisor_id', $id_supervisor)
            ->orderBy('fecha_hora_inicio', 'DESC')
            ->findAll();

        // Para cada solicitud, agregar la información adicional (tipo de permiso, estado, solicitante)
        foreach ($solicitudes as &$solicitud) {
            $solicitud['tipo_permiso'] = $permisoModel->find($solicitud['id_permiso'])['descripcion'];
            $solicitud['estado'] = $estadoModel->find($solicitud['estado_solicitud'])['estado'];
            $usuario = $usuarioModel->find($solicitud['id_usuario']);
            $solicitud['solicitante'] = $usuario['nombres'] . ' ' . $usuario['apellidos'];
        }

        // Pasar los datos a la vista
        $data['solicitudes'] = $solicitudes;

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/solicitudesDerivadas', $data);
        echo view('gespe/incluir/footer_app', $data);
    }

    public function aprobarSolicitud($id_solicitud)
    {
        // Lógica para aprobar la solicitud y derivarla a administración
        // Actualiza el estado de la solicitud o marca que ha sido derivada
        $solicitudModel = new SolicitudModel();
        $solicitudModel->update($id_solicitud, ['estado_solicitud' => 2]); // Estado 2 podría ser "Aprobada"
        return redirect()->to('gespe/solicitud/solicitudesDerivadas');
    }

    public function rechazarSolicitud($id_solicitud)
    {
        // Lógica para rechazar la solicitud
        $solicitudModel = new SolicitudModel();
        $solicitudModel->update($id_solicitud, ['estado_solicitud' => 3]);
        return redirect()->to('gespe/solicitud/solicitudesDerivadas');
    }
}
