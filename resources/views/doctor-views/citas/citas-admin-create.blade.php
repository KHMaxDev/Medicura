@extends('layouts.navbar-admin')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Crear Nueva Cita</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('citas.store') }}" method="POST">
                @csrf

                <label for="id_paciente">Paciente:</label>
                <select name="id_paciente" required>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->_id }}">{{ $paciente->nombre }}</option>
                    @endforeach
                </select><br><br>

                <label for="id_doctor">Doctor:</label>
                <select name="id_doctor" required>
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->_id }}">{{ $doctor->nombre }}</option>
                    @endforeach
                </select><br><br>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" required><br><br>

                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" name="hora_inicio" required><br><br>

                <label for="hora_fin">Hora de Fin:</label>
                <input type="time" name="hora_fin" required><br><br>

                <label for="razon">Razón:</label>
                <textarea name="razon" rows="4" required></textarea><br><br>

                <label for="acciones">Acciones:</label>
                <textarea name="acciones" rows="4"></textarea><br><br>

                <button type="submit" class="btn btn-success">Crear Cita</button>
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