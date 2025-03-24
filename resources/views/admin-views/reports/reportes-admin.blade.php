@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel">          
        <div class="content-wrapper">
          <div>         
<h3 class="m-0 font-weight-bold text-primary">Reportes de la aplicación web | móvil</h3>
            <div class="card">
              <h4 class="card-header"></h4>
                <div class="card-body">
                  <h5 class="card-title">Reporte acerca de la ocupación de Medicura (Noviembre)</h5>
                  <p class="card-text">Este mes hemos tenido una ocupación total de ... usuarios</p>
                  <a href="#" class="btn btn-primary">Descargar PDF</a>
                </div>
            </div>
            <div class="card">
              <h4 class="card-header"></h4>
                <div class="card-body">
                  <h5 class="card-title">Reporte acerca de la ocupación de Medicura (Diciembre)</h5>
                  <p class="card-text">Este mes hemos tenido una ocupación total de ... usuarios</p>
                  <a href="#" class="btn btn-primary">Descargar PDF</a>
                </div>
            </div>
          </div>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @endsection
  <!-- Delete -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(".btn-delete").click(function(e){
      e.preventDefault();
      var form = $(this).parents("form");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
   </script>
<!-- plugins:js -->
<script src="{{ asset('src/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('src/off-canvas.js') }}"></script>
<script src="{{ asset('src/hoverable-collapse.js') }}"></script>
<script src="{{ asset('src/template.js') }}"></script>
<script src="{{ asset('src/settings.js') }}"></script>
<script src="{{ asset('src/todolist.js') }}"></script>
</body>
</html>