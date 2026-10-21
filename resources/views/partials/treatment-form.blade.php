@php($tratamiento = $tratamiento ?? null)

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-group">
        <label for="patient_id">Paciente</label>
        <select name="patient_id" id="patient_id" class="form-control" required>
            <option value="">Selecciona un paciente</option>
            @foreach($pacientes as $patient)
                <option value="{{ $patient->getKey() }}" {{ (string) old('patient_id', $tratamiento?->patient_id) === (string) $patient->getKey() ? 'selected' : '' }}>
                    {{ $patient->fullName() }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nombre_tratamiento">Nombre del tratamiento</label>
        <input type="text" name="nombre_tratamiento" id="nombre_tratamiento" class="form-control" value="{{ old('nombre_tratamiento', $tratamiento?->nombre_tratamiento) }}" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $tratamiento?->descripcion) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="duracion">Duración (días)</label>
            <input type="number" name="duracion" id="duracion" class="form-control" value="{{ old('duracion', $tratamiento?->duracion) }}" min="1" max="3650" required>
        </div>
        <div class="form-group col-md-4">
            <label for="dosis">Dosis</label>
            <input type="text" name="dosis" id="dosis" class="form-control" value="{{ old('dosis', $tratamiento?->dosis) }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="fecha_creacion">Fecha de creación</label>
            <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" value="{{ old('fecha_creacion', $tratamiento?->fecha_creacion?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
