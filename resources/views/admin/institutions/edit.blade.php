@extends('layouts.admin')

@section('title', 'Editar institución | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Editar institución</h1>
            <p class="text-muted mb-0">{{ $institution->nombre }}</p>
        </div>
        <a href="{{ route('admin.institutions.show', $institution) }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('admin.institutions._form', [
                'institution' => $institution,
                'action' => route('admin.institutions.update', $institution),
                'method' => 'PUT',
                'submitLabel' => 'Guardar cambios',
            ])
        </div>
    </div>
@endsection
