@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <!--Mensaje principal-->
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Bienvenido administrador</h3>
                  <h6 class="font-weight-normal mb-0">Vista rápida de la información</h6>
                </div>
              </div>
            </div>
          </div>
          <!--Informacion principal-->
          <div class="row">
            <!--IMAGEN-->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{asset('people.svg')}}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <!--Usuarios totales-->
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Usuarios totales</p>
                      <p class="fs-30 mb-2"><?php //echo $usuarios?></p>
                      <p>Usuarios registrados</p>
                    </div>
                  </div>
                </div>
                <!--IDEAS-->
                <div class="col-md-6 mb-4 stretch-card transparent">
                  
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Instituciones</p>
                      <p class="fs-30 mb-2">{{ $institucionCount }}</p>
                      <p>Instituciones aliadas</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <!--Médicos-->
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Médicos</p>
                      <p class="fs-30 mb-2"><?php// echo $cantidad?></p>
                      <p>Aplicativo Web</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <!---->
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Usuarios móvil</p>
                      <p class="fs-30 mb-2">47033</p>
                      <p>Aplicativo móvil</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Carrusel-->
          <div class="card">
              <h3 class="card-header">
                <?php
              $meses = [
                'January' => 'enero',
                'February' => 'febrero',
                'March' => 'marzo',
                'April' => 'abril',
                'May' => 'mayo',
                'June' => 'junio',
                'July' => 'julio',
                'August' => 'agosto',
                'September' => 'septiembre',
                'October' => 'octubre',
                'November' => 'noviembre',
                'December' => 'diciembre',
            ];
            
            $mes_actual = date('F'); // Obtiene el mes en inglés
            echo "<strong>Último reporte del mes de {$meses[$mes_actual]}</strong>";
                ?>
              </h3>
                <div class="card-body">
                  <h5 class="card-title">Reporte acerca de la ocupación de Medicura</h5>
                  <p class="card-text">Este mes hemos tenido una ocupación total de ... usuarios</p>
                  <a href="reportes.php" class="btn btn-primary">Ver mas...</a>
                </div>
            </div>
          <!--Medicamentos y cosas por hacer-->
          
          
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- '../src/components/_footer.php'?>-->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @endsection
<!-- plugins:js -->
 <!-- Custom js for this page-->
<script src="{{ asset('src/dashboard.js') }}"></script>
<script src="{{ asset('src/Chart.roundedBarCharts.js') }}"></script>
<script src="{{ asset('src/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('src/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('src/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('src/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('src/dataTables.select.min.js') }}"></script>

<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('src/off-canvas.js') }}"></script>
<script src="{{ asset('src/hoverable-collapse.js') }}"></script>
<script src="{{ asset('src/template.js') }}"></script>
<script src="{{ asset('src/settings.js') }}"></script>
<script src="{{ asset('src/todolist.js') }}"></script>
<!-- endinject -->

  <!-- End custom js for this page-->
</body>

</html>