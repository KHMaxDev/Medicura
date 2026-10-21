<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Inicio</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('doctor.patients.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.patients.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Pacientes</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.appointments.index') }}">
                <i class="ti-calendar menu-icon"></i>
                <span class="menu-title">Citas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('doctor.medicines.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.medicines.index') }}">
                <i class="ti-support menu-icon"></i>
                <span class="menu-title">Medicamentos</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('doctor.treatments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.treatments.index') }}">
                <i class="ti-heart-broken menu-icon"></i>
                <span class="menu-title">Tratamientos</span>
            </a>
        </li>
    </ul>
</nav>
