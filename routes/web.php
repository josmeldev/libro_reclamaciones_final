<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as FormController;
use App\Http\Controllers\GenerarReporte;
use App\Http\Controllers\GenerarReporteController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\DashboardController;




Route::get('/', [FormController::class, 'index']);

Route::post('/submit_form', [FormController::class, 'store'])->name('form.store');




Route::get('/admin', [FormController::class, 'admin'])->name('admin.index');



Route::get('/personas-naturales-reclamos', [FormController::class, 'consultarReclamosPN'])->name('admin.consultarReclamosPN');
Route::get('/personas-naturales-quejas', [FormController::class, 'consultarQuejasPN'])->name('admin.consultarQuejasPN');
Route::get('/reclamos-naturales-atendidas', [FormController::class, 'consultarDatosClientesA'])->name('admin.PN.atendidos');
Route::get('/quejas-naturales-atendidas', [FormController::class, 'ConsultaQuejasAtendidasPN'])->name('admin.PN.Quejas.atendidos');
Route::get('/personas-juridicas-reclamos', [FormController::class, 'ConsultaReclamosEmpresas'])->name('admin.consultarReclamosPJ');
Route::get('/quejas-juridicas-por-atender', [FormController::class, 'ConsultaQuejasEmpresas'])->name('admin.consultarQuejasPJ');
Route::get('/quejas-naturales-por-atender', [FormController::class, 'ConsultaQuejasPorAtenderPN'])->name('admin.PN.Quejas.por_atender');
Route::get('/quejas-naturales-en-atencion', [FormController::class, 'ConsultaQuejasEnAtencionPN'])->name('admin.PN.Quejas.en_atencion');
Route::get('/reclamos-naturales-por-atender', [FormController::class, 'ConsultaReclamosPorAtenderPN'])->name('admin.PN.Reclamos.por_atender');
Route::get('/reclamos-naturales-en-atencion', [FormController::class, 'ConsultaReclamosEnAtencionPN'])->name('admin.PN.Reclamos.en_atencion');


Route::get('/reclamos-juridicas-por-atender', [FormController::class, 'ConsultaReclamosPorAtenderPJ'])->name('admin.PJ.Reclamos.por_atender');


Route::get('/reclamos-juridicas-en-atencion', [FormController::class, 'ConsultaReclamosEnAtencionPJ'])->name('admin.PJ.Reclamos.en_atencion');

Route::get('/reclamos-juridicas-atendidas', [FormController::class, 'ConsultaReclamosAtendidosPJ'])->name('admin.PJ.Reclamos.atendidos');

Route::get('/quejas-juridicas-en-atencion', [FormController::class, 'consultarQuejasEnAtencionPJ'])->name('admin.PJ.Quejas.en_atencion');
Route::get('/quejas-juridicas-atendidas', [FormController::class, 'consultarQuejasAtendidasPJ'])->name('admin.PJ.Quejas.atendidos');

// actualizar estado

Route::post('/update-estado', [ReclamoController::class, 'updateEstado'])->name('update.estado');

//reporte

Route::get('/generar-reporte', [GenerarReporteController::class, 'generarReporte'])->name('generar.reporte');


// generar report pdf
Route::get('/generar-reporte-pdf', [GenerarReporteController::class, 'generarReportePDF'])->name('generar.reporte.pdf');

// historial de cambios

Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');

//dashboard

Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/reporte-excel', [GenerarReporte::class, 'reporteExcel'])->name('reporte.excel');
Route::get('/reporte-pdf', [GenerarReporte::class, 'reportePDF'])->name('reporte.pdf');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
