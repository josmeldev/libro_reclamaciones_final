@extends('layouts.template')

@section('content')
<h3 class="title text-center">Reclamos en atención personas jurídicas</h3>

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
                <th>Detalle</th>
                <th>Estado</th>
                <!-- Agrega otras columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1 + ($reclamosEnAtencionPJ->currentPage() - 1) * $reclamosEnAtencionPJ->perPage();
            $counter = 0;
            @endphp
            @foreach ($reclamosEnAtencionPJ as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $row->ruc }}</td>
                <td>{{ $row->razon_social }}</td>
                <td>{{ $row->telefono }}</td>

                <td>{{ $row->direccion }}</td>
                <td>{{ $row->tipo_reclamo }}</td>
                <td>{{ $row->bien_contratado }}</td>

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
            @if ($reclamosEnAtencionPJ->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $reclamosEnAtencionPJ->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif
            @for ($i = 1; $i <= $reclamosEnAtencionPJ->lastPage(); $i++)
                <li class="page-item {{ $i == $reclamosEnAtencionPJ->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $reclamosEnAtencionPJ->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                @if ($reclamosEnAtencionPJ->currentPage() < $reclamosEnAtencionPJ->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $reclamosEnAtencionPJ->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
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