@extends('layouts.admin')

@section('title', 'Citas | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Citas</h1>
            <p class="text-muted mb-0">Agenda y administra las citas de la plataforma.</p>
        </div>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Agendar cita</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead><tr><th>Fecha</th><th>Horario</th><th>Doctor</th><th>Paciente</th><th>Motivo</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($citas as $appointment)
                        <tr>
                            <td>{{ $appointment->fecha?->format('d/m/Y') }}</td>
                            <td>{{ $appointment->hora_inicio }} - {{ $appointment->hora_fin }}</td>
                            <td>{{ $appointment->doctor?->fullName() ?? 'No disponible' }}</td>
                            <td>{{ $appointment->patient?->fullName() ?? 'No disponible' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($appointment->razon, 60) }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}" class="d-inline" onsubmit="return confirm('¿Eliminar esta cita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No hay citas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $citas->links() }}</div>
@endsection
