@extends('layouts.template')

@section('content')
    <h3 class="title text-center">Quejas atendidas</h3>
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
                    <th>Detalle Queja</th>
                    <th>Estado</th>
                    <!-- Agrega otras columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 + ($quejasAtendidasPJ->currentPage() - 1) * $quejasAtendidasPJ->perPage();
                    $counter = 0;
                @endphp
                @foreach ($quejasAtendidasPJ as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->ruc }}</td>
                        <td>{{ $row->razon_social }}</td>
                        <td>{{ $row->telefono }}</td>
                        <td>{{ $row->direccion }}</td>
                        <td>{{ $row->tipo_reclamo }}</td>
                        <td>{{ $row->bien_contratado }}</td>
                        
                        <td>{{ $row->detalle_reclamacion }}</td>
                        <td>{{ $row->estado }}</td>
                    
                </td>

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
                @if ($quejasAtendidasPJ->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasAtendidasPJ->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif
                @for ($i = 1; $i <= $quejasAtendidasPJ->lastPage(); $i++)
                    <li class="page-item {{ $i == $quejasAtendidasPJ->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $quejasAtendidasPJ->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($quejasAtendidasPJ->currentPage() < $quejasAtendidasPJ->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $quejasAtendidasPJ->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endsection