@extends('layouts.guest')

@section('title', 'Recuperar contraseña | Medicura')

@section('content')
    <h1>Recuperar contraseña</h1>
    <p class="text-muted mb-4">Escribe tu correo y te enviaremos un enlace firmado para restablecer tu contraseña.</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar enlace</button>
    </form>

    <p class="text-center mt-4 mb-0"><a href="{{ route('login') }}">Volver al inicio de sesión</a></p>
@endsection
