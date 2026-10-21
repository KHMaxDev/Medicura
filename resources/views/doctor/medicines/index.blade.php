@extends('layouts.doctor')

@section('title', 'Medicamentos | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Medicamentos</h1>
            <p class="text-muted mb-0">Consulta y administra el catálogo de medicamentos.</p>
        </div>
        <a href="{{ route('doctor.medicines.create') }}" class="btn btn-primary">Registrar medicamento</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead><tr><th>Nombre</th><th>Tipo</th><th>Descripción</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($medicamentos as $medicine)
                        <tr>
                            <td>{{ $medicine->nombre }}</td>
                            <td>{{ $medicine->tipo }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($medicine->descripcion, 80) }}</td>
                            <td class="text-right">
                                <a href="{{ route('doctor.medicines.show', $medicine) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('doctor.medicines.edit', $medicine) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form method="POST" action="{{ route('doctor.medicines.destroy', $medicine) }}" class="d-inline" onsubmit="return confirm('¿Eliminar este medicamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">No hay medicamentos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $medicamentos->links() }}</div>
@endsection
