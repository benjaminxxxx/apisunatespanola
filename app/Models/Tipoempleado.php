<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoempleado extends Model
{
    use HasFactory;
    protected $table = 'tipoempleado';

    protected $fillable = [
        'descripcion',
        'formato'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'tipoempleado_id');
    }
}
