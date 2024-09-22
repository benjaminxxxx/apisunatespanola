<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_turno',
        'hora_inicio',
        'hora_fin',
        'regimen_id',
        'horaalmuerzo',
        'hora_inicio_almuerzo',
        'hora_fin_almuerzo',
        'tolerancia',
        'iniciociclo'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'turno_id');
    }
}
