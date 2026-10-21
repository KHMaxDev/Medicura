@extends('layouts.doctor')

@section('title', 'Detalle del tratamiento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $tratamiento->nombre_tratamiento }}</h1>
            <p class="text-muted mb-0">{{ $tratamiento->patient?->fullName() ?? 'Paciente no disponible' }}</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('doctor.treatments.edit', $tratamiento) }}" class="btn btn-outline-primary">Editar</a>
            <a href="{{ route('doctor.treatments.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row detail-list mb-0">
                <dt class="col-sm-3">Descripción</dt><dd class="col-sm-9">{{ $tratamiento->descripcion }}</dd>
                <dt class="col-sm-3">Duración</dt><dd class="col-sm-9">{{ $tratamiento->duracion }} días</dd>
                <dt class="col-sm-3">Dosis</dt><dd class="col-sm-9">{{ $tratamiento->dosis }}</dd>
                <dt class="col-sm-3">Fecha de creación</dt><dd class="col-sm-9">{{ $tratamiento->fecha_creacion?->format('d/m/Y') }}</dd>
                <dt class="col-sm-3">Doctor</dt><dd class="col-sm-9">{{ $tratamiento->doctor?->fullName() ?? 'No disponible' }}</dd>
            </dl>
        </div>
    </div>
@endsection
