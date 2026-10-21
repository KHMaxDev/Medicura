@extends('layouts.admin')

@section('title', 'Detalle de la institución | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $institution->nombre }}</h1>
            <p class="text-muted mb-0">Información de contacto y ubicación.</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.institutions.edit', $institution) }}" class="btn btn-outline-primary">Editar</a>
            <a href="{{ route('admin.institutions.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row detail-list mb-0">
                <dt class="col-sm-3">Estado</dt><dd class="col-sm-9">{{ $institution->direccion['estado'] ?? '' }}</dd>
                <dt class="col-sm-3">Municipio</dt><dd class="col-sm-9">{{ $institution->direccion['municipio'] ?? '' }}</dd>
                <dt class="col-sm-3">Ciudad</dt><dd class="col-sm-9">{{ $institution->direccion['ciudad'] ?? '' }}</dd>
                <dt class="col-sm-3">Colonia</dt><dd class="col-sm-9">{{ $institution->direccion['colonia'] ?? '' }}</dd>
                <dt class="col-sm-3">Calle y número</dt><dd class="col-sm-9">{{ $institution->direccion['calle'] ?? '' }} {{ $institution->direccion['numero'] ?? '' }}</dd>
                <dt class="col-sm-3">Código postal</dt><dd class="col-sm-9">{{ $institution->direccion['codigo_postal'] ?? '' }}</dd>
            </dl>
        </div>
    </div>
@endsection
