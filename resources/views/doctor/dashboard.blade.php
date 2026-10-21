@extends('layouts.doctor')

@section('title', 'Panel del doctor | Medicura')

@section('content')
    <div class="mb-4">
        <h1 class="page-title mb-1">Bienvenido, {{ auth()->user()->nombre }}</h1>
        <p class="text-muted mb-0">Este es el resumen de tu actividad en Medicura.</p>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card blue">
                <div class="card-body">
                    <div class="metric-label">Mis pacientes</div>
                    <div class="metric-value">{{ $metrics['pacientes'] }}</div>
                    <a href="{{ route('doctor.patients.index') }}" class="text-white small">Ver pacientes</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card sky">
                <div class="card-body">
                    <div class="metric-label">Citas de hoy</div>
                    <div class="metric-value">{{ $metrics['citasHoy'] }}</div>
                    <a href="{{ route('doctor.appointments.index') }}" class="text-white small">Ver agenda</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card teal">
                <div class="card-body">
                    <div class="metric-label">Tratamientos</div>
                    <div class="metric-value">{{ $metrics['tratamientos'] }}</div>
                    <a href="{{ route('doctor.treatments.index') }}" class="text-white small">Ver tratamientos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card orange">
                <div class="card-body">
                    <div class="metric-label">Próxima cita</div>
                    <div class="metric-value" style="font-size: 1.15rem;">
                        @if($metrics['proximaCita'])
                            {{ $metrics['proximaCita']->fecha?->format('d/m/Y') }} {{ $metrics['proximaCita']->hora_inicio }}
                        @else
                            Sin citas
                        @endif
                    </div>
                    <small>{{ $metrics['proximaCita']?->patient?->fullName() ?? 'No hay citas programadas' }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Accesos rápidos</div>
        <div class="card-body">
            <a href="{{ route('doctor.patients.search') }}" class="btn btn-outline-primary mb-2">Buscar pacientes</a>
            <a href="{{ route('doctor.appointments.create') }}" class="btn btn-outline-primary mb-2">Agendar cita</a>
            <a href="{{ route('doctor.treatments.create') }}" class="btn btn-outline-primary mb-2">Crear tratamiento</a>
            <a href="{{ route('doctor.medicines.index') }}" class="btn btn-outline-secondary mb-2">Consultar medicamentos</a>
        </div>
    </div>
@endsection
