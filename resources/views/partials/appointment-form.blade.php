@php($cita = $cita ?? null)

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    @if(isset($doctores))
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                <option value="">Selecciona un doctor</option>
                @foreach($doctores as $doctor)
                    <option value="{{ $doctor->getKey() }}" {{ (string) old('doctor_id', $cita?->doctor_id) === (string) $doctor->getKey() ? 'selected' : '' }}>
                        {{ $doctor->fullName() }} — {{ $doctor->especialidad }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="form-group">
        <label for="patient_id">Paciente</label>
        <select name="patient_id" id="patient_id" class="form-control" required>
            <option value="">Selecciona un paciente</option>
            @foreach($pacientes as $patient)
                <option value="{{ $patient->getKey() }}" {{ (string) old('patient_id', $cita?->patient_id) === (string) $patient->getKey() ? 'selected' : '' }}>
                    {{ $patient->fullName() }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $cita?->fecha?->format('Y-m-d')) }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="hora_inicio">Hora de inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', $cita?->hora_inicio) }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="hora_fin">Hora de fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', $cita?->hora_fin) }}" required>
        </div>
    </div>

    <div class="form-group">
        <label for="razon">Motivo de la cita</label>
        <textarea name="razon" id="razon" class="form-control" rows="3" required>{{ old('razon', $cita?->razon) }}</textarea>
    </div>

    <div class="form-group">
        <label for="acciones">Acciones indicadas</label>
        <textarea name="acciones" id="acciones" class="form-control" rows="3" placeholder="Separa las acciones con comas">{{ old('acciones', $cita ? implode(', ', $cita->acciones ?? []) : '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
