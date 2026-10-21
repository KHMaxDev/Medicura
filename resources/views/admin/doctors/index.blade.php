@extends('layouts.admin')

@section('title', 'Doctores | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Doctores</h1>
            <p class="text-muted mb-0">Consulta y da seguimiento a los profesionales registrados.</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.doctors.pending') }}" class="btn btn-outline-primary">Solicitudes pendientes</a>
            <a href="{{ route('admin.doctors.pdf') }}" class="btn btn-primary">Descargar PDF</a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.doctors.index') }}" class="card card-body mb-4">
        <div class="form-row align-items-end">
            <div class="form-group col-md-6 mb-md-0">
                <label for="estatus">Filtrar por estatus</label>
                <select name="estatus" id="estatus" class="form-control">
                    <option value="">Todos</option>
                    @foreach([\App\Models\User::STATUS_PENDING => 'Pendiente', \App\Models\User::STATUS_ACTIVE => 'Activo', \App\Models\User::STATUS_INACTIVE => 'Inactivo', \App\Models\User::STATUS_DENIED => 'Denegado'] as $value => $label)
                        <option value="{{ $value }}" {{ $status === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 mb-md-0">
                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Especialidad</th>
                        <th>Estatus</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctores as $doctor)
                        <tr>
                            <td>{{ $doctor->fullName() }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->especialidad }}</td>
                            <td>
                                @php
                                    $badge = match($doctor->estatus) {
                                        \App\Models\User::STATUS_ACTIVE => 'success',
                                        \App\Models\User::STATUS_PENDING => 'warning',
                                        \App\Models\User::STATUS_DENIED => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge badge-{{ $badge }}">{{ ucfirst($doctor->estatus) }}</span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No hay doctores para mostrar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $doctores->links() }}</div>
@endsection
