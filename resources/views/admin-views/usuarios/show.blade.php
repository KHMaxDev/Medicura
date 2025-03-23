@extends('layouts.navbar-admin')

@section('content')
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">
                        <i class="bi bi-person-badge me-2"></i>Detalles del Usuario
                    </h2>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>

            <div class="card-body bg-light p-4">
                @isset($usuarios)
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                                <dl class="row mb-0">
                                    <div class="col-12 mb-3 border-bottom pb-3">
                                        <dt class="small text-muted text-uppercase mb-2">Nombre Completo</dt>
                                        <dd class="h5 text-primary">{{ $usuarios->nombre }}</dd>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <dt class="small text-muted text-uppercase mb-2">Correo Electrónico</dt>
                                        <dd class="h6">
                                            <a href="mailto:{{ $usuarios->email }}" class="text-decoration-none">
                                                <i class="bi bi-envelope me-2"></i>{{ $usuarios->email }}
                                            </a>
                                        </dd>
                                    </div>

                                    <div class="col-12">
                                        <dt class="small text-muted text-uppercase mb-2">CURP</dt>
                                        <dd class="h6 font-monospace text-success">{{ $usuarios->curp }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                                <div class="row">
                                    @if($usuarios->created_at)
                                        <div class="col-12 mb-3">
                                            <dt class="small text-muted text-uppercase mb-2">Registro en el Sistema</dt>
                                            <dd class="text-muted">
                                                <i
                                                    class="bi bi-calendar-plus me-2"></i>{{ $usuarios->created_at->format('d/m/Y H:i') }}
                                            </dd>
                                        </div>
                                    @endif

                                    @if($usuarios->updated_at)
                                        <div class="col-12">
                                            <dt class="small text-muted text-uppercase mb-2">Última Actualización</dt>
                                            <dd class="text-muted">
                                                <i
                                                    class="bi bi-clock-history me-2"></i>{{ $usuarios->updated_at->format('d/m/Y H:i') }}
                                            </dd>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger d-flex align-items-center shadow-sm">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                        <div>
                            <h5 class="alert-heading mb-1">¡Usuario no encontrado!</h5>
                            <p class="mb-0">El registro solicitado no existe en la base de datos</p>
                        </div>
                    </div>
                @endisset
            </div>

            @isset($usuarios)
                <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 py-3">
                    <a href="{{ route('usuarios.edit', $usuarios->_id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-2"></i>Editar
                    </a>
                    <form action="{{ route('usuarios.destroy', $usuarios->_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este usuario?')">
                            <i class="bi bi-trash me-2"></i>Eliminar
                        </button>
                    </form>
                </div>
            @endisset
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
