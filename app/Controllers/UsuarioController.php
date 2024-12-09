<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\AreaModel;
use App\Models\RolModel;
use App\Models\EspecialidadModel;

class UsuarioController extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuarioModel();
    }

    private function getUserData()
    {
        // Verifica si el usuario ha iniciado sesión
        if (!session()->has('id_usuario')) {
            return redirect()->to('/login'); // Retornamos el redirect para evitar problemas
        }

        // Obtén el ID del usuario desde la sesión
        $id_usuario = session()->get('id_usuario');

        // Instancia el modelo de usuarios
        $usuarioModel = new UsuarioModel();

        // Obtén los datos del usuario desde la base de datos
        $usuario = $usuarioModel->find($id_usuario);

        // Si no existe el usuario, devolver null
        if (!$usuario) {
            return ['usuario' => null, 'rol' => null];
        }

        // Retornar los datos del usuario y su rol
        return [
            'usuario' => $usuario,
            'rol' => $usuario['id_rol']
        ];
    }

    // Mostrar la nómina de usuarios
    public function nomina()
    {
        // Obtener los datos del usuario logueado
        $userData = $this->getUserData();

        // Número de usuarios por página
        $perPage = 10;

        // Obtener los usuarios con sus roles y supervisores
        $usuarios = $this->usuariosModel
            ->select('usuario.id_usuario, usuario.nombres, usuario.apellidos, usuario.correo, usuario.telefono, rol.descripcion as rol, supervisor.nombres as supervisor')
            ->join('rol', 'usuario.id_rol = rol.id_rol', 'left') // Asegúrate de que `rol.descripcion` esté en tu base de datos
            ->join('usuario as supervisor', 'usuario.id_supervisor = supervisor.id_usuario', 'left')
            ->paginate($perPage, 'usuarios');

        // Obtener el paginador
        $pager = $this->usuariosModel->pager;

        // Pasar los datos a la vista
        $data = array_merge($userData, [
            'usuarios' => $usuarios,
            'pager' => $pager,
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/nomina', $data);
        echo view('gespe/incluir/footer_app', $data);
    }


    public function nuevoUsuario()
    {
        $userData = $this->getUserData();

        // Obtener roles, áreas, especialidades y supervisores
        $rolModel = new RolModel();
        $areaModel = new AreaModel();
        $especialidadModel = new EspecialidadModel();
        $usuariosModel = new UsuarioModel();

        $roles = $rolModel->findAll();
        $areas = $areaModel->findAll();
        $especialidades = $especialidadModel->findAll();

        // Obtener supervisores para asignar a operativos
        $supervisores = $usuariosModel->where('id_rol', 3)->findAll(); // Rol 3 es supervisor

        $data = array_merge($userData, [
            'roles' => $roles,
            'areas' => $areas,
            'especialidades' => $especialidades,
            'supervisores' => $supervisores
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/nuevoUsuario', $data);
        echo view('gespe/incluir/footer_app');
    }

    public function crearUsuario()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombres' => 'required|min_length[3]|max_length[100]',
            'apellidos' => 'required|min_length[3]|max_length[100]',
            'usuario' => 'required|min_length[3]|max_length[50]|is_unique[usuario.usuario]',
            'password' => 'required|min_length[8]',
            'correo' => 'required|valid_email|is_unique[usuario.correo]',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'direccion' => 'required|max_length[255]',
            'rol' => 'required|is_not_unique[rol.id_rol]',
            'id_area' => 'required|is_not_unique[area.id]',
            'id_especialidad' => 'required|is_not_unique[especialidad.id]',
            'id_supervisor' => 'permit_empty|is_not_unique[usuario.id_usuario]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'usuario' => $this->request->getPost('usuario'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'id_rol' => $this->request->getPost('rol'),
            'id_area' => $this->request->getPost('id_area'),
            'id_especialidad' => $this->request->getPost('id_especialidad'),
            'id_supervisor' => $this->request->getPost('id_supervisor') ?: null, // Supervisor es opcional
            'activo' => 1,
        ];

        $this->usuariosModel->insert($data);

        return redirect()->to('gespe/usuarios/nomina')->with('success', 'Usuario creado exitosamente.');
    }



    public function actualizar($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombres' => 'required|min_length[3]|max_length[100]',
            'apellidos' => 'required|min_length[3]|max_length[100]',
            'correo' => 'required|valid_email',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'rol' => 'required',
            'estado' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Construir los datos básicos
        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'id_rol' => $this->request->getPost('rol'),
            'activo' => $this->request->getPost('estado')
        ];

        // Procesar la contraseña si se proporciona
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT); // Generar el hash
        }

        // Actualizar los datos en la base de datos
        $this->usuariosModel->update($id, $data);

        return redirect()->to('gespe/usuarios/nomina')->with('success', 'Usuario actualizado exitosamente.');
    }


    public function eliminar($id)
    {
        $this->usuariosModel->delete($id);

        return redirect()->to('gespe/usuarios/nomina');
    }

    public function detalleUsuario($id)
    {
        // Obtener los datos del usuario logueado (sin sobrescribir la información del usuario logueado)
        $userData = $this->getUserData();

        // Buscar el usuario por su ID
        $usuarioVisto = $this->usuariosModel->find($id);

        // Si el usuario no existe, redirigir con un mensaje de error
        if (!$usuarioVisto) {
            return redirect()->to('gespe/usuarios/nomina')->with('error', 'Usuario no encontrado.');
        }

        // Pasar los datos del usuario que se está viendo y del usuario logueado a la vista
        $data = array_merge($userData, ['usuarioVisto' => $usuarioVisto]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/detalleUsuario', $data);
        echo view('gespe/incluir/footer_app', $data);
    }

    public function modificarUsuario($id)
    {
        $userData = $this->getUserData();

        // Verifica si el usuario tiene permisos adecuados
        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('gespe/usuarios/nomina')->with('error', 'Usuario no encontrado.');
        }

        $data = array_merge($userData, ['usuarioVisto' => $usuario]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/modificarUsuario', $data);
        echo view('gespe/incluir/footer_app', $data);
    }

    public function eliminarUsuario($id)
    {
        $userData = $this->getUserData();

        // Verifica si el usuario tiene permisos adecuados
        if ($userData['rol'] != 2) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $this->usuariosModel->delete($id);

        return redirect()->to('gespe/usuarios/nomina')->with('success', 'Usuario eliminado exitosamente.');
    }
}
