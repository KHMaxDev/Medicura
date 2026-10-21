@extends('layouts.doctor')

@section('title', 'Editar tratamiento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Editar tratamiento</h1>
            <p class="text-muted mb-0">{{ $tratamiento->nombre_tratamiento }}</p>
        </div>
        <a href="{{ route('doctor.treatments.show', $tratamiento) }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('partials.treatment-form', [
                'tratamiento' => $tratamiento,
                'pacientes' => $pacientes,
                'action' => route('doctor.treatments.update', $tratamiento),
                'method' => 'PUT',
                'submitLabel' => 'Guardar cambios',
            ])
        </div>
    </div>
@endsection
