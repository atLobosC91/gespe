<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudModel extends Model
{
    protected $table      = 'solicitud';
    protected $primaryKey = 'id_solicitud';

    // Los campos que deseas consultar
    protected $allowedFields = ['id_usuario', 'id_permiso', 'supervisor_id', 'id_estado', 'administrador_id', 'fecha_hora_inicio', 'fecha_hora_fin', 'motivo', 'estado_solicitud', 'archivo_adjunto', 'fecha_solicitud'];
    
}
