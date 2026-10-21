@extends('layouts.admin')

@section('title', 'Solicitudes de doctores | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Solicitudes pendientes</h1>
            <p class="text-muted mb-0">Revisa y aprueba o deniega el registro de doctores.</p>
        </div>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">Ver todos</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Cédula</th>
                        <th>Especialidad</th>
                        <th>Registro</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctores as $doctor)
                        <tr>
                            <td>{{ $doctor->fullName() }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->cedula }}</td>
                            <td>{{ $doctor->especialidad }}</td>
                            <td>{{ $doctor->created_at?->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-outline-primary">Revisar</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No hay solicitudes pendientes.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $doctores->links() }}</div>
@endsection
