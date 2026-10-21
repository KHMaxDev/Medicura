@php($required = $patient ? '' : 'required')

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="nombre">Nombre(s)</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $patient->nombre ?? '') }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="apellido_paterno">Apellido paterno</label>
            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', $patient->apellido_paterno ?? '') }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="apellido_materno">Apellido materno</label>
            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ old('apellido_materno', $patient->apellido_materno ?? '') }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $patient->email ?? '') }}" required>
        </div>
        <div class="form-group col-md-3">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="form-control" value="{{ old('celular', $patient->celular ?? '') }}" maxlength="10">
        </div>
        <div class="form-group col-md-3">
            <label for="genero">Género</label>
            <select name="genero" id="genero" class="form-control">
                <option value="">Selecciona una opción</option>
                @foreach(['Masculino', 'Femenino', 'No especifica'] as $genero)
                    <option value="{{ $genero }}" {{ old('genero', $patient->genero ?? '') === $genero ? 'selected' : '' }}>{{ $genero }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="curp">CURP</label>
            <input type="text" name="curp" id="curp" class="form-control" value="{{ old('curp', $patient->curp ?? '') }}" maxlength="18" required>
        </div>
        <div class="form-group col-md-6">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $patient?->fecha_nacimiento?->format('Y-m-d')) }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="contrasena">Contraseña {{ $patient ? '(opcional)' : '' }}</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" {{ $required }}>
            @if($patient)
                <small class="form-text text-muted">Déjala vacía para conservar la contraseña actual.</small>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="contrasena_confirmation">Confirmar contraseña</label>
            <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" class="form-control" {{ $required }}>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
