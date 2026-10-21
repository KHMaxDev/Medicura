@extends('layouts.admin')

@section('title', 'Registrar paciente | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Registrar paciente</h1>
            <p class="text-muted mb-0">Crea una cuenta activa para un paciente.</p>
        </div>
        <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('admin.patients._form', [
                'patient' => null,
                'action' => route('admin.patients.store'),
                'method' => 'POST',
                'submitLabel' => 'Registrar paciente',
            ])
        </div>
    </div>
@endsection
