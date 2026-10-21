@extends('layouts.admin')

@section('title', 'Instituciones | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Instituciones</h1>
            <p class="text-muted mb-0">Administra las instituciones de salud disponibles.</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.institutions.pdf') }}" class="btn btn-outline-primary">Descargar PDF</a>
            <a href="{{ route('admin.institutions.create') }}" class="btn btn-primary">Registrar institución</a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr><th>Nombre</th><th>Ciudad</th><th>Estado</th><th>Dirección</th><th class="text-right">Acciones</th></tr>
                </thead>
                <tbody>
                    @forelse($instituciones as $institution)
                        <tr>
                            <td>{{ $institution->nombre }}</td>
                            <td>{{ $institution->direccion['ciudad'] ?? '' }}</td>
                            <td>{{ $institution->direccion['estado'] ?? '' }}</td>
                            <td>{{ $institution->direccion['calle'] ?? '' }} {{ $institution->direccion['numero'] ?? '' }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.institutions.show', $institution) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('admin.institutions.edit', $institution) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form method="POST" action="{{ route('admin.institutions.destroy', $institution) }}" class="d-inline" onsubmit="return confirm('¿Eliminar esta institución?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No hay instituciones registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $instituciones->links() }}</div>
@endsection
