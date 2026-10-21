@extends('layouts.guest')

@section('title', 'Restablecer contraseña | Medicura')

@section('content')
    <h1>Restablecer contraseña</h1>
    <p class="text-muted mb-4">Define una nueva contraseña para {{ $user->email }}.</p>

    <form method="POST" action="{{ route('password.update', $user) }}">
        @csrf
        <div class="form-group">
            <label for="contrasena">Nueva contraseña</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" required autofocus>
        </div>
        <div class="form-group">
            <label for="contrasena_confirmation">Confirmar contraseña</label>
            <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Guardar contraseña</button>
    </form>
@endsection
