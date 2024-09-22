<?php

namespace App\Http\Controllers;

use App\Models\Tipoempleado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoEmpleadoController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        try {
            $tipoEmpleados = Tipoempleado::all();

            return response()->json([
                'status' => 'success',
                'data' => $tipoEmpleados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los Tipos de Empleados: ' . $e->getMessage()
            ], 500);
        }
    }
}
