<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(168, 200, 232);
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Cambiar de center a flex-start */
            min-height: 100vh; /* Permitir crecimiento */
            overflow-y: auto; /* Habilitar desplazamiento */
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            margin-top: 20px; /* Espaciado desde arriba */
        }
        .login-header {
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-login {
            background-color: #0056b3;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-login:hover {
            background-color: #004085;
        }
        .btn-cancel {
            background-color: #f8f9fa;
            color: #0056b3;
            border: 1px solid #0056b3;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn-cancel:hover {
            background-color: rgb(224, 26, 26);
            color: rgb(255, 255, 255);
        }
        .form-control {
            border-radius: 20px;
            margin-bottom: 15px;
        }
        .form-group label {
            color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">Registro de Doctor</div>
        <form action="{{ route('doctor-crear') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Celular</label>
                <input type="tel" name="celular" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto de Perfil</label>
                <input type="file" name="foto_perfil" class="form-control" accept="image/*" required>
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Género</label>
                <select name="genero" class="form-control" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="form-group">
                <label>CURP</label>
                <input type="text" name="curp" class="form-control" maxlength="18" required>
            </div>
            <div class="form-group">
                <label>Cédula Profesional</label>
                <input type="text" name="cedula" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Especialidad</label>
                <input type="text" name="especialidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Institución</label>
                <input type="text" name="institucion" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-login">Registrar</button>
            <a href="{{ url('/') }}" class="btn btn-cancel">Cancelar</a>
        </form>
        <div class="footer">© 2025 Medicura</div>
    </div>
</body>
</html>
