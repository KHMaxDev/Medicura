<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Instituciones</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 11px; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        p.meta { color: #666; margin-top: 0; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #4b49ac; color: #fff; }
    </style>
</head>
<body>
    <h1>Instituciones</h1>
    <p class="meta">Medicura · Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Ciudad</th>
                <th>Colonia</th>
                <th>Calle y número</th>
                <th>C.P.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instituciones as $institucion)
                <tr>
                    <td>{{ $institucion->nombre }}</td>
                    <td>{{ $institucion->direccion['estado'] ?? '' }}</td>
                    <td>{{ $institucion->direccion['municipio'] ?? '' }}</td>
                    <td>{{ $institucion->direccion['ciudad'] ?? '' }}</td>
                    <td>{{ $institucion->direccion['colonia'] ?? '' }}</td>
                    <td>{{ $institucion->direccion['calle'] ?? '' }} {{ $institucion->direccion['numero'] ?? '' }}</td>
                    <td>{{ $institucion->direccion['codigo_postal'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
