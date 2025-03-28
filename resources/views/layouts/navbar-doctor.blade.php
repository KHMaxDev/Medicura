<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medicura Doctor</title>
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('src/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('src/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('src/css/vendor.bundle.base.css') }}">
  
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('src/datatables/net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('src/select.dataTables.min.css') }}">
  
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('src/vertical-layout-light/style.css') }}">
  
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('src/assets/images/favicon.png') }}">
  
  <style>
    .table td {
      max-width: 200px;
      word-wrap: break-word;
      white-space: normal;
    }
    th {
      color: white;
      background: #4B49AC;
    }
    .btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('doctor') }}"><img src="{{asset('favicon.png')}}" class="mr-2" alt="logo"/>Medicura Doctor</a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('doctor') }}"><img src="{{asset('favicon.png')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('favicon.png')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
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
    <div class="container-fluid page-body-wrapper">
      @include('layouts.sidebar-doctor')
      @yield('content')
    </div>
  </div>

  <!-- plugins:js -->
  <script src="{{ asset('src/js/vendor.bundle.base.js') }}"></script>
  
  <!-- Plugin js for this page -->
  <script src="{{ asset('src/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('src/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('src/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  
  <!-- Custom js for this page-->
  <script src="{{ asset('src/dashboard.js') }}"></script>
  <script src="{{ asset('src/Chart.roundedBarCharts.js') }}"></script>
  
  <!-- inject:js -->
  <script src="{{ asset('src/off-canvas.js') }}"></script>
  <script src="{{ asset('src/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('src/template.js') }}"></script>
  <script src="{{ asset('src/settings.js') }}"></script>
  
  @yield('scripts')
</body>
</html>