<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('historial_cambios as h')
            ->join('reclamos as r', 'h.reclamo_id', '=', 'r.id')
            ->leftJoin('clientes as c', 'r.cliente_id', '=', 'c.id')
            ->leftJoin('empresas as e', 'r.empresa_id', '=', 'e.id')
            ->select(
                'h.*',
                'r.tipo_reclamo',
                'r.bien_contratado',
                'r.created_at as fecha_creacion',
                'c.dni',
                'e.ruc'
            );

        if ($request->has('dni_ruc')) {
            $query->where(function($q) use ($request) {
                $q->where('c.dni', 'like', '%' . $request->dni_ruc . '%')
                  ->orWhere('e.ruc', 'like', '%' . $request->dni_ruc . '%');
            });
        }

        $historial = $query->orderBy('h.fecha_cambio', 'desc')->paginate(8);

        return view('administration.historial', compact('historial'));
    }
}