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
    <!--Página de inicio-->
    <li class="nav-item">
      <a class="nav-link" href="/proyecto_medicura/medicurav4/admin/index.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Inicio</span>
      </a>
    </li>
    <!--Usuarios-->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Usuarios</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/MedicuraV4/admin/medicos.php">Médicos</a></li>
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/MedicuraV4/admin/pacientes.php">Pacientes</a></li>
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/MedicuraV4/admin/cuidadores.php">Cuidadores</a></li>
        </ul>
      </div>
    </li>
    <!--Gráficas/Reportes-->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Reportes</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <!--Agregar elementos (discutir)-->
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/medicurav4/admin/reportes.php">Estatus</a></li>
        </ul>
      </div>
    </li>
    <!--Médicamentos-->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="ti-support menu-icon"></i>
        <span class="menu-title">Médicos</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/medicurav4/admin/instituciones.php"> Instituciones</a></li>
          <li class="nav-item"> <a class="nav-link" href="/proyecto_medicura/medicurav4/admin/medicamentos.php"> Médicamentos </a></li>
        </ul>
      </div>
    </li>

  </ul>
</nav>
<!-- partial -->