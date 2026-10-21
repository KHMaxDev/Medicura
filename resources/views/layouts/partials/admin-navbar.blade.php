<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('favicon.svg') }}" class="mr-2" alt="Medicura">Medicura
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('favicon.svg') }}" alt="Medicura">
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{{ auth()->user()->nombre }}</span>
                    <i class="ti-user ml-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <span class="dropdown-item-text small text-muted">{{ auth()->user()->email }}</span>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="ti-power-off text-primary"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
