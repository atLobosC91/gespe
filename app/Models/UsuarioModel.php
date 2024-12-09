<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario'; // Nombre de la tabla
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'usuario',
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'direccion',
        'id_rol',
        'id_area',
        'id_especialidad',
        'id_supervisor', // Campo supervisor
        'password',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';

    /**
     * Busca un usuario por su nombre de usuario.
     *
     * @param string $usuario
     * @return array|null
     */
    public function findUserByUsername($usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }

    /**
     * Obtiene todos los usuarios de un rol específico.
     *
     * @param int $id_rol
     * @return array
     */
    public function findUsersByRole($id_rol)
    {
        return $this->where('id_rol', $id_rol)->findAll();
    }

    /**
     * Obtiene usuarios con sus roles.
     *
     * @return array
     */
    public function getUsuariosWithRoles()
    {
        return $this->select('usuario.*, rol.descripcion as rol_descripcion')
            ->join('rol', 'rol.id_rol = usuario.id_rol', 'left') // Relación con la tabla de roles
            ->findAll();
    }

    /**
     * Obtiene supervisores (usuarios con rol de supervisor).
     *
     * @return array
     */
    public function getSupervisores()
    {
        return $this->where('id_rol', 3) // Suponiendo que 3 es el ID del rol "Supervisor"
            ->findAll();
    }

    /**
     * Obtiene el administrador (usuarios con rol de administrador).
     *
     * @return array
     */
    public function getAdministradores()
    {
        return $this->where('id_rol', 2) // Suponiendo que 2 es el ID del rol "Administrador"
            ->findAll();
    }
}
