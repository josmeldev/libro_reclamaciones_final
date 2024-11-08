
@extends('layouts.template')

@section('content')
<h3 class="title text-center">Generar Reporte de Reclamos y Quejas</h3>

<form method="GET" action="{{ route('generar.reporte') }}">
    <div class="form-group">
        <label for="tipo_reclamo">Tipo de Reclamo</label>
        <select name="tipo_reclamo" id="tipo_reclamo" class="form-control">
            <option value="">Seleccione</option>
            <option value="reclamo">Reclamo</option>
            <option value="queja">Queja</option>
        </select>
    </div>

    <div class="form-group">
        <label for="persona_tipo">Tipo de Persona</label>
        <select name="persona_tipo" id="persona_tipo" class="form-control">
            <option value="">Seleccione</option>
            <option value="natural">Persona Natural</option>
            <option value="juridica">Persona Jurídica</option>
        </select>
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select name="estado" id="estado" class="form-control">
            <option value="">Seleccione</option>
            <option value="POR ATENDER">POR ATENDER</option>
            <option value="EN ATENCION">EN ATENCION</option>
            <option value="ATENDIDO">ATENDIDO</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dni_ruc">DNI/RUC</label>
        <input type="text" name="dni_ruc" id="dni_ruc" class="form-control" placeholder="Ingrese DNI o RUC">
    </div>

    <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
    </div>

    <div class="form-group">
        <label for="fecha_fin">Fecha Fin</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Generar Reporte</button>
    <a href="/generar-reporte" class="btn btn-secondary">Limpiar Filtros</a>
</form>

@if(isset($resultados) && count($resultados) > 0)
    <h4 class="mt-4">Resultados del Reporte</h4>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI/RUC</th>
                <th>Nombres y Apellidos/Razón Social</th>
                <th>Telefono</th>
                <th>Email/Dirección</th>
                @if(request('persona_tipo') == 'natural' || !request('persona_tipo'))
                    <th>Menor Edad</th>
                    <th>Apoderado</th>
                    <th>DNI Apoderado</th>
                    <th>Direccion Apoderado</th>
                @endif
                <th>Tipo Reclamo</th>
                <th>Bien Contratado</th>
                <th>Reclamo o Queja</th>
                <th>Pedido</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $row)
            <tr>
                <td>{{ $row->reclamo_id  }}</td>
                <td>{{ $row->dni ?? $row->ruc }}</td>
                <td>{{ $row->apellidos_cliente ?? $row->razon_social }}</td>
                <td>{{ $row->telefono_cliente ?? $row->telefono_empresa }}</td>
                <td>{{ $row->correo_cliente ?? $row->direccion_empresa }}</td>
                @if(request('persona_tipo') == 'natural' || !request('persona_tipo'))
                    <td>{{ $row->menor_edad }}</td>
                    <td>{{ $row->apellidos_apoderado }}</td>
                    <td>{{ $row->dni_apoderado }}</td>
                    <td>{{ $row->direccion_apoderado }}</td>
                @endif
                <td>{{ $row->tipo_reclamo }}</td>
                <td>{{ $row->bien_contratado }}</td>
                <td>{{ $row->reclamo_o_queja }}</td>
                <td>{{ $row->detalle_reclamacion }}</td>
                <td>{{ $row->estado }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Enlaces de paginación -->
    <div class="d-flex justify-content-center pb-5">
        {{ $resultados->links() }}
    </div>
    <!-- Botón para descargar PDF -->
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('generar.reporte.pdf', request()->query()) }}" class="btn btn-danger">Descargar PDF</a>
    </div>
@else
    <p>No se encontraron resultados para los filtros seleccionados.</p>
@endif
@endsection