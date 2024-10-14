<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'usuario',
        'password',
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'direccion',
        'fecha_creacion',
        'fecha_modificacion',
        'id_rol',
        'activo'
    ];

    // Habilitar timestamps automáticos
    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';

    // Método para buscar un usuario por nombre de usuario
    public function findUserByUsername($usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }

    // Método para obtener usuarios por su rol
    public function findUsersByRole($id_rol)
    {
        return $this->where('id_rol', $id_rol)->findAll();
    }

    // Método para obtener un usuario por ID
    public function findUserById($id)
    {
        return $this->where('id_usuario', $id)->first();
    }
}
