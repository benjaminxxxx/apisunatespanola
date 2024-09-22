<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\AsistenciaDetalle;
use Illuminate\Http\JsonResponse;

class AsistenciaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = AsistenciaDetalle::query();

            // Filtrar por fecha_desde si está presente
            if ($request->has('fecha_desde') && $request->filled('fecha_desde')) {
                $fechaDesde = $request->input('fecha_desde');
                if ($request->has('fecha_hasta') && $request->filled('fecha_hasta')) {
                    // Filtrar entre fecha_desde y fecha_hasta
                    $fechaHasta = $request->input('fecha_hasta');
                    $query->whereBetween('fecha', [$fechaDesde, $fechaHasta]);
                } else {
                    // Filtrar solo por fecha_desde
                    $query->where('fecha', $fechaDesde);
                }
            } elseif ($request->has('fecha_hasta') && $request->filled('fecha_hasta')) {
                // Filtrar solo por fecha_hasta
                $query->where('fecha', '<=', $request->input('fecha_hasta'));
            }

            // Filtrar por nombre_empleado si está presente
            if ($request->has('nombre_empleado') && $request->filled('nombre_empleado')) {
                $query->where('nombre_empleado', 'LIKE', '%' . $request->input('nombre_empleado') . '%');
            }

            $asistencias = $query->get();

            return response()->json([
                'status' => 'success',
                'data' => $asistencias
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener asistencias: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Crear una nueva asistencia.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'modo_verificacion' => 'required|integer',
            'estado_asistencia' => 'required|integer',
            'anio' => 'required|string|max:4',
            'mes' => 'required|string|max:2',
            'dia' => 'required|string|max:2',
            'hora' => 'required|string|max:2',
            'minuto' => 'required|string|max:2',
            'segundo' => 'required|string|max:2',
            'codigo_trabajo' => 'required|string|max:10',
            'sede_id' => 'required|integer',
            'fecha' => 'required|date',
            'fecha_completa' => 'nullable|date_format:Y-m-d H:i:s',
            'estado' => 'required|in:0,1,2,3'
        ]);

        try {
            $asistencia = Asistencia::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Asistencia creada con éxito.',
                'data' => $asistencia
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la asistencia: ' . $e->getMessage()
            ], 500);
        }
    }
    public function obtenerAsistenciaPorFecha(Request $request)
    {
        try {
            // Obtener la fecha del request
            $fecha = $request->input('fecha');

            // Array que contendrá la asistencia procesada
            $asistencia = [];

            // Verificar si se ha proporcionado una fecha
            if ($fecha) {
                // Obtener los registros de asistencia del modelo AsistenciaDetalle en la fecha proporcionada
                $asistenciaObjetos = AsistenciaDetalle::whereDate('fecha', $fecha)->get();

                // Agrupar por usuario (usuario_id) y procesar las horas y turnos
                $asistenciaAgrupada = $asistenciaObjetos->groupBy('userid');

                // Recorrer cada usuario para generar el array final
                foreach ($asistenciaAgrupada as $usuarioId => $asistencias) {
                    // Obtener el nombre del empleado y el nombre del turno (del primer registro)
                    $nombreEmpleado = $asistencias->first()->nombreempleado;
                    $nombreTurno = $asistencias->first()->nombre_turno;
                    
                    // Concatenar las horas (hora:minuto) de cada registro para ese empleado
                    $horasConcatenadas = $asistencias->map(function ($ast) {
                        // Extraer la hora y minuto de 'fecha_completa' en formato HH:MM
                        return \Carbon\Carbon::parse($ast->fechafull)->format('H:i');
                    })->implode(', ');
                    // Añadir al array final
                    $asistencia[] = [
                        'nombre' => $nombreEmpleado,
                        'horas' => $horasConcatenadas,
                        'nombre_turno' => $nombreTurno
                    ];
                }
            }

            // Retornar el array de asistencia en formato JSON
            return response()->json([
                'status' => 'success',
                'data' => $asistencia
            ], 200);

        } catch (\Exception $e) {
            // Manejar errores y retornar un mensaje adecuado
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error al procesar la asistencia: ' . $e->getMessage()
            ], 500);
        }
    }

}
