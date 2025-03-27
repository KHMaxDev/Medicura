@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel" style="margin-top:1.5%">
<h3 class="m-0 font-weight-bold text-primary">Doctores registrados</h3>
<br>
        <div class="content-wrapper">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Doctores registrados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre Completo</th>
                                <th>Email</th>
                                <th>Cédula Profesional</th>
                                <th>CURP</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Id</th>
                              <th>Nombre Completo</th>
                              <th>Email</th>
                              <th>Cédula Profesional</th>
                              <th>CURP</th>
                              <th>Estatus</th>
                              <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($doctores as $doctor)
                            <tr>
                                <td>{{ $doctor->_id }}</td>
                                <td>{{ $doctor->nombre }} {{ $doctor->apellido_paterno }} {{ $doctor->apellido_materno}}</td>
                                <td>{{ $doctor->email}}</td>
                                <td>{{ $doctor->cedula}}</td>
                                <td>{{ $doctor->curp}}</td>
                                <td style="text-transform:uppercase">{{ $doctor->estatus}}</td>
                                <td>
                                <button type="button" class="btn btn-inverse-primary btn-icon" onclick="location.href=''">
                                  <i class="ti-eye"></i>
                                <form action="" method="POST" style="display:inline">
                                    @csrf  <!-- Token CSRF obligatorio -->
                                    @method('DELETE')  <!-- Indica que la solicitud es DELETE -->
                                    <button type="submit" class="btn btn-inverse-danger btn-icon btn-delete">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>                          
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>        
          <a href="{{route('doctores-admin-pdf')}}" target="_blank" type="button"class="btn btn-info">Generar reporte</a>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
<script src="{{ asset('src/todolist.js') }}"></script>
</body>
</html>