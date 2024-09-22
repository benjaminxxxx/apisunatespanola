<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\TipoEmpleadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;

Route::get('asistencias', [AsistenciaController::class, 'index']);
Route::post('asistencias', [AsistenciaController::class, 'store']);

Route::get('empleados', [EmpleadoController::class, 'get']);
Route::post('empleados', [EmpleadoController::class, 'insert']);

Route::get('grupos', [GrupoController::class, 'get']);

Route::get('tipo_empleados', [TipoEmpleadoController::class, 'get']);

Route::get('asistencias_por_dia', [AsistenciaController::class, 'obtenerAsistenciaPorFecha']);