<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte PDF</title>
    <style>
        :root{
            font-size: 10px;
        }
        h1{
            text-align: center;
        }
        .cabecera{
            background-color: #382B19;
            color: white;
        }
        table{
            text-align: center;
            
        }
        td{
           
            border-bottom: solid 1px #382B19;
        }

    </style>
</head>
<body>
    
        <img src="images/logo-parque.png" alt="logo-parque" width="200px" >
        <h1>Reclamos de Personas Naturales</h1>
        <table class="">
            <thead class="cabecera">
                <tr>
                    <th>#</th>
                    <th>DNI</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th>MENOR EDAD</th>
                    <th>APODERADO</th>
                    <th>DNI APODERADO</th>
                    <th>DIRECCION APODERADO</th>
                    <th>TIPO RECLAMO</th>
                    <th>BIEN CONTRATADO</th>
                    <th>RECLAMO</th>
                    <th>PEDIDO RECLAMO</th>
                    <th>ESTADO</th>

                    
                </tr>
            </thead>
            <tbody>
                @foreach($reclamos as $reclamo)
                    <tr>
                        <td>{{ $reclamo->id }}</td>
                        <td>{{ $reclamo->cliente->dni }}</td>
                        <td>{{ $reclamo->cliente->nombres_apellidos }}</td>
                        <td>{{ $reclamo->cliente->fono_persona }}</td>
                        <td>{{ $reclamo->cliente->email }}</td>
                        <td>{{ $reclamo->cliente->menor_edad }}</td>
                        <td>{{ $reclamo->cliente->apoderado->nombres_apellidos_apoderado }}</td>
                        <td>{{ $reclamo->cliente->apoderado->dni_apoderado }}</td>
                        <td>{{ $reclamo->cliente->apoderado->direccion_apoderado }}</td>
                        <td>{{ $reclamo->tipo_reclamo }}</td>
                        <td>{{ $reclamo->bien_contratado }}</td>
                        <td>{{ $reclamo->texto_reclamo }}</td>
                        <td>{{ $reclamo->detalle_reclamacion }}</td>
                        <td>{{ $reclamo->estado }}</td>
                        
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    
</body>
</html>