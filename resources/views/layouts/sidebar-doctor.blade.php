<!-- partial:partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
  <div id="settings-trigger"><i class="ti-settings"></i></div>
  <div id="theme-settings" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <p class="settings-heading">Color de barra lateral</p>
    <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
    <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
    <p class="settings-heading mt-2">Color de barra superior</p>
    <div class="color-tiles mx-0 px-4">
      <div class="tiles success"></div>
      <div class="tiles warning"></div>
      <div class="tiles danger"></div>
      <div class="tiles info"></div>
      <div class="tiles dark"></div>
      <div class="tiles default"></div>
    </div>
  </div>
</div>
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('doctor') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <!-- Pacientes -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('doctor/pacientes') }}">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Pacientes</span>
      </a>
    </li>
    
    <!-- Tratamientos -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tratamientos" aria-expanded="false" aria-controls="tratamientos">
        <i class="ti-support menu-icon"></i>
        <span class="menu-title">Tratamientos</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tratamientos">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('doctor/tratamientos') }}"> Mis Tratamientos</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('doctor/medicamentos') }}"> Medicamentos </a></li>
        </ul>
      </div>
    </li>
    
    <!-- Citas -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('doctor/citas') }}">
        <i class="icon-calendar menu-icon"></i>
        <span class="menu-title">Citas</span>
      </a>
    </li>
    
    <!-- Reportes Médicos -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('doctor/reportes') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Reportes Médicos</span>
      </a>
    </li>
  </ul>
</nav>
<!-- partial -->