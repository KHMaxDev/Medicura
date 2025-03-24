@extends('layouts.navbar-admin')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h3 class="m-0 font-weight-bold text-primary">Crear Nuevo Medicamento</h3>
    <br>
    <div class="content-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulario para Crear Medicamento</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('medicamentos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>

                    <!-- Efectos Secundarios -->
                    <div class="form-group">
                        <label for="efectos_secundarios">Efectos Secundarios</label>
                        <div id="effectsContainer">
                            <input type="text" class="form-control mb-2" name="efectos_secundarios[]" placeholder="Ingrese un efecto">
                        </div>
                        <button type="button" id="addEffect" class="btn btn-secondary mt-2">Agregar otro efecto</button>
                    </div>

                    <!-- Interacciones -->
                    <div class="form-group">
                        <label for="interacciones">Interacciones</label>
                        <div id="interaccionesContainer">
                            <input type="text" class="form-control mb-2" name="interacciones[]" placeholder="Ingrese una interacción">
                        </div>
                        <button type="button" id="addInteraccion" class="btn btn-secondary mt-2">Agregar otra interacción</button>
                    </div>

                    <button type="submit" class="btn btn-success">Crear Medicamento</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Efectos Secundarios
document.getElementById('addEffect').addEventListener('click', function() {
    addInputField('effectsContainer', 'efectos_secundarios[]', 'Ingrese un efecto');
});

// Interacciones
document.getElementById('addInteraccion').addEventListener('click', function() {
    addInputField('interaccionesContainer', 'interacciones[]', 'Ingrese una interacción');
});

function addInputField(containerId, name, placeholder) {
    const container = document.getElementById(containerId);
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.name = name;
    input.placeholder = placeholder;
    container.appendChild(input);
}
</script>
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