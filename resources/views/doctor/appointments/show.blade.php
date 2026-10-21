@extends('layouts.doctor')

@section('title', 'Detalle de la cita | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Cita del {{ $cita->fecha?->format('d/m/Y') }}</h1>
            <p class="text-muted mb-0">{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('doctor.appointments.edit', $cita) }}" class="btn btn-outline-primary">Editar</a>
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row detail-list mb-0">
                <dt class="col-sm-3">Paciente</dt><dd class="col-sm-9">{{ $cita->patient?->fullName() ?? 'No disponible' }}</dd>
                <dt class="col-sm-3">Motivo</dt><dd class="col-sm-9">{{ $cita->razon }}</dd>
                <dt class="col-sm-3">Acciones</dt>
                <dd class="col-sm-9">
                    @if(! empty($cita->acciones))
                        <ul class="mb-0 pl-3">
                            @foreach($cita->acciones as $accion)
                                <li>{{ $accion }}</li>
                            @endforeach
                        </ul>
                    @else
                        Sin acciones indicadas.
                    @endif
                </dd>
            </dl>
        </div>
    </div>
@endsection
