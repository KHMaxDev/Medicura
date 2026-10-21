<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte general</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 12px; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        p.meta { color: #666; margin-top: 0; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 9px; text-align: left; }
        th { background: #4b49ac; color: #fff; width: 55%; }
    </style>
</head>
<body>
    <h1>Reporte general de Medicura</h1>
    <p class="meta">Periodo: {{ $mes }} · Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <tr><th>Doctores activos</th><td>{{ $doctoresActivos }}</td></tr>
        <tr><th>Doctores pendientes</th><td>{{ $doctoresPendientes }}</td></tr>
        <tr><th>Pacientes</th><td>{{ $pacientes }}</td></tr>
        <tr><th>Cuidadores</th><td>{{ $cuidadores }}</td></tr>
        <tr><th>Instituciones</th><td>{{ $instituciones }}</td></tr>
        <tr><th>Medicamentos</th><td>{{ $medicamentos }}</td></tr>
        <tr><th>Citas</th><td>{{ $citas }}</td></tr>
    </table>
</body>
</html>
