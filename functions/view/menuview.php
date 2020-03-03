<?php
session_start();
require_once '../controller/conexion.php';

class Menu {
  public $nombreCompleto, $nombreMedio, $nombre, $username, $password, $appat, $apmat, $email, $telefono, $activo, $imagen, $urlimagen, $tipousuario;

  public function __construct()
  {
    $this->nombreCompleto = $_SESSION['user']['nombrecompleto'];
    $this->nombreMedio = $_SESSION['user']['nombremedio'];
    $this->nombre = $_SESSION['user']['nombre'];
    $this->appat = $_SESSION['user']['ap_pat'];
    $this->apmat = $_SESSION['user']['ap_mat'];
    $this->username = $_SESSION['user']['username'];
    $this->password = $_SESSION['user']['password'];
    $this->email = $_SESSION['user']['email'];
    $this->telefono = $_SESSION['user']['telefono'];
    $this->activo = $_SESSION['user']['activo'];
    $this->imagen = $_SESSION['user']['imagen'];
    $this->urlimagen = "../../upload/images/user/" . $_SESSION['user']['imagen'];
    $this->tipousuario = $_SESSION['user']['nombre_tipo_usuario'];
  }

  function header($active, $title) {

    $activeInicio = "";
    $activeCliente = "";
    $activeClienteVer = "";
    $activeClienteReg = "";
    $activeUsuarioVer = "";
    $activeUsuarioReg = "";
    $activeConceptosVer = "";
    $activeConceptosReg = "";
    $activeDocumentoVer= "";
    $activeDocumentoReg = "";
    $activePrestamoVer = "";
    $activePrestamoReg = "";
    $activePensionVer = "";
    $activePensionReg = "";

    if($active == 'inicio') {
      $activeInicio = "active";
    } elseif ($active == 'clientever'){

    }

    echo '<!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Balder System</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../../dist/img/icons/favicon.png"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      </head>
      <body class="hold-transition sidebar-mini">
      <!-- Site wrapper -->
      <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="../../index3.html" class="nav-link">Inicio</a>
            </li>
          </ul>
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="'.$this->urlimagen.'" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">'.$this->nombreMedio.'</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                  <img src="'.$this->urlimagen.'" class="img-circle elevation-2" alt="User Image">
      
                  <p>
                    '.$this->nombreCompleto.'
                    <small>' . $this->tipousuario . '</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  <a href="#" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#modallogout">Cerrar sesión</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->
      
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="dashboardview.php" class="brand-link">
            <img src="../../dist/img/icons/favicon.png"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">BalderSystem</span>
          </a>
      
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../../index.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v1</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../../index2.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v2</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v3</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Widgets
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>' . $title . '</h1>
                </div>
                <div class="col-sm-6">
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
          <!-- Main content -->
          
          <!-- Modal LOGOUT-->
          <div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="modallogoutLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Estás seguro de salir del sistema?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <a href="../process/logout.php" class="btn btn-danger">Cerrar sesión</a>
                </div>
              </div>
            </div>
          </div>
          <section class="content">';
  }

  function footer() {
    echo '  </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Software for pension Version </b> 1.0
          </div>
          <strong>Copyright &copy; 2020 <a href="http://baldersystem.com">BalderSystem</a>.</strong> All rights
          reserved.
        </footer>
      
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
      
      <!-- jQuery -->
      <script src="../../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../../dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../../dist/js/demo.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
      </body>
      </html>';
  }
}
