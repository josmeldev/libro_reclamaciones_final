<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $alertDate = date('Y-m-d', strtotime('-10 days')); // 5 días antes del plazo máximo de 15 días

        $totalReclamos = DB::table('reclamos')->where('tipo_reclamo', 'reclamo')->count();
        $totalQuejas = DB::table('reclamos')->where('tipo_reclamo', 'queja')->count();
        $totalClientes = DB::table('clientes')->count();
        $totalEmpresas = DB::table('empresas')->count();
        $reclamosPorAtender = DB::table('reclamos')->where('tipo_reclamo', 'reclamo')->where('estado', 'POR ATENDER')->count();
        $reclamosEnAtencion = DB::table('reclamos')->where('tipo_reclamo', 'reclamo')->where('estado', 'EN ATENCION')->count();
        $reclamosAtendidos = DB::table('reclamos')->where('tipo_reclamo', 'reclamo')->where('estado', 'ATENDIDO')->count();
        $quejasPorAtender = DB::table('reclamos')->where('tipo_reclamo', 'queja')->where('estado', 'POR ATENDER')->count();
        $quejasEnAtencion = DB::table('reclamos')->where('tipo_reclamo', 'queja')->where('estado', 'EN ATENCION')->count();
        $quejasAtendidas = DB::table('reclamos')->where('tipo_reclamo', 'queja')->where('estado', 'ATENDIDO')->count();

        $reclamosHoy = DB::table('reclamos')->where('tipo_reclamo', 'reclamo')->whereDate('created_at', $today)->count();
        $quejasHoy = DB::table('reclamos')->where('tipo_reclamo', 'queja')->whereDate('created_at', $today)->count();

        $alertasReclamos = DB::table('reclamos')
            ->where('tipo_reclamo', 'reclamo')
            ->where('estado', '!=', 'ATENDIDO')
            ->whereDate('created_at', '<=', $alertDate)
            ->get();

        $alertasQuejas = DB::table('reclamos')
            ->where('tipo_reclamo', 'queja')
            ->where('estado', '!=', 'ATENDIDO')
            ->whereDate('created_at', '<=', $alertDate)
            ->get();

        return view('dashboard.index', compact(
            'totalReclamos',
            'totalQuejas',
            'totalClientes',
            'totalEmpresas',
            'reclamosPorAtender',
            'reclamosEnAtencion',
            'reclamosAtendidos',
            'quejasPorAtender',
            'quejasEnAtencion',
            'quejasAtendidas',
            'reclamosHoy',
            'quejasHoy',
            'alertasReclamos',
            'alertasQuejas'
        ));
    }
}
