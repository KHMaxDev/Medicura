<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctores</title>
    <style>
        /* Estilo general para el cuerpo del documento */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Estilo para la imagen en la esquina superior derecha */
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 60px; /* Ajusta el tamaño de la imagen según sea necesario */
            height: auto;
        }

        /* Estilo para el encabezado */
        h2 {
            text-align: center;
            font-size: 28px;
            color: #4B49AC; /* Color principal */
            margin-top: 50px;
        }

        /* Estilo para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Estilo para las celdas de la tabla */
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* Estilo para el encabezado de la tabla */
        th {
            background-color: #4B49AC;
            color: white;
        }

        /* Estilo para las filas de la tabla */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilo para la leyenda de derechos reservados */
        .footer-text {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 30px;
            padding: 10px;
        }

        /* Estilo para la página de PDF */
        @page {
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body>
    <div class="container my-5">
        <!-- Imagen en la esquina superior derecha
        <img src="{{ asset('favicon.svg') }}" alt="Logo" class="top-right"> -->
        
        <h2>Reporte de los Doctores en nuestro aplicativo</h2>

        <!-- Tabla estilizada -->
        <table>
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Cédula Profesional</th>
                <th>CURP</th>
                <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $doctor)
                    <tr>
                        <td>{{ $doctor->_id }}</td>
                        <td>{{ $doctor->nombre }} {{ $doctor->apellido_materno}} {{ $doctor->apellido_paterno}}</td>
                        <td>{{ $doctor->email}}</td>
                        <td>{{ $doctor->cedula}}</td>
                        <td>{{ $doctor->curp}}</td>
                        <td>{{ $doctor->estatus}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Leyenda de derechos reservados -->
    <div class="footer-text">
        <p>&copy; 2025 Medicura. Todos los derechos reservados.</p>
    </div>
</body>
</html>
