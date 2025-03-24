@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Visualizar Cita</h2>
    <div class="card">
        <div class="card-body">
            <form action="" class="edit">
                @csrf
                <label for="doctor_nombre">Doctor:</label>
                <input type="text" name="doctor_nombre" value="{{ $cita->doctor_nombre }}" required readonly><br><br>

                <label for="paciente_nombre">Paciente:</label>
                <input type="text" name="paciente_nombre" value="{{ $cita->paciente_nombre }}" required readonly><br><br>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" value="{{ $cita->fecha->format('Y-m-d') }}" required readonly><br><br>

                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" name="hora_inicio" value="{{ $cita->hora_inicio->format('H:i') }}" required readonly><br><br>

                <label for="hora_fin">Hora de Fin:</label>
                <input type="time" name="hora_fin" value="{{ $cita->hora_fin->format('H:i') }}" required readonly><br><br>

                <label for="razon">Razón:</label>
                <textarea name="razon" rows="4" readonly>{{ $cita->razon }}</textarea><br><br>

                <label for="acciones">Acciones:</label>
                <textarea name="acciones" rows="4" readonly>{{ implode(',', $cita->acciones) }}</textarea><br><br>
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