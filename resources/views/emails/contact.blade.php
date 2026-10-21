<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje de contacto</title>
</head>
<body>
    <h2>Nuevo mensaje de contacto</h2>
    <p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{!! nl2br(e($data['mensaje'])) !!}</p>
</body>
</html>
