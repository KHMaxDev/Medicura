@extends('layouts.admin')

@section('title', 'Editar cita | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Editar cita</h1>
            <p class="text-muted mb-0">{{ $cita->fecha?->format('d/m/Y') }} · {{ $cita->hora_inicio }}</p>
        </div>
        <a href="{{ route('admin.appointments.show', $cita) }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('partials.appointment-form', [
                'cita' => $cita,
                'doctores' => $doctores,
                'pacientes' => $pacientes,
                'action' => route('admin.appointments.update', $cita),
                'method' => 'PUT',
                'submitLabel' => 'Guardar cambios',
            ])
        </div>
    </div>
@endsection
