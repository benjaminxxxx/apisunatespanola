<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Tabla asociada al modelo
    protected $table = 'users';
    // Clave primaria personalizada
    protected $primaryKey = 'userid';

    // Indica que el campo de clave primaria no es un número entero autoincrementable
    public $incrementing = true;

    // El tipo de la clave primaria
    protected $keyType = 'int';
    public $timestamps = false;

    // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'name',               // Nombre del empleado
        'lastname',           // Apellido del empleado
        'dni',                // DNI del empleado
        'email',              // Correo electrónico del empleado
        'telefono',           // Teléfono del empleado
        'password',           // Contraseña del empleado
        'privilege',          // Privilegio del empleado (generalmente '0' o '1')
        'fechanac',           // Fecha de nacimiento del empleado
        'fechaingreso',       // Fecha de ingreso del empleado
        'tipoempleado',       // Tipo de empleado (índice)
        'estado',             // Estado del empleado (generalmente '0' o '1')
        'turno_id'            // ID del turno del empleado
    ];

    // Campos ocultos para el modelo
    protected $hidden = [
        'password',           // Contraseña del empleado
    ];

    // Campos que se deben tratar como fechas
    protected $dates = [
        'fechanac',           // Fecha de nacimiento
        'fechaingreso',       // Fecha de ingreso
    ];

    public function tipoEmpleado()
    {
        return $this->belongsTo(TipoEmpleado::class, 'tipoempleado_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }
}
