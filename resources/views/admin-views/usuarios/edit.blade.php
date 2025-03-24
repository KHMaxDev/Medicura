@extends('layouts.navbar-admin')

@section('content')
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">
                        <i class="bi bi-person-gear me-2"></i>Editar Usuario
                    </h2>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>

            <div class="card-body bg-light p-4">
                <form action="{{ route('usuarios.update', $usuarios->_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label small text-muted text-uppercase">Nombre
                                        Completo</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre', $usuarios->nombre) }}" required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                                <div class="mb-3">
                                    <label for="email" class="form-label small text-muted text-uppercase">Correo
                                        Electrónico</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email', $usuarios->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <label for="curp" class="form-label small text-muted text-uppercase">CURP</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('curp') is-invalid @enderror" id="curp"
                                        name="curp" value="{{ old('curp', $usuarios->curp) }}" maxlength="18" required>
                                    @error('curp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Actualizar 
                        </button>
                    </div>
                </form>
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