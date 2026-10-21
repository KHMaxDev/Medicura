@extends('layouts.doctor')

@section('title', 'Registrar medicamento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Registrar medicamento</h1>
            <p class="text-muted mb-0">Agrega un medicamento al catálogo.</p>
        </div>
        <a href="{{ route('doctor.medicines.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('partials.medicine-form', [
                'medicine' => null,
                'action' => route('doctor.medicines.store'),
                'method' => 'POST',
                'submitLabel' => 'Registrar medicamento',
            ])
        </div>
    </div>
@endsection
