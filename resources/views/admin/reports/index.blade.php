@extends('layouts.admin')

@section('title', 'Reportes | Medicura')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Reportes</h1>
            <p class="text-muted mb-0">Indicadores generales de {{ $metrics['mes'] }}.</p>
        </div>
        <a href="{{ route('admin.reports.pdf') }}" class="btn btn-primary">Descargar PDF</a>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4"><div class="card metric-card blue"><div class="card-body"><div class="metric-label">Doctores activos</div><div class="metric-value">{{ $metrics['doctoresActivos'] }}</div></div></div></div>
        <div class="col-md-6 col-xl-3 mb-4"><div class="card metric-card orange"><div class="card-body"><div class="metric-label">Doctores pendientes</div><div class="metric-value">{{ $metrics['doctoresPendientes'] }}</div></div></div></div>
        <div class="col-md-6 col-xl-3 mb-4"><div class="card metric-card sky"><div class="card-body"><div class="metric-label">Pacientes</div><div class="metric-value">{{ $metrics['pacientes'] }}</div></div></div></div>
        <div class="col-md-6 col-xl-3 mb-4"><div class="card metric-card teal"><div class="card-body"><div class="metric-label">Citas</div><div class="metric-value">{{ $metrics['citas'] }}</div></div></div></div>
    </div>

    <div class="card">
        <div class="card-header">Detalle</div>
        <div class="card-body">
            <dl class="row detail-list mb-0">
                <dt class="col-sm-4">Instituciones</dt><dd class="col-sm-8">{{ $metrics['instituciones'] }}</dd>
                <dt class="col-sm-4">Medicamentos</dt><dd class="col-sm-8">{{ $metrics['medicamentos'] }}</dd>
                <dt class="col-sm-4">Cuidadores</dt><dd class="col-sm-8">{{ $metrics['cuidadores'] }}</dd>
                <dt class="col-sm-4">Periodo</dt><dd class="col-sm-8">{{ $metrics['mes'] }}</dd>
            </dl>
        </div>
    </div>
@endsection
