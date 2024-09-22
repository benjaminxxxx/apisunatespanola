<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\VistaEmpleado;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class EmpleadoController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        try {
            // Obtener parámetros de búsqueda
            $nombreEmpleado = $request->query('nombreEmpleado', '');
            $tipoEmpleado = $request->query('tipoEmpleado', 0);
            $grupo = $request->query('grupo', 0);
            $estado = $request->query('estado', 3);

            // Construir la consulta
            $query = VistaEmpleado::query();

            // Aplicar filtros
            if (!empty($nombreEmpleado)) {
                $query->where(function ($q) use ($nombreEmpleado) {
                    $q->where('nombres', 'LIKE', "%{$nombreEmpleado}%")
                        ->orWhere('apellidos', 'LIKE', "%{$nombreEmpleado}%")
                        ->orWhere('dni', 'LIKE', "%{$nombreEmpleado}%");
                });
            }

            if ($tipoEmpleado > 0) {
                $query->where('tipo_empleado_id', $tipoEmpleado);
            }

            if ($grupo > 0) {
                $query->where('grupo_id', $grupo);
            }

            if ($estado == 0 || $estado==1) {
                $query->where('estado', $estado);
            }

            // Obtener resultados
            $empleados = $query->get();

            return response()->json([
                'status' => 'success',
                'data' => $empleados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener empleados: ' . $e->getMessage()
            ], 500);
        }
    }
    public function insert(Request $request): JsonResponse
    {
        Log::info('Datos recibidos en el método insert:', $request->all());

        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'nullable|max:255',
                'dni' => 'nullable|string|max:12',
                'email' => 'nullable|email|max:255',
                'telefono' => 'nullable|string|max:255',
                'fechanac' => 'nullable',
                'fechaingreso' => 'nullable',
                'tipoempleado' => 'required|integer',
                'turno_id' => 'required|integer'
            ]);
    
            // Crear o actualizar el empleado
            $empleado = Empleado::updateOrCreate(
                ['userid' => $request->input('id')],  // Condición de búsqueda para actualizar (si el ID se proporciona)
                $validatedData
            );

            
            // Retornar la respuesta en caso de éxito
            return response()->json([
                'status' => 'success',
                'data' => $empleado
            ]);
        } catch (\Exception $e) {
            // Retornar la respuesta en caso de error
            return response()->json([
                'status' => 'error',
                'message' => 'Error al guardar el empleado: ' . $e->getMessage()
            ], 500);
        }
    }
    
}
