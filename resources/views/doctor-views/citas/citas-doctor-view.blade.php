@extends('layouts.navbar-doctor')
@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Visualizar Cita</h2>
    <div class="card">
        <div class="card-body">
            <form action="" class="edit">
                @csrf
                <div class="row">
                    <!-- Doctor & Patient Info -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="doctor_nombre">Doctor:</label>
                            <input type="text" class="form-control" name="doctor_nombre" 
                                   value="{{ $cita->doctor_nombre }}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="paciente_nombre">Paciente:</label>
                            <input type="text" class="form-control" name="paciente_nombre" 
                                   value="{{ $cita->paciente_nombre }}" readonly>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" 
                                   value="{{ $cita->fecha->format('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio:</label>
                            <input type="time" class="form-control" name="hora_inicio" 
                                   value="{{ $cita->hora_inicio->format('H:i') }}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hora_fin">Hora de Fin:</label>
                            <input type="time" class="form-control" name="hora_fin" 
                                   value="{{ $cita->hora_fin->format('H:i') }}" readonly>
                        </div>
                    </div>

                    <!-- Reason -->
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="razon">Razón:</label>
                            <textarea class="form-control" name="razon" rows="4" readonly>{{ $cita->razon }}</textarea>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label for="acciones">Acciones:</label>
                            <textarea class="form-control" name="acciones" rows="4" readonly>
                                {{ implode(',', $cita->acciones) }}
                            </textarea>
                        </div>
                    </div>
                </div>

                <!-- Return Button -->
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('citas-doctor') }}" class="btn btn-secondary">
                        <i class="ti-arrow-left"></i> Volver a la Lista
                    </a>
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