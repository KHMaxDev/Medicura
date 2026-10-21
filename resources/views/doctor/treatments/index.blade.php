@extends('layouts.doctor')

@section('title', 'Tratamientos | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Tratamientos</h1>
            <p class="text-muted mb-0">Tratamientos registrados para tus pacientes.</p>
        </div>
        <a href="{{ route('doctor.treatments.create') }}" class="btn btn-primary">Crear tratamiento</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead><tr><th>Tratamiento</th><th>Paciente</th><th>Duración</th><th>Dosis</th><th>Fecha</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($tratamientos as $tratamiento)
                        <tr>
                            <td>{{ $tratamiento->nombre_tratamiento }}</td>
                            <td>{{ $tratamiento->patient?->fullName() ?? 'No disponible' }}</td>
                            <td>{{ $tratamiento->duracion }} días</td>
                            <td>{{ $tratamiento->dosis }}</td>
                            <td>{{ $tratamiento->fecha_creacion?->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('doctor.treatments.show', $tratamiento) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('doctor.treatments.edit', $tratamiento) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form method="POST" action="{{ route('doctor.treatments.destroy', $tratamiento) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este tratamiento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No hay tratamientos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $tratamientos->links() }}</div>
@endsection
