@extends('layouts.guest')

@section('title', 'Registro de doctor | Medicura')

@section('content')
    <h1>Registro de doctor</h1>
    <p class="text-muted mb-4">Completa tus datos. Un administrador revisará tu solicitud antes de activar la cuenta.</p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre(s)</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="apellido_paterno">Apellido paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="apellido_materno">Apellido materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="celular">Celular</label>
                <input type="text" name="celular" id="celular" class="form-control" value="{{ old('celular') }}" maxlength="10" required>
            </div>
            <div class="form-group col-md-6">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="genero">Género</label>
                <select name="genero" id="genero" class="form-control" required>
                    <option value="">Selecciona una opción</option>
                    @foreach(['Masculino', 'Femenino', 'No especifica'] as $genero)
                        <option value="{{ $genero }}" {{ old('genero') === $genero ? 'selected' : '' }}>{{ $genero }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="curp">CURP</label>
                <input type="text" name="curp" id="curp" class="form-control" value="{{ old('curp') }}" maxlength="18" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cedula">Cédula profesional</label>
                <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="especialidad">Especialidad</label>
                <input type="text" name="especialidad" id="especialidad" class="form-control" value="{{ old('especialidad') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="institucion">Institución</label>
            <input type="text" name="institucion" id="institucion" class="form-control" value="{{ old('institucion') }}" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="contrasena_confirmation">Confirmar contraseña</label>
                <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar solicitud</button>
    </form>

    <p class="text-center mt-4 mb-0"><a href="{{ route('login') }}">Ya tengo cuenta</a></p>
@endsection
