@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel">          
        <div class="content-wrapper">
          <div>         
                <h3 class="m-0 font-weight-bold text-primary">Solicitudes pendientes | Usuarios doctor</h3><br>
                <h5>Verificar cédula en la siguiente página o visitar la siguiente página  (<a href="https://www.cedulaprofesional.sep.gob.mx/cedula/presidencia/indexAvanzada.action" target="_blank">dar click aquí</a>):</h5>
                <div class="embed-responsive embed-responsive-16by9" style="max-height: 400px;">
                <iframe class="embed-responsive-item" src="https://www.cedulaprofesional.sep.gob.mx/cedula/presidencia/indexAvanzada.action" allowfullscreen></iframe>
                </div>
                @foreach ($doctores as $doctor)
            <div class="card">
              <h4 class="card-header"></h4>
                <div class="card-body">
                  <h5 class="card-title">Solicitud de unión | {{$doctor->nombre}} | {{$doctor->estatus}}</h5>
                  <p class="card-text">Información del solicitante:</p>
                  <p class="card-text">&#x2022;Nombre(s): {{$doctor->nombre}}</p>
                  <p class="card-text">&#x2022;Apellido Paterno: {{$doctor->apellido_paterno}}</p>
                  <p class="card-text">&#x2022;Apellido Materno: {{$doctor->apellido_materno}}</p>
                  <p class="card-text">&#x2022;Cédula: {{$doctor->cedula}}</p>
                  <p class="card-text">&#x2022;CURP: {{$doctor->curp}}</p>
                  <p class="card-text">&#x2022;Email: {{$doctor->email}}</p>
                  <p class="card-text">&#x2022;Especialidad: {{$doctor->especialidad}}</p>
                  <p class="card-text">&#x2022;Institución: {{$doctor->institucion}}</p>
                    <div class="d-flex justify-content-between">
                        <!-- Botón que dispara el formulario -->
                      <form action="{{ route('aprobar.update', $doctor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="estatus" value="activo">
                          <button type="submit" class="btn btn-primary">Aprobar solicitud</button>
                      </form>
                      <form action="{{ route('eliminar.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Denegar solicitud</button>
                      </form>
                    </div>

                </div>
            </div>
            @endforeach
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
   

<script>
  document.getElementById('aprobarSolicitud').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar que se recargue la página

    // Mostrar un mensaje de confirmación (opcional)
    if (confirm('¿Estás seguro de que deseas aprobar esta solicitud?')) {
    // Enviar el formulario
    document.getElementById('formAprobar').submit();
    }
  });
</script>
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