@extends('layouts.admin')

@section('title', 'Panel administrativo | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Panel administrativo</h1>
            <p class="text-muted mb-0">Resumen general de {{ $metrics['mes'] }}.</p>
        </div>
        <div class="page-actions mb-0">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-primary">Ver reportes</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card blue">
                <div class="card-body">
                    <div class="metric-label">Doctores activos</div>
                    <div class="metric-value">{{ $metrics['doctoresActivos'] }}</div>
                    <small>{{ $metrics['doctoresPendientes'] }} solicitudes pendientes</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card sky">
                <div class="card-body">
                    <div class="metric-label">Pacientes</div>
                    <div class="metric-value">{{ $metrics['pacientes'] }}</div>
                    <small>{{ $metrics['cuidadores'] }} cuidadores registrados</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card teal">
                <div class="card-body">
                    <div class="metric-label">Citas</div>
                    <div class="metric-value">{{ $metrics['citas'] }}</div>
                    <small>Total histórico</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card metric-card orange">
                <div class="card-body">
                    <div class="metric-label">Instituciones</div>
                    <div class="metric-value">{{ $metrics['instituciones'] }}</div>
                    <small>{{ $metrics['medicamentos'] }} medicamentos</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">Accesos rápidos</div>
                <div class="card-body d-flex flex-column">
                    <a href="{{ route('admin.doctors.pending') }}" class="btn btn-outline-primary mb-2">Revisar solicitudes</a>
                    <a href="{{ route('admin.patients.create') }}" class="btn btn-outline-primary mb-2">Registrar paciente</a>
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-outline-primary mb-2">Agendar cita</a>
                    <a href="{{ route('admin.reports.pdf') }}" class="btn btn-outline-secondary">Descargar reporte PDF</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">Descripción del sistema</div>
                <div class="card-body">
                    <p class="text-muted mb-2">
                        Medicura centraliza la administración de doctores, pacientes, instituciones,
                        medicamentos y citas. Los doctores solo pueden consultar la información de los
                        pacientes que tienen asignados.
                    </p>
                    <p class="text-muted mb-0">
                        Usa el menú lateral para administrar cada módulo. Las solicitudes de registro
                        de doctores requieren aprobación antes de que puedan iniciar sesión.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
