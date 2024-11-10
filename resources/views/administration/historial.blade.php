
@extends('layouts.template')

@section('content')
<h3 class="title text-center">Historial de Cambios de Estado</h3>

<!-- Formulario de búsqueda -->
<form method="GET" action="{{ route('historial.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="dni_ruc" class="form-control" placeholder="Buscar por DNI/RUC" value="{{ request('dni_ruc') }}">
        <button type="submit" class="btn btn-primary" style="background-color: #382B19; border-color: #382B19;">Buscar</button>
        <a href="{{ route('historial.index') }}" class="btn btn-secondary ms-2" style="background-color: #382B19; border-color: #382B19;">Borrar Filtros</a>
    </div>
</form>

@if($historial->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Reclamo ID</th>
                <th>DNI/RUC</th>
                <th>Tipo Reclamo</th>
                <th>Bien Contratado</th>
                <th>Estado Anterior</th>
                <th>Estado Nuevo</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Cambio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $cambio)
            <tr>
                <td>{{ $cambio->reclamo_id }}</td>
                <td>{{ $cambio->dni ?? $cambio->ruc }}</td>
                <td>{{ $cambio->tipo_reclamo }}</td>
                <td>{{ $cambio->bien_contratado }}</td>
                <td>{{ $cambio->estado_anterior }}</td>
                <td>{{ $cambio->estado_nuevo }}</td>
                <td>{{ $cambio->fecha_creacion }}</td>
                <td>{{ $cambio->fecha_cambio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $historial->links() }}
    </div>
@else
    <p>No se encontraron registros en el historial.</p>
@endif
@endsection