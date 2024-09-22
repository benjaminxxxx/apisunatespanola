<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'modo_verificacion',
        'estado_asistencia',
        'anio',
        'mes',
        'dia',
        'hora',
        'minuto',
        'segundo',
        'codigo_trabajo',
        'sede_id',
        'fecha',
        'fecha_completa',
        'estado'
    ];
}
