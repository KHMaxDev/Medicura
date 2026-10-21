@extends('layouts.doctor')

@section('title', 'Buscar pacientes | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Buscar pacientes</h1>
            <p class="text-muted mb-0">Encuentra pacientes registrados y agrégalos a tu lista.</p>
        </div>
        <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <form method="GET" action="{{ route('doctor.patients.search') }}" class="card card-body mb-4">
        <div class="form-row align-items-end">
            <div class="form-group col-md-4">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_paterno">Apellido paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ request('apellido_paterno') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_materno">Apellido materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ request('apellido_materno') }}">
            </div>
            <div class="form-group col-md-2 mb-md-0">
                <button type="submit" class="btn btn-primary btn-block">Buscar</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead><tr><th>Nombre</th><th>Correo</th><th>CURP</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($results as $patient)
                        <tr>
                            <td>{{ $patient->fullName() }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->curp }}</td>
                            <td class="text-right">
                                <form method="POST" action="{{ route('doctor.patients.attach', $patient) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Agregar a mi lista</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">{{ request()->filled('nombre') ? 'No se encontraron pacientes disponibles.' : 'Realiza una búsqueda para comenzar.' }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
