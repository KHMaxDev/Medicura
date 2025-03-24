<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Medicura</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(168, 200, 232);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
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
            background-color:rgb(224, 26, 26);
            color:rgb(255, 255, 255);
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
    <div class="login-header">
        Ingreso a Medicura
    </div>
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo electrónico" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Introduce tu contraseña" required>
        </div>
        <button type="submit" class="btn btn-login">Iniciar Sesión</button>
    </form>

    <!-- Botón Cancelar -->
    <a href="{{ url('/') }}">
        <button type="button" class="btn btn-cancel">Cancelar</button>
    </a>

    <div class="footer">
        <p>¿Olvidaste tu contraseña? <a href="#">Recuperarla aquí</a></p>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
