<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaEmpleado extends Model
{
    protected $table = 'vista_empleados';

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'dni',
        'email',
        'telefono',
        'clave',
        'privilegio',
        'fecha_nacimiento',
        'fecha_ingreso',
        'tipo_empleado_id',
        'estado',
        'grupo_id',
        'nombre_grupo',
        'tolerancia',
        'inicio_ciclo',
        'dias_trabajados',
        'dias_descanso',
        'tipo_empleado_descripcion',
        'cantidad_huellas',
        'cumple_hoy',
        'sedes_habilitadas',
        'ExisteEnDispositivo'
    ];

}
