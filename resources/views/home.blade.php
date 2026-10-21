@extends('layouts.base')

@section('title', 'Medicura | Salud conectada')

@section('body')
    <nav class="site-nav navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('favicon.svg') }}" alt="Medicura" width="34" height="34" class="mr-2">
                Medicura
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#sobre-nosotros">Sobre nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#equipo">Equipo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('doctor.dashboard') }}">
                                Mi panel
                            </a>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarme</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1>Bienvenido a Medicura</h1>
            <p>Una plataforma para conectar doctores y pacientes con información clara, segura y disponible cuando la necesitas.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Regístrate ahora</a>
            @else
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('doctor.dashboard') }}" class="btn btn-light btn-lg px-4">Ir a mi panel</a>
            @endguest
        </div>
    </header>

    <section id="sobre-nosotros" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title">Sobre nosotros</h2>
                    <p class="text-muted">
                        En Medicura facilitamos la interacción entre profesionales de la salud y pacientes.
                        Centralizamos citas, tratamientos, medicamentos e instituciones para que el cuidado
                        de la salud sea más ordenado y accesible.
                    </p>
                    <p class="text-muted mb-0">
                        Nuestro objetivo es que cada consulta cuente con la información necesaria, reduciendo
                        el trabajo administrativo y mejorando la experiencia de atención.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 mb-3"><div class="card metric-card sky"><div class="card-body"><div class="metric-label">Citas</div><div class="metric-value">24/7</div><small>Gestión disponible</small></div></div></div>
                        <div class="col-6 mb-3"><div class="card metric-card teal"><div class="card-body"><div class="metric-label">Pacientes</div><div class="metric-value">100%</div><small>Información centralizada</small></div></div></div>
                        <div class="col-6"><div class="card metric-card blue"><div class="card-body"><div class="metric-label">Doctores</div><div class="metric-value">+</div><small>Acceso seguro</small></div></div></div>
                        <div class="col-6"><div class="card metric-card orange"><div class="card-body"><div class="metric-label">Soporte</div><div class="metric-value">1</div><small>Equipo dedicado</small></div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="equipo" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Conoce a nuestro equipo</h2>
            @php
                $equipo = [
                    ['nombre' => 'Pedro Dzul', 'rol' => 'Líder | Diseño móvil', 'imagen' => 'pedro.jpeg'],
                    ['nombre' => 'Angel Uitzil', 'rol' => 'Diseño y desarrollo web', 'imagen' => 'angel.jpeg'],
                    ['nombre' => 'Steven Ku', 'rol' => 'Diseño y desarrollo web', 'imagen' => 'steven.jpeg'],
                    ['nombre' => 'Madox Que', 'rol' => 'Líder | Diseño y desarrollo web', 'imagen' => 'madox.jpeg'],
                    ['nombre' => 'Ali Cob', 'rol' => 'Desarrollo y administración de BD', 'imagen' => 'ali.jpeg'],
                    ['nombre' => 'Salvador Poot', 'rol' => 'Diseño web', 'imagen' => 'salva.jpeg'],
                ];
            @endphp
            <div class="row">
                @foreach($equipo as $miembro)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="team-card">
                            <img src="{{ asset($miembro['imagen']) }}" alt="{{ $miembro['nombre'] }}">
                            <h3 class="h5 mb-1">{{ $miembro['nombre'] }}</h3>
                            <p class="text-muted mb-0">{{ $miembro['rol'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contacto" class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h2 class="section-title text-center">Contáctanos</h2>
                    @include('layouts.partials.alerts')
                    <form method="POST" action="{{ route('contact.store') }}" class="card p-4">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required>{{ old('mensaje') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} Medicura. Todos los derechos reservados.</p>
            <p class="mb-0">Desarrollado por el equipo de Medicura.</p>
        </div>
    </footer>
@endsection
