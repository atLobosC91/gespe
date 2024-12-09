<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudModel extends Model
{
    protected $table = 'solicitud'; // Nombre de la tabla
    protected $primaryKey = 'id_solicitud'; // Clave primaria

    // Campos permitidos para insertar/actualizar
    protected $allowedFields = [
        'id_usuario',
        'id_permiso',
        'supervisor_id',
        'id_estado',
        'administrador_id',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'motivo',
        'estado_solicitud',
        'archivo_adjunto',
        'fecha_solicitud'
    ];
}
