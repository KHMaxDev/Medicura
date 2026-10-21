@extends('layouts.doctor')

@section('title', 'Agendar cita | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Agendar cita</h1>
            <p class="text-muted mb-0">Selecciona uno de tus pacientes y define el horario.</p>
        </div>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($pacientes->isEmpty())
                <div class="empty-state">
                    Primero debes agregar pacientes a tu lista.
                    <a href="{{ route('doctor.patients.search') }}">Buscar pacientes</a>
                </div>
            @else
                @include('partials.appointment-form', [
                    'cita' => null,
                    'pacientes' => $pacientes,
                    'action' => route('doctor.appointments.store'),
                    'method' => 'POST',
                    'submitLabel' => 'Agendar cita',
                ])
            @endif
        </div>
    </div>
@endsection
