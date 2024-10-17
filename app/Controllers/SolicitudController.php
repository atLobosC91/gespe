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

    // Obtener el usuario y su rol para todas las vistas
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
            // Manejar el error de usuario no encontrado
            return ['usuario' => null, 'rol' => null];  // O puedes hacer un redireccionamiento
        }

        // Pasamos el usuario completo y el rol
        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol']
        ];
    }


    public function misPermisos()
    {
        // Verifica que el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login');
        }

        // Obtener los datos del usuario (incluyendo el rol)
        $userData = $this->getUserData(); // Método que obtendrá los datos de usuario y rol

        // Obtiene el ID del usuario que ha iniciado sesión
        $id_usuario = session()->get('id_usuario');

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel(); // Asegúrate de tener el modelo de Usuario

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
            $supervisor = $usuarioModel->find($permiso['supervisor_id']);

            // Verificar si el supervisor existe y tiene los campos 'nombres' y 'apellidos'
            if ($supervisor && isset($supervisor['nombres']) && isset($supervisor['apellidos'])) {
                $permiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
            } else {
                $permiso['supervisor'] = 'Supervisor no encontrado';
            }
        }

        // Mezclar los datos del usuario con los permisos
        $data = array_merge($userData, [
            'permisos' => $permisos,
            'pager' => $solicitudModel->pager,  // Añadir el paginador al array de datos
            'currentPage' => $this->request->getGet('page') ?? 1, // Default a la página 1 si no está presente
            'perPage' => $perPage // Pasar el número de elementos por página a la vista
        ]);

        // Cargar las vistas
        echo view('gespe/incluir/header_app', $data);  // Ahora pasas el rol y usuario en $data
        echo view('gespe/solicitud/misSolicitudes', $data);
        echo view('gespe/incluir/footer_app', $data);
    }





    public function nuevaSolicitud()
    {
        $userData = $this->getUserData(); // Obtener usuario y rol

        // Si no hay usuario, redirigir
        if (!$userData['usuario']) {
            return redirect()->to('/login');
        }

        $permisoModel = new PermisoModel();
        $usuarioModel = new UsuarioModel();

        $data = array_merge($userData, [
            'tiposPermiso' => $permisoModel->findAll(),
            'supervisores' => $usuarioModel->findUsersByRole(3)
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/nuevaSolicitud', $data);
        echo view('gespe/incluir/footer_app', $data);
    }


    public function crearSolicitud()
    {
        $userData = $this->getUserData(); // Obtener usuario y rol

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
        if ($inicio->format('Y-m-d') === $fin->format('Y-m-d') && $fin <= $inicio) {
            return redirect()->back()->withInput()->with('error', 'La hora de término debe ser posterior a la hora de inicio cuando las fechas son iguales.');
        }

        // Si las validaciones pasan, crear la solicitud
        $data = [
            'id_usuario' => $userData['usuario']['id_usuario'],
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
        $userData = $this->getUserData(); // Obtener usuario y rol

        // Pasar los datos a la vista
        echo view('gespe/incluir/header_app', $userData);
        echo view('gespe/perfil/mi_perfil', $userData);
        echo view('gespe/incluir/footer_app');
    }

    public function actualizarPerfil()
    {
        $userData = $this->getUserData(); // Obtener usuario y rol

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

        $id_usuario = $userData['usuario']['id_usuario'];
        $usuarioModel = new UsuarioModel();

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
        $userData = $this->getUserData(); // Obtener usuario y rol

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Verificar que el usuario tenga rol de administrador
        if ($userData['rol'] != 2) {  // Asumimos que el rol de administrador es 2
            return redirect()->back()->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        // Obtener todas las solicitudes donde el administrador_id es el del usuario logueado
        $solicitudes = $solicitudModel->where('administrador_id', $userData['usuario']['id_usuario'])
            ->orderBy('fecha_hora_inicio', 'DESC')
            ->findAll();

        // Para cada solicitud, agregar la información adicional (tipo de permiso, estado, solicitante)
        foreach ($solicitudes as &$solicitud) {
            $solicitud['tipo_permiso'] = $permisoModel->find($solicitud['id_permiso'])['descripcion'];
            $solicitud['estado'] = $estadoModel->find($solicitud['estado_solicitud'])['estado'];
            $usuario = $usuarioModel->find($solicitud['id_usuario']);
            $solicitud['solicitante'] = $usuario ? $usuario['nombres'] . ' ' . $usuario['apellidos'] : 'Solicitante no encontrado';
        }

        $data = array_merge($userData, [
            'solicitudes' => $solicitudes
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/solicitudesDerivadas', $data);
        echo view('gespe/incluir/footer_app');
    }


    public function aprobarSolicitud($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();
        // Cambia el estado de la solicitud a 'Aprobada' (suponiendo que el estado 2 es 'Aprobada')
        $solicitudModel->update($id_solicitud, ['estado_solicitud' => 2]);

        return redirect()->to('gespe/solicitud/solicitudesDerivadas')->with('success', 'Solicitud aprobada exitosamente.');
    }

    public function derivarSolicitud($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();
        $solicitud = $solicitudModel->find($id_solicitud);

        // Verificar si ya ha sido derivada
        if ($solicitud['estado_solicitud'] == 4) {
            return redirect()->back()->with('error', 'Esta solicitud ya ha sido derivada y no puede modificarse.');
        }

        // Consultar los administradores disponibles
        $administradores = $this->usuarioModel->where('id_rol', 2)->findAll();

        // Pasar los datos a la vista
        $data = [
            'solicitud' => $solicitud,
            'administradores' => $administradores
        ];

        // Cargar la vista para seleccionar el administrador
        echo view('gespe/solicitud/detalleSolicitudDerivada', $data);
    }


    public function procesarDerivacion()
    {
        $id_solicitud = $this->request->getPost('id_solicitud');
        $id_administrador = $this->request->getPost('id_administrador');

        $solicitudModel = new SolicitudModel();
        $solicitud = $solicitudModel->find($id_solicitud);

        // Verificar si la solicitud ya ha sido derivada
        if ($solicitud['estado_solicitud'] == 4) {
            return redirect()->back()->with('error', 'Esta solicitud ya ha sido derivada y no puede modificarse.');
        }

        // Actualizar la solicitud con el administrador seleccionado
        $solicitudModel->update($id_solicitud, [
            'estado_solicitud' => 4,  // Estado derivado
            'administrador_id' => $id_administrador // Asegúrate que este campo exista en tu tabla
        ]);

        return redirect()->to('gespe/solicitud/solicitudesDerivadas')->with('success', 'Solicitud derivada correctamente.');
    }



    public function rechazarSolicitud($id_solicitud)
    {
        $solicitudModel = new SolicitudModel();
        // Cambia el estado de la solicitud a 'Rechazada' (suponiendo que el estado 3 es 'Rechazada')
        $solicitudModel->update($id_solicitud, ['estado_solicitud' => 3]);

        return redirect()->to('gespe/solicitud/solicitudesDerivadas')->with('success', 'Solicitud rechazada exitosamente.');
    }

    public function obtenerDetallesPermiso($id_solicitud)
    {
        $userData = $this->getUserData(); // Obtener usuario y rol

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener los detalles de la solicitud por su ID
        $detallePermiso = $solicitudModel->find($id_solicitud);
        if ($detallePermiso) {
            $detallePermiso['tipo_permiso'] = $permisoModel->find($detallePermiso['id_permiso'])['descripcion'];
            $detallePermiso['estado'] = $estadoModel->find($detallePermiso['estado_solicitud'])['estado'];

            // Verificar si existe un supervisor asociado
            $supervisor = $usuarioModel->find($detallePermiso['supervisor_id']);

            // Verificar si el supervisor tiene los campos 'nombres' y 'apellidos'
            if ($supervisor && isset($supervisor['nombres']) && isset($supervisor['apellidos'])) {
                $detallePermiso['supervisor'] = $supervisor['nombres'] . ' ' . $supervisor['apellidos'];
            } else {
                $detallePermiso['supervisor'] = 'Supervisor no encontrado';
            }
        }

        $data = array_merge($userData, [
            'detallePermiso' => $detallePermiso
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/detalleSolicitud', $data);
        echo view('gespe/incluir/footer_app');
    }


    public function obtenerDetalleSolicitudDerivada($id_solicitud)
    {
        $userData = $this->getUserData(); // Obtener usuario y rol

        // Instancia los modelos necesarios
        $solicitudModel = new SolicitudModel();
        $permisoModel = new PermisoModel();
        $estadoModel = new EstadoSolicitudModel();
        $usuarioModel = new UsuarioModel();

        // Obtener los detalles de la solicitud derivada
        $solicitud = $solicitudModel->find($id_solicitud);

        if ($solicitud) {
            $solicitud['solicitante'] = $usuarioModel->find($solicitud['id_usuario'])['nombres'] . ' ' . $usuarioModel->find($solicitud['id_usuario'])['apellidos'];
            $solicitud['tipo_permiso'] = $permisoModel->find($solicitud['id_permiso'])['descripcion'];  // Definir tipo de permiso
            $solicitud['estado_solicitud'] = $estadoModel->find($solicitud['estado_solicitud'])['estado'];  // Obtener el nombre del estado
        }

        // Obtener los administradores
        $administradores = $usuarioModel->where('id_rol', 2)->findAll();

        $data = array_merge($userData, [
            'solicitud' => $solicitud,
            'administradores' => $administradores
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/solicitud/detalleSolicitudDerivada', $data); // Pasar los datos a la vista
        echo view('gespe/incluir/footer_app');
    }
}
