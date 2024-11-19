@extends('layouts.template')

@section('content')
<h3 class="title text-center">Reclamos por atender personas naturales</h3>
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
                <th>Reclamo o Queja </th>
                <th>Pedido</th>
                <th>Estado</th>
                <!-- Agrega otras columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1 + ($reclamosPorAtenderPN->currentPage() - 1) * $reclamosPorAtenderPN->perPage();
            $counter = 0;
            @endphp
            @foreach ($reclamosPorAtenderPN as $row)
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
                <td>{{ $row->reclamo_o_queja }}</td>
                <td>{{ $row->detalle_reclamacion }}</td>
                <td style="white-space: nowrap;">
                    <select class="form-control estado-select" data-id="{{$row->reclamo_id}}" style="width: auto;">
                        <option value="POR ATENDER" {{$row->estado == 'POR ATENDER' ? 'selected' : '' }}>POR ATENDER</option>
                        <option value="EN ATENCION" {{ $row->estado == 'EN ATENCION' ? 'selected' : '' }}>EN ATENCION</option>
                        <option value="ATENDIDO" {{ $row->estado == 'ATENDIDO' ? 'selected' : '' }}>ATENDIDO</option>
                    </select>
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
            @if ($reclamosPorAtenderPN->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $reclamosPorAtenderPN->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @endif
            @for ($i = 1; $i <= $reclamosPorAtenderPN->lastPage(); $i++)
                <li class="page-item {{ $i == $reclamosPorAtenderPN->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $reclamosPorAtenderPN->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($reclamosPorAtenderPN->currentPage() < $reclamosPorAtenderPN->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $reclamosPorAtenderPN->nextPageUrl() }}">Next</a>
                    </li>
                    @endif
        </ul>
    </nav>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.estado-select').change(function() {
            var id = $(this).data('id');
            var estado = $(this).val();

            if (confirm('¿Está seguro de que desea cambiar el estado?')) {
                $.ajax({
                    url: '{{ route("update.estado") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        estado: estado
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Estado actualizado correctamente');
                            location.reload(); // Recargar la página para actualizar la tabla
                        } else {
                            alert('Error al actualizar el estado');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error al actualizar el estado');
                    }
                });
            } else {
                // Si el usuario cancela, revertir el cambio en el select
                $(this).val($(this).data('original'));
            }
        });

        // Guardar el estado original en data-original
        $('.estado-select').each(function() {
            $(this).data('original', $(this).val());
        });
    });
</script>


@endsection