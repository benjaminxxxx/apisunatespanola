<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function get(Request $request): JsonResponse{
        try {
            $grupos = Grupo::all();

            return response()->json([
                'status' => 'success',
                'data' => $grupos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los Grupos: ' . $e->getMessage()
            ], 500);
        }
    }
}
