<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres', 'apellidos', 'email', 'pass', 'rol'];

    // Método para verificar usuario
    public function verificarUsuario($email, $password)
    {
        return $this->where('email', $email)
                    ->where('password', md5($password))  // Asumiendo que usas MD5 para las contraseñas
                    ->first();
    }
}
