@extends('layouts.admin')

@section('title', 'Editar paciente | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Editar paciente</h1>
            <p class="text-muted mb-0">{{ $patient->fullName() }}</p>
        </div>
        <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('admin.patients._form', [
                'patient' => $patient,
                'action' => route('admin.patients.update', $patient),
                'method' => 'PUT',
                'submitLabel' => 'Guardar cambios',
            ])
        </div>
    </div>
@endsection
