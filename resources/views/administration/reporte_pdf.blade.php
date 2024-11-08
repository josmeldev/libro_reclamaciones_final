<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Reclamos y Quejas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h3 class="title text-center">Reporte de Reclamos y Quejas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>DNI/RUC</th>
                <th>Nombres y Apellidos/Razón Social</th>
                <th>Telefono</th>
                <th>Email/Dirección</th>
                <th>Menor Edad</th>
                <th>Apoderado</th>
                <th>DNI Apoderado</th>
                <th>Direccion Apoderado</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->dni ?? $row->ruc }}</td>
                <td>{{ $row->apellidos_cliente ?? $row->razon_social }}</td>
                <td>{{ $row->telefono_cliente ?? $row->telefono_empresa }}</td>
                <td>{{ $row->correo_cliente ?? $row->direccion_empresa }}</td>
                <td>{{ $row->menor_edad }}</td>
                <td>{{ $row->apellidos_apoderado }}</td>
                <td>{{ $row->dni_apoderado }}</td>
                <td>{{ $row->direccion_apoderado }}</td>
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
</body>
</html>