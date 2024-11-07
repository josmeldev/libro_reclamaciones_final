@extends('layouts.template')

@section('content')


        <!-- Botón para abrir la modal -->
        <button type="button" class="btn btn-primary" id="openModal">Abrir Modal</button>
        <a href="{{ route('reporte.pdf') }}" class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf"></i>
        </a>
        <a href="{{ route('reporte.excel') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i>
        </a>

        <!-- Modal -->
        <div class="modal-wrapper" id="modal">

            <div class="modal-content rounded">
                <div class="header rounded">
                    <div class="row mb-2">
                        <h6 class="title col-md-11 d-flex justify-content-center align-items-center">Modal Personalizada</h6>
                        <span class="close  col-md-1 d-flex justify-content-center align-items-center " id="closeModal">&times;</span>

                    </div>


                </div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae eius suscipit rem nisi magnam qui recusandae obcaecati cumque eaque saepe nihil quod architecto, accusantium magni nesciunt vitae odit, itaque voluptatibus.


            </div>
        </div>


        <script src="js/admin.js"></script>


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
                    <th style="min-width: 300px;">Detalle Reclamo</th>
                    <th style="min-width: 300px;">Pedido</th>
                    <th>Estado</th>
                    <!-- Agrega otras columnas según sea necesario -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 + ($datosReclamosPN->currentPage() - 1) * $datosReclamosPN->perPage();
                    $counter = 0;
                @endphp
                @foreach ($datosReclamosPN as $row)
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
                        <td>{{ $row->reclamo }}</td>
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
                @if ($datosReclamosPN->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $datosReclamosPN->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @endif
                @for ($i = 1; $i <= $datosReclamosPN->lastPage(); $i++)
                    <li class="page-item {{ $i == $datosReclamosPN->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $datosReclamosPN->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($datosReclamosPN->currentPage() < $datosReclamosPN->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $datosReclamosPN->nextPageUrl() }}">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection



