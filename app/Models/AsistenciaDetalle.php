<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaDetalle extends Model
{
    protected $primaryKey = null;
    public $incrementing = false; // La vista no tiene incremento automático.

    // La vista no usa timestamps por defecto, así que desactivamos los timestamps si no están presentes.
    public $timestamps = false;

    // Los campos que se pueden asignar masivamente.
    protected $fillable = [
        'id',
        'userid',
        'fecha',
        'modo_verificacion',
        'modoasistencia',
        'nombre_sede',
        'fechafull',
        'estado_descripcion',
        'nombreempleado',
        'tipo_empleado',
        'nombre_turno',
    ];

    // El nombre de la tabla o vista
    protected $table = 'detalle_asistencia_empleados';
}
