<!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i> </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Bienvenido estudiante!</a>
      </li>
      <li class="nav-item d-lg-none d-sm-inline-block">
        <a href="#" class="nav-link"><b>Logo</b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item bg-danger d-none d-sm-inline-block">
        <a class="nav-link"  href="../salir.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-dark">
      <img src="https://i.imgur.com/LXdeO3l.png" alt="Garpa Facil logo" class="brand-image ">
      <span class="brand-text font-weight-light">Logo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img class="img-circle" src="https://i.imgur.com/ae9dREh.png">
        </div>
        <div class="info">
          <a href="ajustes.php" class="d-block"><b>Elias Astrada</b></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          <li class="nav-item">
            <a href="inicio.php" class="nav-link <?php echo $active_inicio; ?>">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item bg-danger d-lg-none">
            <a href="../salir.php" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Cerrar Sesión</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
