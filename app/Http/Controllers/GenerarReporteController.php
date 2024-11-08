<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerarReporteController extends Controller
{
    
    public function generarReporte(Request $request)
    {
        $query = DB::table('reclamos as r')
            ->select(
                'r.id as reclamo_id',
                'c.dni AS dni',
                'c.nombres_apellidos AS apellidos_cliente',
                'c.fono_persona AS telefono_cliente',
                'c.email AS correo_cliente',
                'c.menor_edad',
                'a.nombres_apellidos_apoderado AS apellidos_apoderado',
                'a.dni_apoderado AS dni_apoderado',
                'a.direccion_apoderado AS direccion_apoderado',
                'e.ruc',
                'e.razon_social',
                'e.fono_empresa AS telefono_empresa',
                'e.direccion AS direccion_empresa',
                'r.tipo_reclamo',
                'r.bien_contratado',
                DB::raw('CASE WHEN r.tipo_reclamo = "reclamo" THEN r.texto_reclamo ELSE r.texto_queja END AS reclamo_o_queja'),
                'r.detalle_reclamacion',
                'r.estado',
                'r.created_at'
            )
            ->leftJoin('clientes as c', 'r.cliente_id', '=', 'c.id')
            ->leftJoin('apoderados as a', 'c.id', '=', 'a.id_cliente')
            ->leftJoin('empresas as e', 'r.empresa_id', '=', 'e.id');
    
        // Filtros dinámicos
        if ($request->has('tipo_reclamo') && $request->input('tipo_reclamo') != '') {
            $query->where('r.tipo_reclamo', $request->input('tipo_reclamo'));
        }
    
        if ($request->has('persona_tipo') && $request->input('persona_tipo') != '') {
            if ($request->input('persona_tipo') == 'natural') {
                $query->whereNotNull('r.cliente_id');
            } elseif ($request->input('persona_tipo') == 'juridica') {
                $query->whereNotNull('r.empresa_id');
            }
        }
    
        if ($request->has('estado') && $request->input('estado') != '') {
            $query->where('r.estado', $request->input('estado'));
        }
    
        if ($request->has('fecha_inicio') && $request->has('fecha_fin') && $request->input('fecha_inicio') != '' && $request->input('fecha_fin') != '') {
            $query->whereBetween('r.created_at', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
        }
    
        $resultados = $query->orderBy('r.created_at', 'desc')->paginate(5);
    
        return view('administration.reporte', compact('resultados'));
    }
}
