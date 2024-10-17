<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario'; // Cambié el nombre a plural para evitar errores con la base de datos
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'direccion',
        'fecha_creacion',
        'fecha_modificacion',
        'id_rol',
        'password',
        'activo'
    ];

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
}
