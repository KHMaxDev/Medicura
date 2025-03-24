@extends('layouts.navbar-admin')

@section('content')
    <style>
        .btn-uniforme {
            min-width: 120px;
            /* Ajusta este valor según tus necesidades */
        }
    </style>
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">
                        <i class="bi bi-people-fill me-2"></i>Listado de Usuarios
                    </h2>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-light">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Nuevo
                    </a>
                </div>
            </div>

            <div class="card-body bg-light p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="bg-white rounded-3 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4"><i class="bi bi-person-badge me-2"></i>Nombre</th>
                                    <th><i class="bi bi-envelope me-2"></i>Email</th>
                                    <th><i class="bi bi-file-text me-2"></i>CURP</th>
                                    <th class="text-end pe-4"><i class="bi bi-gear me-2"></i>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                    <tr class="align-middle">
                                        <td class="ps-4">{{ $usuario->nombre }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td class="font-monospace text-success">{{ $usuario->curp }}</td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('usuarios.show', $usuario->_id) }}"
                                                    class="btn btn-sm btn-info text-white btn-uniforme">
                                                    <i class="bi bi-eye">ver</i>
                                                </a>

                                                <a href="{{ route('usuarios.edit', $usuario->_id) }}"
                                                    class="btn btn-sm btn-warning btn-uniforme">
                                                    <i class="bi bi-pencil">editar</i>
                                                </a>

                                                <form action="{{ route('usuarios.destroy', $usuario->_id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger btn-uniforme">
                                                        <i class="bi bi-trash">Eliminar</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-5 text-muted">
                                            <i class="bi bi-people-slash display-6 d-block mb-3"></i>
                                            No hay usuarios registrados
                                        </td>
                                    </tr>
                                @endforelse
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

