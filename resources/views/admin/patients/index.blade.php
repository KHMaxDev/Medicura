@extends('layouts.admin')

@section('title', 'Pacientes | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Pacientes</h1>
            <p class="text-muted mb-0">Administra los pacientes registrados en la plataforma.</p>
        </div>
        <a href="{{ route('admin.patients.create') }}" class="btn btn-primary">Registrar paciente</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>CURP</th>
                        <th>Estatus</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $patient)
                        <tr>
                            <td>{{ $patient->fullName() }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->celular ?: 'No registrado' }}</td>
                            <td>{{ $patient->curp }}</td>
                            <td><span class="badge badge-{{ $patient->isActive() ? 'success' : 'secondary' }}">{{ ucfirst($patient->estatus) }}</span></td>
                            <td class="text-right">
                                <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form method="POST" action="{{ route('admin.patients.destroy', $patient) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este paciente y su información relacionada?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No hay pacientes registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $pacientes->links() }}</div>
@endsection
