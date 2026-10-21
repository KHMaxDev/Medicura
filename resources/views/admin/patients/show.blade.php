@extends('layouts.admin')

@section('title', 'Detalle del paciente | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $patient->fullName() }}</h1>
            <p class="text-muted mb-0">{{ $patient->email }}</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-outline-primary">Editar</a>
            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header">Datos personales</div>
                <div class="card-body">
                    <dl class="row detail-list mb-0">
                        <dt class="col-sm-5">Celular</dt><dd class="col-sm-7">{{ $patient->celular ?: 'No registrado' }}</dd>
                        <dt class="col-sm-5">CURP</dt><dd class="col-sm-7">{{ $patient->curp }}</dd>
                        <dt class="col-sm-5">Género</dt><dd class="col-sm-7">{{ $patient->genero ?: 'No especificado' }}</dd>
                        <dt class="col-sm-5">Nacimiento</dt><dd class="col-sm-7">{{ $patient->fecha_nacimiento?->format('d/m/Y') ?: 'No registrada' }}</dd>
                        <dt class="col-sm-5">Estatus</dt><dd class="col-sm-7">{{ ucfirst($patient->estatus) }}</dd>
                        
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header">Doctores asignados</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($patient->patientLinks as $link)
                            <li class="mb-2">{{ $link->doctor?->fullName() ?? 'Doctor no disponible' }}</li>
                        @empty
                            <li class="text-muted">Sin doctores asignados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Citas</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead><tr><th>Fecha</th><th>Doctor</th><th>Motivo</th></tr></thead>
                            <tbody>
                                @forelse($patient->appointmentsAsPatient as $cita)
                                    <tr><td>{{ $cita->fecha?->format('d/m/Y') }}</td><td>{{ $cita->doctor?->fullName() }}</td><td>{{ $cita->razon }}</td></tr>
                                @empty
                                    <tr><td colspan="3" class="text-muted">Sin citas registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Tratamientos</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead><tr><th>Tratamiento</th><th>Doctor</th><th>Duración</th></tr></thead>
                            <tbody>
                                @forelse($patient->treatmentsAsPatient as $tratamiento)
                                    <tr><td>{{ $tratamiento->nombre_tratamiento }}</td><td>{{ $tratamiento->doctor?->fullName() }}</td><td>{{ $tratamiento->duracion }} días</td></tr>
                                @empty
                                    <tr><td colspan="3" class="text-muted">Sin tratamientos registrados.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
