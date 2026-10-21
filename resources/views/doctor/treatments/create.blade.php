@extends('layouts.doctor')

@section('title', 'Crear tratamiento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Crear tratamiento</h1>
            <p class="text-muted mb-0">Registra un tratamiento para uno de tus pacientes.</p>
        </div>
        <a href="{{ route('doctor.treatments.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($pacientes->isEmpty())
                <div class="empty-state">
                    Primero debes agregar pacientes a tu lista.
                    <a href="{{ route('doctor.patients.search') }}">Buscar pacientes</a>
                </div>
            @else
                @include('partials.treatment-form', [
                    'tratamiento' => null,
                    'pacientes' => $pacientes,
                    'action' => route('doctor.treatments.store'),
                    'method' => 'POST',
                    'submitLabel' => 'Crear tratamiento',
                ])
            @endif
        </div>
    </div>
@endsection
