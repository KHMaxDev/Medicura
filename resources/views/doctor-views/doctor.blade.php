@extends('layouts.navbar-doctor')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Mensaje de bienvenida -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Bienvenido Dr {{ $doctor->nombre }}</h3>
            <h6 class="font-weight-normal mb-0">Panel de control médico</h6>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Estadísticas principales -->
    <div class="row">
      <!-- Imagen decorativa -->
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
          <div class="card-people mt-auto">
            <img src="{{asset('people.svg')}}" alt="people">
          </div>
        </div>
      </div>
      
      <!-- Tarjetas de métricas -->
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <!-- Pacientes -->
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Pacientes</p>
                <p class="fs-30 mb-2">{{ $pacientesCount ?? '0' }}</p>
                <p>Pacientes asignados</p>
              </div>
            </div>
          </div>
          
          <!-- Citas hoy -->
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Citas Hoy</p>
                <p class="fs-30 mb-2">{{ $citasHoyCount ?? '0' }}</p>
                <p>Citas programadas</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <!-- Tratamientos -->
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Tratamientos</p>
                <p class="fs-30 mb-2">{{ $tratamientosCount ?? '0' }}</p>
                <p>Tratamientos activos</p>
              </div>
            </div>
          </div>
          
          <!-- Próxima cita -->
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Próxima cita</p>
                <p class="fs-30 mb-2">
                  @if(isset($proximaCita))
                    {{ $proximaCita->format('H:i') }}
                  @else
                    Ninguna
                  @endif
                </p>
                <p>Hoy</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Sección de reportes -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Reporte Médico Mensual</h4>
            <canvas id="reporteMensualChart" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<script>
  $(document).ready(function() {
    // Gráfico de reporte mensual
    var ctx = document.getElementById('reporteMensualChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [{
          label: 'Pacientes atendidos',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: '#4B49AC'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>
@endsection
@endsection
