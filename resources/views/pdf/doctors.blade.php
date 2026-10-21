<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Doctores activos</title>
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
    <h1>Doctores activos</h1>
    <p class="meta">Medicura · Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Especialidad</th>
                <th>Institución</th>
                <th>Cédula</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctores as $doctor)
                <tr>
                    <td>{{ $doctor->fullName() }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->especialidad }}</td>
                    <td>{{ $doctor->institucion }}</td>
                    <td>{{ $doctor->cedula }}</td>
                    <td>{{ $doctor->celular }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
