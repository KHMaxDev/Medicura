@extends('layouts.navbar-admin')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h3 class="m-0 font-weight-bold text-primary">Detalles del Medicamento</h3>
    <br>
    <div class="content-wrapper">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $medicamento->nombre }}</h6>
            </div>
            <div class="card-body">
                <p><strong>Descripción:</strong> {{ $medicamento->descripcion }}</p>
                <p><strong>Tipo:</strong> {{ $medicamento->tipo }}</p>
                <p><strong>Efectos Secundarios:</strong></p>
                <ul>
                    @foreach ($medicamento->efectos_secundarios as $efecto)
                    <li>{{ $efecto }}</li>
                    @endforeach
                </ul>
                <p><strong>Interacciones:</strong></p>
                <ul>
                    @foreach ($medicamento->interacciones as $interaccion)
                    <li>{{ $interaccion }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('medicamentos-admin') }}" class="btn btn-primary">Volver a la Lista</a>
                <a href="{{ route('medicamentos-admin-edit', $medicamento->_id) }}" class="btn btn-warning">Editar Medicamento</a>
            </div>
        </div>
    </div>
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