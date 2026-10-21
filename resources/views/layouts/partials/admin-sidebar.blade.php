<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Inicio</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#doctorsMenu" aria-expanded="{{ request()->routeIs('admin.doctors.*') ? 'true' : 'false' }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Doctores</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.doctors.*') ? 'show' : '' }}" id="doctorsMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.doctors.index') }}">Todos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.doctors.pending') }}">Solicitudes</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.patients.index') }}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Pacientes</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.institutions.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.institutions.index') }}">
                <i class="ti-briefcase menu-icon"></i>
                <span class="menu-title">Instituciones</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.medicines.index') }}">
                <i class="ti-support menu-icon"></i>
                <span class="menu-title">Medicamentos</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.appointments.index') }}">
                <i class="ti-calendar menu-icon"></i>
                <span class="menu-title">Citas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.reports.index') }}">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Reportes</span>
            </a>
        </li>
    </ul>
</nav>
