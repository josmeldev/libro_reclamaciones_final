@extends('layouts.template')

@section('content')

<style>
    .col-md-1-5 {
        flex: 0 0 auto;
        width: 20%;
        /* 100% / 5 */
    }
</style>
<h3 class="title text-center">Dashboard</h3>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Reclamos</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $totalReclamos }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Total Quejas</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $totalQuejas }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Clientes</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $totalClientes }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Empresas</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $totalEmpresas }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Reclamos por Atender</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $reclamosPorAtender }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Reclamos en Atención</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $reclamosEnAtencion }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Reclamos Atendidos</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $reclamosAtendidos }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Quejas por Atender</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $quejasPorAtender }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Quejas en Atención</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $quejasEnAtencion }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Quejas Atendidas</div>
                <div class="card-body">
                    <h6 class="card-title">{{ $quejasAtendidas }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection