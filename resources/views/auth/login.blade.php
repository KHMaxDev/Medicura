@extends('layouts.guest')

@section('title', 'Iniciar sesión | Medicura')

@section('content')
    <h1>Iniciar sesión</h1>
    <p class="text-muted mb-4">Accede al panel administrativo o al panel de doctor.</p>

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">
            <label for="remember" class="form-check-label">Recordarme</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
    </form>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('password.request') }}">Recuperar contraseña</a>
        <a href="{{ route('register') }}">Registrarme como doctor</a>
    </div>
@endsection
