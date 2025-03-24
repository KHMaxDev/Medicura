@extends('layouts.navbar-admin') 
@section('content')
<div class="main-panel" style="margin-top:1.5%">
<h3 class="m-0 font-weight-bold text-primary">Instituciones registradas</h3>
<br>
  <a href="{{ route('instituciones.create') }}" class="btn btn-success mt-4">Ingresar nueva institución</a> 
        <div class="content-wrapper">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Instituciones registradas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Institución</th>
                                <th>Dirección</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Id</th>
                              <th>Institución</th>
                              <th>Dirección</th>
                              <th>Fecha</th>
                              <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($instituciones as $institucion)
                            <tr>
                                <td>{{ $institucion->_id }}</td>
                                <td>{{ $institucion->nombre }}</td>
                                <td>
                                  <!-- Mostrar los campos individuales de la dirección -->
                                  Col. {{ $institucion->direccion['colonia'] }},
                                  C.P. {{ $institucion->direccion['codigo_postal'] }},
                                  Calle {{ $institucion->direccion['calle'] }}
                                  #{{ $institucion->direccion['numero'] }},
                                  {{ $institucion->direccion['ciudad'] }},
                                  {{ $institucion->direccion['estado'] }}.
                                </td>
                                <td>{{ $institucion->updated_at }}</td>
                                <td>
                                <button type="button" class="btn btn-inverse-primary btn-icon" onclick="location.href='{{ route('instituciones-admin-visualizar', $institucion->_id) }}'">
                                  <i class="ti-eye"></i>
                                </button>
                                  <button type="button" class="btn btn-inverse-dark btn-icon" onclick="location.href='{{ route('instituciones-admin-edit', $institucion->_id) }}'">
                                  <i class="ti-marker-alt"></i>
                                </button>
                                <form action="{{ route('instituciones-admin-delete', $institucion->_id) }}" method="POST" style="display:inline">
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
          <a href="{{route('instituciones-admin-pdf')}}" target="_blank" type="button"class="btn btn-info">Generar reporte</a>
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
</body>
</html>