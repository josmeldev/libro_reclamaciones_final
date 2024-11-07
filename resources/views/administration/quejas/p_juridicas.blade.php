@extends('layouts.template')

@section('content')
    <h3 class="title text-center">Quejas empresas por atender</h3>
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
                    <th>Queja</th>
                    <th>Detalle Queja</th>
                    <th>Estado</th>
                    <!-- Agrega otras columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 + ($quejasEmpresas->currentPage() - 1) * $quejasEmpresas->perPage();
                    $counter = 0;
                @endphp
                @foreach ($quejasEmpresas as $row)
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
                @if ($quejasEmpresas->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasEmpresas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @endif
                @for ($i = 1; $i <= $quejasEmpresas->lastPage(); $i++)
                    <li class="page-item {{ $i == $quejasEmpresas->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $quejasEmpresas->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($quejasEmpresas->currentPage() < $quejasEmpresas->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasEmpresas->nextPageUrl() }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endsection
