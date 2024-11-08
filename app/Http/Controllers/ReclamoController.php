<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamo;
use Illuminate\Support\Facades\DB;

class ReclamoController extends Controller
{
    public function updateEstado(Request $request)
    {
        try {
            // Obtener el estado anterior
            $reclamo = DB::table('reclamos')->where('id', $request->id)->first();
            if (!$reclamo) {
                return response()->json(['success' => false, 'message' => 'Reclamo no encontrado.']);
            }
            $estado_anterior = $reclamo->estado;

            // Actualizar el estado
            DB::table('reclamos')
                ->where('id', $request->id)
                ->update(['estado' => $request->estado]);

            // Registrar el cambio en el historial
            DB::table('historial_cambios')->insert([
                'reclamo_id' => $request->id,
                'estado_anterior' => $estado_anterior,
                'estado_nuevo' => $request->estado,
                'fecha_cambio' => now(),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
