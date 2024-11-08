@extends('layouts.template')

@section('content')
<h3 class="title text-center">Reclamos atendidos personas jurídicas</h3>

<div class="container container-table mt-4 mb-5 rounded">
    <h6>Consulta de Reclamos</h6>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Tipo Reclamo</th>
                <th>Bien Contratado</th>
               

                <th>Pedido</th>
                <th>Estado</th>
                <!-- Agrega otras columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1 + ($reclamosAtendidosPJ->currentPage() - 1) * $reclamosAtendidosPJ->perPage();
            $counter = 0;
            @endphp
            @foreach ($reclamosAtendidosPJ as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->ruc }}</td>
                <td>{{ $row->razon_social }}</td>
                <td>{{ $row->telefono }}</td>
                <td>{{ $row->direccion }}</td>
                <td>{{ $row->tipo_reclamo }}</td>
                <td>{{ $row->bien_contratado }}</td>
                <td>{{$row->detalle_reclamacion}}</td>

                
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
            @if ($reclamosAtendidosPJ->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $reclamosAtendidosPJ->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif
            @for ($i = 1; $i <= $reclamosAtendidosPJ->lastPage(); $i++)
                <li class="page-item {{ $i == $reclamosAtendidosPJ->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $reclamosAtendidosPJ->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                @if ($reclamosAtendidosPJ->currentPage() < $reclamosAtendidosPJ->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $reclamosAtendidosPJ->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    @endif
        </ul>
    </nav>
</div>

@endsection