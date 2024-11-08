
@extends('layouts.template')

@section('content')

<style>
    .col-md-1-5 {
        flex: 0 0 auto;
        width: 20%;
        /* 100% / 5 */
    }
    .card-header .badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px 10px;
        font-size: 0.8rem;
        float: right;
    }
    .alerta {
        background-color: #ffcccc;
        border-left: 5px solid red;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
<h3 class="title text-center">Dashboard</h3>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    Total Reclamos
                    <span class="badge">{{ $reclamosHoy }}</span>
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ $totalReclamos }}</h6>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1-5">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    Total Quejas
                    <span class="badge">{{ $quejasHoy }}</span>
                </div>
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
    <div class="mt-4">
        <h4>Alertas de Reclamos y Quejas</h4>
        @foreach ($alertasReclamos as $reclamo)
            <div class="alerta">
                <strong>Reclamo ID:</strong> {{ $reclamo->id }}<br>
                <strong>Fecha de Creación:</strong> {{ $reclamo->created_at }}<br>
                <strong>Estado:</strong> {{ $reclamo->estado }}<br>
                <strong>Tipo:</strong> Reclamo
            </div>
        @endforeach
        @foreach ($alertasQuejas as $queja)
            <div class="alerta">
                <strong>Queja ID:</strong> {{ $queja->id }}<br>
                <strong>Fecha de Creación:</strong> {{ $queja->created_at }}<br>
                <strong>Estado:</strong> {{ $queja->estado }}<br>
                <strong>Tipo:</strong> Queja
            </div>
        @endforeach
    </div>
</div>
@endsection