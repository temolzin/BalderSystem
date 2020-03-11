<?php
session_start();
if(isset($_SESSION['user']) == false) {
  header('Location: ../../index.php');
}
require_once '../controller/conexion.php';

class Menu {
  public $nombreCompleto, $nombreMedio, $nombre, $username, $password, $appat, $apmat, $email, $telefono, $activo, $imagen, $urlimagen, $tipousuario;
  //variable para agregar archivos JS
  public $librerias;
  public $conex;
  public function __construct()
  {
    $this->conex = Conexion::getInstance();
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
    $activeUsuario = "";
    $activeUsuarioVer = "";
    $activeUsuarioReg = "";
    $activeConceptos = "";
    $activeConceptosVer = "";
    $activeConceptosReg = "";
    $activeDocumento= "";
    $activeDocumentoVer= "";
    $activeDocumentoReg = "";
    $activePrestamo = "";
    $activePrestamoVer = "";
    $activePrestamoReg = "";
    $activePension = "";
    $activePensionVer = "";
    $activePensionReg = "";
    $activeReporte = "";
    $activeReporteCheckList = "";
    $activeReporteEstadoCuenta = "";
    $libraryInicio = "";

    if($active == 'inicio') {
      $activeInicio = "active";
      $title = "Bienvenido: " . $this->nombreCompleto;
      $this->librerias = "<script src=\"../../plugins/chart.js/Chart.min.js\"></script>
      <script src=\"../../dist/js/pages/dashboard3.js\"></script>";
    } elseif ($active == 'clientever'){
      $activeCliente = 'active';
      $activeClienteVer = 'active';
    } elseif ($active == 'clientereg') {
      $activeCliente = 'active';
      $activeClienteReg = 'active';
    } elseif ($active == 'documentoreg') {
      $activeDocumento = 'active';
      $activeDocumentoReg = 'active';
    } elseif ($active == 'documentover') {
      $activeDocumento = 'active';
      $activeDocumentoVer = 'active';
    } elseif ($active == 'conceptoreg') {
      $activeConceptos = 'active';
      $activeConceptosReg = 'active';
    } elseif ($active == 'conceptover') {
      $activeConceptos = 'active';
      $activeConceptosVer = 'active';
    } elseif ($active == 'usuarioreg') {
      $activeUsuario = 'active';
      $activeUsuarioReg = 'active';
    } elseif ($active == 'usuariover') {
      $activeUsuario = 'active';
      $activeUsuarioVer = 'active';
    }

    echo '<!DOCTYPE html>
      <html>
      <head lang="es">
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
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.css">
        <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <a href="dashboardview.php" class="nav-link">Inicio</a>
            </li>
          </ul>
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="'.$this->urlimagen.'" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-md-inline">'.$this->tipousuario.'</span>
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
                 alt="BalderSystem Logo"
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
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                    <img src="'.$this->urlimagen.'" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                    <a href="#" class="d-block">'.$this->nombreMedio.'</a>
                  </div>
                </div>
                <li class="nav-item">
                  <a href="dashboardview.php" class="nav-link '.$activeInicio.'">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link '.$activeCliente. '">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Clientes
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="clienteregistrarview.php" class="nav-link ' .$activeClienteReg. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Cliente</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="clienteconsultarview.php" class="nav-link ' .$activeClienteVer.'">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Clientes</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link '.$activePension.'">
                    <i class="nav-icon fas fa-dollar-sign"></i>
                    <p>
                      Pensión
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item '.$activePensionReg.'">
                      <a href="registrarpensionview.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Pension</p>
                      </a>
                    </li>
                    <li class="nav-item '.$activePensionVer.'">
                      <a href="consultarpensionview.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Pensiones</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link '.$activePrestamo.'">
                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                    <p>
                      Préstamos
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="registrarprestamoview.php" class="nav-link '.$activePrestamoReg.'">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Préstamo</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="consultarprestamoview.php" class="nav-link '.$activePrestamoVer.'">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Préstamos</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link '.$activeReporte.'">
                    <i class="nav-icon fas fa-file-pdf"></i>
                    <p>
                      Reportes
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item '.$activeReporteCheckList.'">
                      <a href="reporteCheckListview.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>CheckList</p>
                      </a>
                    </li>
                    <li class="nav-item '.$activeReporteEstadoCuenta.'">
                      <a href="reporteEstadoCuentaview.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Estado de cuenta</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link '.$activeDocumento.'">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Documentos
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="documentoregistrarview.php" class="nav-link '.$activeDocumentoReg. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Documento</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="documentoconsultarview.php" class="nav-link ' .$activeDocumentoVer. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Documentos</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link ' .$activeConceptos.'">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                      Conceptos
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="conceptoregistrarview.php" class="nav-link  '.$activeConceptosReg. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Concepto</p>
                      </a>
                    </li>
                    <li class="nav-item ">
                      <a href="conceptoconsultarview.php" class="nav-link ' .$activeConceptosVer. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Conceptos</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link ' .$activeUsuario.'">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                      Usuarios
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="usuarioregistrarview.php" class="nav-link '.$activeUsuarioReg. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registrar Usuarios</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="usuarioconsultarview.php" class="nav-link ' .$activeUsuarioVer. '">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver Usuarios</p>
                      </a>
                    </li>
                  </ul>
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
      <!-- jquery-validation -->
      <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
      <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
      <script src="../../dist/js/validaciones.js"></script>
      <!-- DataTables -->
      <script src="../../plugins/datatables/jquery.dataTables.js"></script>
      <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
      <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="../../plugins/jszip/jszip.min.js"></script>
      <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
      <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      '.$this->librerias.'
      </body>
      </html>';
  }
}
