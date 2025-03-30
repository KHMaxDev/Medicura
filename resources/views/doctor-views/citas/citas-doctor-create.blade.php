@extends('layouts.navbar-doctor')
@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Crear Nueva Cita</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('citas-doctor-store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Patient Selection -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="id_paciente">Paciente:</label>
                            <select name="id_paciente" class="form-control" required>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->_id }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Doctor Selection -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="id_doctor">Doctor:</label>
                            <select name="id_doctor" class="form-control" required>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->_id }}">{{ $doctor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Date and Time Section -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio:</label>
                            <input type="time" name="hora_inicio" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hora_fin">Hora de Fin:</label>
                            <input type="time" name="hora_fin" class="form-control" required>
                        </div>
                    </div>

                    <!-- Reason and Actions -->
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="razon">Razón:</label>
                            <textarea name="razon" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label for="acciones">Acciones:</label>
                            <textarea name="acciones" class="form-control" rows="4"></textarea>
                            <small class="form-text text-muted">Separar acciones con comas</small>
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('citas-doctor') }}" class="btn btn-secondary">
                        <i class="ti-close"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save"></i> Crear Cita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- Scripts remain unchanged -->
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