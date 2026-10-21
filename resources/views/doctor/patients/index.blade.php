@extends('layouts.doctor')

@section('title', 'Mis pacientes | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Mis pacientes</h1>
            <p class="text-muted mb-0">Pacientes asignados a tu cuenta.</p>
        </div>
        <a href="{{ route('doctor.patients.search') }}" class="btn btn-primary">Buscar paciente</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead><tr><th>Nombre</th><th>Correo</th><th>Celular</th><th>CURP</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($pacientes as $patient)
                        <tr>
                            <td>{{ $patient->fullName() }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->celular ?: 'No registrado' }}</td>
                            <td>{{ $patient->curp }}</td>
                            <td class="text-right">
                                <a href="{{ route('doctor.appointments.create') }}" class="btn btn-sm btn-outline-primary">Agendar cita</a>
                                <a href="{{ route('doctor.treatments.create') }}" class="btn btn-sm btn-outline-secondary">Tratamiento</a>
                                <form method="POST" action="{{ route('doctor.patients.detach', $patient) }}" class="d-inline" onsubmit="return confirm('¿Quitar este paciente de tu lista?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">Todavía no tienes pacientes asignados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
