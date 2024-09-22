<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['usuario', 'password', 'nombres', 'apellidos', 'correo', 'telefono', 'id_rol', 'activo'];
    protected $useTimestamps = true; // Para que use fecha de creación y modificación
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';

    // Método para buscar un usuario por nombre de usuario
    public function findUserByUsername($usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }
}
