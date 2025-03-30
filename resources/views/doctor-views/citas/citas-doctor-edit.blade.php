@extends('layouts.navbar-doctor')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Editar Cita</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('citas-doctor-update', $cita->_id) }}" method="POST">
                @csrf
                @method('PATCH')
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_paciente">Paciente:</label>
                            <select name="id_paciente" class="form-control" required>
                                @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->_id }}" {{ $cita->id_paciente == $paciente->_id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_doctor">Doctor:</label>
                            <select name="id_doctor" class="form-control" required>
                                @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->_id }}" {{ $cita->id_doctor == $doctor->_id ? 'selected' : '' }}>
                                    {{ $doctor->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha" class="form-control" value="{{ $cita->fecha->format('Y-m-d') }}" required>
                        </div>
                    </div>
            
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio:</label>
                            <input type="time" name="hora_inicio" class="form-control" value="{{ $cita->hora_inicio->format('H:i') }}" required>
                        </div>
                    </div>
            
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hora_fin">Hora de Fin:</label>
                            <input type="time" name="hora_fin" class="form-control" value="{{ $cita->hora_fin->format('H:i') }}" required>
                        </div>
                    </div>
            
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="razon">Razón:</label>
                            <textarea name="razon" class="form-control" rows="4" required>{{ $cita->razon }}</textarea>
                        </div>
                    </div>
            
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="acciones">Acciones:</label>
                            <textarea name="acciones" class="form-control" rows="4">{{ implode(',', $cita->acciones) }}</textarea>
                        </div>
                    </div>
                </div>
            
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('citas-doctor') }}" class="btn btn-secondary">
                        <i class="ti-close"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save"></i> Actualizar Cita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('src/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('src/off-canvas.js') }}"></script>
<script src="{{ asset('src/hoverable-collapse.js') }}"></script>
<script src="{{ asset('src/template.js') }}"></script>
<script src="{{ asset('src/settings.js') }}"></script>
<script src="{{ asset('src/todolist.js') }}"></script>
</body>
</html>