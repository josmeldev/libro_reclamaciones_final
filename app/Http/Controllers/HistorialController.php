<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        $historial = DB::table('historial_cambios as h')
            ->join('reclamos as r', 'h.reclamo_id', '=', 'r.id')
            ->select('h.*', 'r.tipo_reclamo', 'r.bien_contratado')
            ->orderBy('h.fecha_cambio', 'desc')
            ->paginate(10);

        return view('administration.historial', compact('historial'));
    }
}
