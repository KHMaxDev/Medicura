@extends('layouts.admin')

@section('title', 'Registrar institución | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Registrar institución</h1>
            <p class="text-muted mb-0">Captura los datos de la institución de salud.</p>
        </div>
        <a href="{{ route('admin.institutions.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('admin.institutions._form', [
                'institution' => null,
                'action' => route('admin.institutions.store'),
                'method' => 'POST',
                'submitLabel' => 'Registrar institución',
            ])
        </div>
    </div>
@endsection
