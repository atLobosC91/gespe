<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

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


        // Pasar los datos a la vista
        echo view('gespe/incluir/header_app', $userData);
        echo view('gespe/usuarios/nuevoUsuario', $userData);
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
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'id_rol' => $this->request->getPost('rol'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Guardar los datos del nuevo usuario en la base de datos
        $this->usuariosModel->insert($data);


        // Redirigir a la nómina de usuarios con un mensaje de éxito
        return redirect()->to('gespe/usuarios/nomina')->with('success', 'Usuario creado exitosamente.');
    }

    public function editar($id)
    {
        $data['usuario'] = $this->usuariosModel->find($id);

        return view('usuarios_editar', $data);
    }

    public function actualizar($id)
    {
        // Validar los datos del formulario
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombres' => 'required|min_length[3]|max_length[100]',
            'apellidos' => 'required|min_length[3]|max_length[100]',
            'correo' => 'required|valid_email',
            'telefono' => 'required|regex_match[/^569[0-9]{8}$/]',
            'rol' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Si la validación es correcta, actualizamos los datos del usuario
        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'id_rol' => $this->request->getPost('rol'),
        ];

        // Actualizar los datos en la base de datos
        $this->usuariosModel->update($id, $data);

        // Redirigir con un mensaje de éxito
        return redirect()->to('gespe/usuarios/nomina')->with('success', 'Usuario actualizado exitosamente.');
    }


    public function eliminar($id)
    {
        $this->usuariosModel->delete($id);

        return redirect()->to('gespe/usuarios/nomina');
    }

    public function detalleUsuario($id)
    {
        // Obtener los datos del usuario logueado
        $userData = $this->getUserData(); // El rol del usuario logueado

        // Buscar el usuario por su ID
        $usuario = $this->usuariosModel->find($id);

        // Si el usuario no existe, redirigir con un mensaje de error
        if (!$usuario) {
            return redirect()->to('gespe/usuarios/nomina')->with('error', 'Usuario no encontrado.');
        }

        // Pasar los datos del usuario que se está viendo y del usuario logueado a la vista
        $data = array_merge($userData, ['usuario' => $usuario]);

        echo view('gespe/incluir/header_app', $data);
        echo view('gespe/usuarios/detalleUsuario', $data);
        echo view('gespe/incluir/footer_app', $data);
    }
}
