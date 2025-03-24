@extends('layouts.navbar-admin')

@section('content')
<div class="main-panel" style="margin-top:1.5%">
    <h3 class="m-0 font-weight-bold text-primary">Lista de Medicamentos</h3>
    <br>
    <a href="{{ route('medicamentos.create') }}" class="btn btn-success mt-4">Crear Nuevo Medicamento</a> 
    <div class="content-wrapper">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Medicamentos Registrados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($medicamentos as $medicamento)
                            <tr>
                                <td>{{ $medicamento->nombre }}</td>
                                <td>{{ $medicamento->descripcion }}</td>
                                <td>{{ $medicamento->tipo }}</td>
                                <td>
                                    <button type="button" class="btn btn-inverse-primary btn-icon" onclick="location.href='{{ route('medicamentos-admin-view', $medicamento->_id) }}'">
                                        <i class="ti-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-inverse-dark btn-icon" onclick="location.href='{{ route('medicamentos-admin-edit', $medicamento->_id) }}'">
                                        <i class="ti-marker-alt"></i>
                                    </button>
                                    <form action="{{ route('medicamentos-admin-delete', $medicamento->_id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-inverse-danger btn-icon" onclick="return confirm('¿Eliminar este medicamento?')">
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