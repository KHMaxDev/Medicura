<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MedicuraADM</title>
<!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('src/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('src/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('src/css/vendor.bundle.base.css') }}">
<!-- endinject -->

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('src/datatables/net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/select.dataTables.min.css') }}">
<!-- End plugin css for this page -->

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('src/vertical-layout-light/style.css') }}">
<!-- endinject -->

<!-- Favicon -->
<link rel="icon" href="{{ asset('src/assets/images/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('src/assets/images/favicon.png') }}" />

<!-- DataTable CSS -->
<link rel="stylesheet" href="{{ asset('src/datatables/dataTables.bootstrap4.min.css') }}">

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
  <!-- Verificar si NO estamos en la página /admin -->
@if(!request()->is('admin'))
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  
  <script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function () {
      $jq('#dataTable').DataTable({
        "pageLength": 5,
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]],
        "language": {
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No se encontraron registros",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "No hay registros disponibles",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          }
        }
      });
    });
  </script>
@endif

@if(!request()->is('admin/instituciones/editar/{id}') || !request()->is('/instituciones/create'))
<link rel="stylesheet" href="{{ asset('src/owncss/edit.css') }}">
@endif
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="{{ url('admin') }}"><img src="{{asset('favicon.png')}}" class="mr-2" alt="logo"/>Medicura</a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('admin') }}"><img src="{{asset('favicon.png')}}" alt="logo"/></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <!---->
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="{{ url('admin') }}" data-toggle="dropdown" id="profileDropdown">
          <img src="{{asset('favicon.png')}}" alt="profile"/>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{url('/')}}">
            <i class="ti-power-off text-primary"></i>
            Cerrar sesión
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
    <div class="container-fluid page-body-wrapper">
@include('layouts.sidebar-admin')
@yield('content')