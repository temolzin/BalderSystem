<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('reporteestadocuenta','Generar Reporte Estado de Cuenta');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Reporte Estado de Cuenta <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="formCliente" name="formCliente">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="combocliente">Cliente (*)</label>
                    <select class="form-control select2" name="combocliente" id="combocliente" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="modulo">Modulo (*)</label>
                    <select class="form-control select2" name="combomodulo" id="combomodulo" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer" id="divbtnGenerarReporteEstadoCuenta">
            </div>
          </form>

        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<?php
  $menu->footer();
?>
<script>
  $(document).ready(function () {
    llenarComboModulo();
    llenarComboCliente();
    cambiarValorCombos();
    // generarReporteEstadoCuentaPension();
  });

  //Función para ver que retorna reporteAJAX
  // var generarReporteEstadoCuentaPension = function () {
  //   $('#btnGenerarReporteEstadoCuenta').click(function () {
  //     $.ajax({
  //       method: "POST",
  //       url: "../process/reporteajax.php",
  //       data: {"accion": $('#combomodulo').val(), "idcliente": $('#combocliente').val()},
  //         success: function (data) {
  //           console.log(data);
  //         }
  //       });
  //   });
  // }

  //Método que detecta cuando se hace un cambio en algún select para asignarle valor a  la etiquete <a> para generar el PDF
  var cambiarValorCombos = function () {
    $('#combocliente').change(function () {
      $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente').val()+'&accion='+$('#combomodulo').val()+'"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');
    });
    $('#combomodulo').change(function () {
      $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente').val()+'&accion='+$('#combomodulo').val()+'"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');
    });
  }

  <?php
  //*********************Se verifica que privilegios de módulo o modulos cuenta el usuario para hacer la consulta************************
  $accion = "";
  $idmodulo = "";
  if($menu->privilegioModuloPrestamo == true && $menu->privilegioModuloPension == true) {
    $accion = "read";
    $idmodulo = "";
  } else if($menu->privilegioModuloPrestamo == false && $menu->privilegioModuloPension == true) {
    $accion = "readbyidmodulo";
    $idmodulo = ', "idmodulo" : "1"';
  } else if($menu->privilegioModuloPrestamo == true && $menu->privilegioModuloPension == false) {
    $accion = "readbyidmodulo";
    $idmodulo = ', "idmodulo" : "2"';
  }
  ?>
  var llenarComboModulo = function () {
    $("#combomodulo").val('0');
    $("#combocliente").val('0');
    $.ajax({
      type: "POST",
      url: "../process/moduloajax.php",
      data: {'accion':"<?php echo $accion;?>" <?php echo $idmodulo?>}, //El idmodulo 1 es de pensiones
      success: function(data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          $('#combomodulo').append("<option value='" + data[i]['id_modulo'] + "'>"+ data[i]['nombre_modulo'] +"</option>");
        });
        //Se ejecuta este código después de cada Ajax ya que si se pone sólo manda null, porque aún no se ha cargado el select
        $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente option:selected').val()+'&accion='+$('#combomodulo option:selected').val()+'"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');
      }
    });
  }

  var llenarComboCliente = function () {
    $.ajax({
      type: "POST",
      url: "../process/clienteajax.php",
      data: {'accion':'readarray'}, //El idmodulo 1 es de pensiones
      success: function(data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          $('#combocliente').append("<option value='" + data[i]['id_cliente'] + "'>"+ data[i]['nombre_cliente'] +" " +data[i]['ap_pat'] + " " + data[i]['ap_mat']  +"</option>");
        });
        //Se ejecuta este código después de cada Ajax ya que si se pone sólo manda null, porque aún no se ha cargado el select
        $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente option:selected').val()+'&accion='+$('#combomodulo option:selected').val()+'"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');

      }
    });
  }
</script>
