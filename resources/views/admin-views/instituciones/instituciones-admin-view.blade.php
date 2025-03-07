@extends('layouts.navbar-admin')
@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h2 class="m-0 font-weight-bold text-primary">Visualizar Institución: {{ $institucion->nombre }}</h2>
    <div class="card">
  <div class="card-body">
  <form action="" class="edit">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $institucion->nombre }}" required readonly><br><br>

        <label for="direccion[estado]">Estado:</label>
        <input type="text" name="direccion[estado]" value="{{ $institucion->direccion['estado'] }}" required readonly><br><br>

        <label for="direccion[municipio]">Municipio:</label>
        <input type="text" name="direccion[municipio]" value="{{ $institucion->direccion['municipio'] }}" required readonly><br><br>

        <label for="direccion[ciudad]">Ciudad:</label>
        <input type="text" name="direccion[ciudad]" value="{{ $institucion->direccion['ciudad'] }}" required readonly><br><br>

        <label for="direccion[colonia]">Colonia:</label>
        <input type="text" name="direccion[colonia]" value="{{ $institucion->direccion['colonia'] }}" required readonly><br><br>

        <label for="direccion[codigo_postal]">Código Postal:</label>
        <input type="number" name="direccion[codigo_postal]" value="{{ $institucion->direccion['codigo_postal'] }}" required readonly><br><br>

        <label for="direccion[calle]">Calle:</label>
        <input type="text" name="direccion[calle]" value="{{ $institucion->direccion['calle'] }}" required readonly><br><br>

        <label for="direccion[numero]">Número:</label>
        <input type="text" name="direccion[numero]" value="{{ $institucion->direccion['numero'] }}" required readonly><br><br>
        <a href="{{ url('/admin/instituciones') }}" class="btn-cancelar">Cancelar</a>
    </form>
  </div>
</div>
    </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @endsection
  <!-- container-scroller -->
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