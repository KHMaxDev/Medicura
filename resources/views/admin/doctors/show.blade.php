@extends('layouts.admin')

@section('title', 'Detalle del doctor | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">{{ $doctor->fullName() }}</h1>
            <p class="text-muted mb-0">{{ $doctor->especialidad }}</p>
        </div>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">Información profesional</div>
                <div class="card-body">
                    <dl class="row detail-list mb-0">
                        <dt class="col-sm-4">Correo</dt><dd class="col-sm-8">{{ $doctor->email }}</dd>
                        <dt class="col-sm-4">Celular</dt><dd class="col-sm-8">{{ $doctor->celular ?: 'No registrado' }}</dd>
                        <dt class="col-sm-4">CURP</dt><dd class="col-sm-8">{{ $doctor->curp }}</dd>
                        <dt class="col-sm-4">Cédula</dt><dd class="col-sm-8">{{ $doctor->cedula }}</dd>
                        <dt class="col-sm-4">Institución</dt><dd class="col-sm-8">{{ $doctor->institucion }}</dd>
                        <dt class="col-sm-4">Género</dt><dd class="col-sm-8">{{ $doctor->genero ?: 'No especificado' }}</dd>
                        <dt class="col-sm-4">Fecha de nacimiento</dt><dd class="col-sm-8">{{ $doctor->fecha_nacimiento?->format('d/m/Y') ?: 'No registrada' }}</dd>
                        <dt class="col-sm-4">Estatus</dt><dd class="col-sm-8">{{ ucfirst($doctor->estatus) }}</dd>
                        <dt class="col-sm-4">Registro</dt><dd class="col-sm-8">{{ $doctor->created_at?->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">Acciones</div>
                <div class="card-body">
                    @if($doctor->estatus === \App\Models\User::STATUS_PENDING)
                        <form method="POST" action="{{ route('admin.doctors.approve', $doctor) }}" class="mb-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-block">Aprobar solicitud</button>
                        </form>
                        <form method="POST" action="{{ route('admin.doctors.deny', $doctor) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger btn-block">Denegar solicitud</button>
                        </form>
                    @else
                        <p class="text-muted mb-0">Esta solicitud ya fue revisada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
