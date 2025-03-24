@extends('layouts.navbar-admin')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h3 class="m-0 font-weight-bold text-primary">Editar Medicamento</h3>
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
                <h6 class="m-0 font-weight-bold text-primary">Formulario para Editar Medicamento</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('medicamentos-admin-update', $medicamento->_id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $medicamento->nombre }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion">{{ $medicamento->descripcion }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $medicamento->tipo }}" required>
                    </div>

                    <!-- Efectos Secundarios -->
                    <div class="form-group">
                        <label for="efectos_secundarios">Efectos Secundarios</label>
                        <div id="effectsContainer">
                            @foreach($medicamento->efectos_secundarios as $efecto)
                                <input type="text" class="form-control mb-2" name="efectos_secundarios[]" value="{{ $efecto }}">
                            @endforeach
                        </div>
                        <button type="button" id="addEffect" class="btn btn-secondary mt-2">Agregar otro efecto</button>
                    </div>

                    <!-- Interacciones -->
                    <div class="form-group">
                        <label for="interacciones">Interacciones</label>
                        <div id="interaccionesContainer">
                            @if($medicamento->interacciones)
                                @foreach($medicamento->interacciones as $interaccion)
                                    <input type="text" class="form-control mb-2" name="interacciones[]" value="{{ $interaccion }}">
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="addInteraccion" class="btn btn-secondary mt-2">Agregar otra interacción</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Medicamento</button>
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