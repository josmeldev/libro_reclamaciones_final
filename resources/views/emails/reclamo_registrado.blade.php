<!DOCTYPE html>
<html>
<head>
    <title>Reclamo Registrado</title>
</head>
<body>
    <h1>Reclamo Registrado R-B</h1>
    <p>Estimado/a {{ $persona->nombres_apellidos ?? $persona->razon_social }},</p>
    <p>Su reclamo ha sido registrado correctamente. A continuación, los detalles de su reclamo:</p>
    <ul>
        <li><strong>Tipo de Reclamo:</strong> {{ $reclamo->tipo_reclamo }}</li>
        <li><strong>Bien Contratado:</strong> {{ $reclamo->bien_contratado }}</li>
        @if($reclamo->tipo_reclamo === 'reclamo')
            <li><strong>Texto de Reclamo:</strong> {{ $reclamo->texto_reclamo }}</li>
        @elseif($reclamo->tipo_reclamo === 'queja')
            <li><strong>Texto de Queja:</strong> {{ $reclamo->texto_queja }}</li>
        @endif
        <li><strong>Detalle de Reclamación:</strong> {{ $reclamo->detalle_reclamacion }}</li>
    </ul>
    <p>Gracias por su atención.</p>
</body>
</html>