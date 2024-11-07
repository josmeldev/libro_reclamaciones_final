@extends('layouts.template')

@section('content')
    <h3 class="title text-center">Quejas por atender personas naturales</h3>
    <!-- Otro contenido de la página -->

    <div class="container container-table mt-4 mb-5 rounded">
        <h6>Consulta de Reclamos</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>DNI</th>
                    <th>Nombres y Apellidos</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Menor Edad</th>
                    <th>Apoderado</th>
                    <th>DNI Apoderado</th>
                    <th>Direccion Apoderado</th>
                    <th>Tipo Reclamo</th>
                    <th>Bien Contratado</th>

                    <th>Pedido</th>
                    <th>Estado</th>
                    <!-- Agrega otras columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 + ($quejasPorAtenderPN->currentPage() - 1) * $quejasPorAtenderPN->perPage();
                    $counter = 0;
                @endphp
                @foreach ($quejasPorAtenderPN as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->dni }}</td>
                        <td>{{ $row->apellidos_cliente }}</td>
                        <td>{{ $row->telefono_cliente }}</td>
                        <td>{{ $row->correo_cliente }}</td>
                        <td>{{ $row->menor_edad }}</td>
                        <td>{{ $row->apellidos_apoderado }}</td>
                        <td>{{ $row->dni_apoderado }}</td>
                        <td>{{ $row->direccion_apoderado }}</td>
                        <td>{{ $row->tipo_reclamo }}</td>
                        <td>{{ $row->bien_contratado }}</td>

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
                @if ($quejasPorAtenderPN->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasPorAtenderPN->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @endif
                @for ($i = 1; $i <= $quejasPorAtenderPN->lastPage(); $i++)
                    <li class="page-item {{ $i == $quejasPorAtenderPN->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $quejasPorAtenderPN->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($quejasPorAtenderPN->currentPage() < $quejasPorAtenderPN->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasPorAtenderPN->nextPageUrl() }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endsection
