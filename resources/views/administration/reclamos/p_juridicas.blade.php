@extends('layouts.template')

@section('content')
    <h3 class="title text-center">Reclamos empresas</h3>
    <!-- Otro contenido de la página -->

    <div class="container container-table mt-4 mb-5 rounded">
        <h6>Consulta de Reclamos</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RUC</th>
                    <th>Razon Social</th>
                    <th>Telefono</th>
                    <th>Direccion </th>
                    <th>Tipo Reclamo</th>
                    <th>Bien Contratado</th>
                    <th>Reclamo o Queja</th>
                    <th>Detalle Reclamacion</th>
                    <th>Estado</th>
                    <!-- Agrega otras columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 + ($reclamosEmpresas->currentPage() - 1) * $reclamosEmpresas->perPage();
                    $counter = 0;
                @endphp
                @foreach ($reclamosEmpresas as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->ruc }}</td>
                        <td>{{ $row->razon_social }}</td>
                        <td>{{ $row->telefono }}</td>
                        <td>{{ $row->direccion }}</td>
                        <td>{{ $row->tipo_reclamo }}</td>
                        <td>{{ $row->bien_contratado }}</td>
                        <td>{{ $row->reclamo_o_queja }}</td>
                        <td>{{ $row->detalle_reclamacion }}</td>
                        <td>{{ $row->estado }}</td>

                        <!-- Agrega otras columnas según sea necesario -->
                    </tr>
                    @php $counter++; @endphp
                    @if ($counter >= 10)
                        @break
                    @endif
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                @if ($reclamosEmpresas->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $reclamosEmpresas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @endif
                @for ($i = 1; $i <= $reclamosEmpresas->lastPage(); $i++)
                    <li class="page-item {{ $i == $reclamosEmpresas->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $reclamosEmpresas->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($reclamosEmpresas->currentPage() < $reclamosEmpresas->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $reclamosEmpresas->nextPageUrl() }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
