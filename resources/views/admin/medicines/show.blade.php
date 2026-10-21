@extends('layouts.admin')

@section('title', 'Detalle del medicamento | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $medicine->nombre }}</h1>
            <p class="text-muted mb-0">{{ $medicine->tipo }}</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.medicines.edit', $medicine) }}" class="btn btn-outline-primary">Editar</a>
            <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Descripción</div>
                <div class="card-body">{{ $medicine->descripcion ?: 'Sin descripción.' }}</div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header">Efectos secundarios</div>
                <div class="card-body">
                    <ul class="mb-0 pl-3">
                        @forelse($medicine->efectos_secundarios ?? [] as $efecto)
                            <li>{{ $efecto }}</li>
                        @empty
                            <li class="text-muted">Sin información.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header">Interacciones</div>
                <div class="card-body">
                    <ul class="mb-0 pl-3">
                        @forelse($medicine->interacciones ?? [] as $interaccion)
                            <li>{{ $interaccion }}</li>
                        @empty
                            <li class="text-muted">Sin información.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
