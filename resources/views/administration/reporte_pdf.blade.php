<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Reclamos y Quejas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 8px; /* Reducir el tamaño de la fuente */
        }
        .table thead th {
            background-color: #382B19;
            color: white;
            padding: 5px; /* Ajustar el padding */
        }
        .table tbody tr {
            background-color: #F4F1ED;
        }
        .table td, .table th {
            padding: 5px; /* Ajustar el padding */
            word-wrap: break-word; /* Permitir el ajuste de palabras */
        }
    </style>
</head>
<body>
    <h3 class="title text-center">Reporte de Reclamos o Quejas</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 3%;">#</th>
                <th style="width: 7%;">DNI/RUC</th>
                <th style="width: 15%;">Nombres y Apellidos/Razón Social</th>
                <th style="width: 10%;">Telefono</th>
                <th style="width: 15%;">Email/Dirección</th>
                <th style="width: 5%;">Menor Edad</th>
                <th style="width: 10%;">Apoderado</th>
                <th style="width: 7%;">DNI Apoderado</th>
                <th style="width: 10%;">Direccion Apoderado</th>
                <th style="width: 8%;">Tipo Reclamo</th>
                <th style="width: 10%;">Bien Contratado</th>
                <th style="width: 10%;">Reclamo o Queja</th>
                <th style="width: 10%;">Pedido</th>
                <th style="width: 5%;">Estado</th>
                <th style="width: 10%;">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $row)
            <tr>
                <td>{{ $row->reclamo_id }}</td>
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