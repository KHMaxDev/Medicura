@extends('layouts.admin')

@section('title', 'Editar medicamento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Editar medicamento</h1>
            <p class="text-muted mb-0">{{ $medicine->nombre }}</p>
        </div>
        <a href="{{ route('admin.medicines.show', $medicine) }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('partials.medicine-form', [
                'medicine' => $medicine,
                'action' => route('admin.medicines.update', $medicine),
                'method' => 'PUT',
                'submitLabel' => 'Guardar cambios',
            ])
        </div>
    </div>
@endsection
