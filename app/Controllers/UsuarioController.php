<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\AreaModel;
use App\Models\RolModel;

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

        // Obtener los usuarios con paginación
        $data['usuarios'] = $this->usuariosModel->paginate($perPage, 'usuarios');
        $data['pager'] = $this->usuariosModel->pager;

        // Combinar los datos del usuario con los demás datos de la vista
        $data = array_merge($userData, $data);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/nomina', $data);
        echo view('gespe/incluir/footer_app', $data);
    }



    public function nuevoUsuario()
    {
        // Obtener los datos del usuario logueado
        $userData = $this->getUserData();

        // Obtener los roles y las áreas de la base de datos
        $rolModel = new RolModel();  // Asegúrate de tener un modelo para la tabla de roles
        $areaModel = new AreaModel();  // Asegúrate de tener un modelo para la tabla de áreas

        $roles = $rolModel->findAll();  // Obtener todos los roles
        $areas = $areaModel->findAll();  // Obtener todas las áreas

        // Pasar los datos a la vista
        $data = array_merge($userData, [
            'roles' => $roles,
            'areas' => $areas
        ]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/nuevoUsuario', $data);
        echo view('gespe/incluir/footer_app');
    }


    public function crearUsuario()
    {
        $userData = $this->getUserData();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombres' => 'required|min_length[3]|max_length[100]',
            'apellidos' => 'required|min_length[3]|max_length[100]',
            'correo' => 'required|valid_email|is_unique[usuario.correo]',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'rol' => 'required',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Si la validación es correcta, creamos el nuevo usuario
        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'usuario' => $this->request->getPost('usuario'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'id_rol' => $this->request->getPost('rol'),
            'id_area' => $this->request->getPost('id'),  // Asegúrate de que estás enviando el área
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->usuariosModel->insert($data);


        // Redirigir a la nómina de usuarios con un mensaje de éxito
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

        // Si el usuario decide cambiar la contraseña
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'id_rol' => $this->request->getPost('rol'),
            'activo' => $this->request->getPost('estado')
        ];

        // Actualizamos los datos en la base de datos
        $this->usuariosModel->update($id, $data);

        // Redirigir con mensaje de éxito
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
