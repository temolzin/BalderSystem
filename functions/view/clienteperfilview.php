<?php
      $imagenCliente = $_POST['imagen'];
      $idcliente = $_POST['id_cliente'];
      $nombre = $_POST['nombre_cliente'];
      $appat = $_POST['ap_pat'];
      $apmat = $_POST['ap_mat'];
      $fechanacimiento = $_POST['fecha_nacimiento'];
      $genero = $_POST['nombre_genero'];
      $rfc = $_POST['rfc'];
      $curp = $_POST['curp'];
      $codigopostal = $_POST['codigo'];
      $estadoLocalidad = $_POST['estado'];
      $colonia = $_POST['colonia'];
      $municipio = $_POST['municipio'];
      $calle = $_POST['calle'];
      $nointerior = $_POST['nointerior'];
      $noexterior = $_POST['noexterior'];
      $altaimss = $_POST['alta_imss'];
      $bajaimss = $_POST['baja_imss'];
      $email = $_POST['email'];
      $nss = $_POST['nss'];
      $telefono = $_POST['telefono'];
      $observacion = $_POST['observacion'];
      $nombreCompletoCliente = $nombre . " " . $appat . " " . $apmat;
      //Variable para saber como se llama la carpeta donde se encuentran los documentos de los clientes.
      $nombreCompletoClienteDocumentos = $appat . "_" . $apmat . "_" . $nombre;

      # PARAMETROS:
      # $fecha_nacimiento - Fecha de nacimiento de una persona.
      #
      # $fecha_control - Fecha actual o fecha a consultar.
      #
      #
      # EJEMPLO:
      # tiempo_transcurrido('22/06/1977', '04/05/2009');
      #
      function tiempo_transcurrido($fecha_nacimiento, $fecha_control)
      {
        $fecha_actual = $fecha_control;

        if(!strlen($fecha_actual))
        {
          $fecha_actual = date('d/m/Y');
        }

        // separamos en partes las fechas
        $array_nacimiento = explode ( "/", $fecha_nacimiento );
        $array_actual = explode ( "/", $fecha_actual );

        $anos =  $array_actual[2] - $array_nacimiento[2]; // calculamos años
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias =  $array_actual[0] - $array_nacimiento[0]; // calculamos días

        //ajuste de posible negativo en $días
        if ($dias < 0)
        {
          --$meses;

          //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
          switch ($array_actual[1]) {
            case 1:
              $dias_mes_anterior=31;
              break;
            case 2:
              $dias_mes_anterior=31;
              break;
            case 3:
              if (bisiesto($array_actual[2]))
              {
                $dias_mes_anterior=29;
                break;
              }
              else
              {
                $dias_mes_anterior=28;
                break;
              }
            case 4:
              $dias_mes_anterior=31;
              break;
            case 5:
              $dias_mes_anterior=30;
              break;
            case 6:
              $dias_mes_anterior=31;
              break;
            case 7:
              $dias_mes_anterior=30;
              break;
            case 8:
              $dias_mes_anterior=31;
              break;
            case 9:
              $dias_mes_anterior=31;
              break;
            case 10:
              $dias_mes_anterior=30;
              break;
            case 11:
              $dias_mes_anterior=31;
              break;
            case 12:
              $dias_mes_anterior=30;
              break;
          }

          $dias=$dias + $dias_mes_anterior;

          if ($dias < 0)
          {
            --$meses;
            if($dias == -1)
            {
              $dias = 30;
            }
            if($dias == -2)
            {
              $dias = 29;
            }
          }
        }

        //ajuste de posible negativo en $meses
        if ($meses < 0)
        {
          --$anos;
          $meses=$meses + 12;
        }

        $tiempo[0] = $anos;
        $tiempo[1] = $meses;
        $tiempo[2] = $dias;

        return $tiempo;
      }

      function bisiesto($anio_actual){
        $bisiesto=false;
        //probamos si el mes de febrero del año actual tiene 29 días
        if (checkdate(2,29,$anio_actual))
        {
          $bisiesto=true;
        }
        return $bisiesto;
    }

?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" style="height: 100px;"
                   src="../../upload/images/client/<?php echo $imagenCliente;?>"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $nombre?></h3>

            <p class="text-muted text-center"><?php echo $appat . " " .$apmat?></p>
            <p class="text-muted text-center">ID Cliente: <?php echo $idcliente?></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="text-center list-group-item">
                <b>Pensión</b> <br>
              </li>
              <li class="list-group-item">
                <b>Cargos</b> <a id="cargo" name="cargo" class="float-right">$0.0</a> <br>
                <b>Abonos</b> <a id="abono" name="abono" class="float-right">$0.0</a> <br>
                <b>Total</b> <a id="total" name="total" class="float-right">$0.0</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Información General</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>
            <p class="text-muted"><?php echo $calle . ", " . $codigopostal . ", " . $colonia . ", " . $municipio . ", " . $estadoLocalidad; ?></p>
            <hr>

            <strong><i class="fas fa-user-tie mr-1"></i> Datos Físcales</strong>

            <p class="text-muted">
              RFC: <?php echo $rfc;?><br>
              CURP: <?php echo $curp?> <br>
            </p>

            <strong><i class="fas fa-notes-medical mr-1"></i> IMSS</strong>

            <p class="text-muted">
              NSS: <?php echo $nss==""?"No Registrado":$nss?><br>
              Alta: <?php echo $altaimss?> <br>
              Baja: <?php echo $bajaimss?> <br>
              Edad: <?php
              //Para imprimir la edad en años, meses y días
              $fechaactual = date('d/m/Y');
              $fechanacimiento = date('d/m/Y',strtotime($fechanacimiento));
              $tiempo = tiempo_transcurrido($fechanacimiento, $fechaactual);
              $texto = "$tiempo[0] años con $tiempo[1] meses y $tiempo[2] días";
              echo $texto;
              ?> <br>
            </p>

            <hr>
            <strong><i class="far fa-file-alt mr-1"></i> Observaciones</strong>

            <p class="text-muted"><?php echo $observacion==""?"Ninguna":$observacion;?></p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Transacciones</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tablaDTPension" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Módulo</th>
                  <th>Tipo Concepto</th>
                  <th>Concepto</th>
                  <th>Fecha</th>
                  <th>Monto</th>
                  <th>Descripción</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        <div class="row">
          <div class="col-lg-6 text-center">
            <a download="archivo.pdf" href="../process/reporteajax.php?idcliente=<?php echo $idcliente;?>&accion=reporteEstadoCuentaPension"><button disabled class="btn btn-danger" name="btnEstadoCuentaPension" id="btnEstadoCuentaPension"><i class="far fa-file-pdf"></i> Estado de Cuenta Pensión</button></a>
          </div>
          <div class="col-lg-6 text-center">
            <a download="archivo.pdf" href="../process/reporteajax.php?idcliente=<?php echo $idcliente;?>&accion=reporteEstadoCuentaPrestamo"><button disabled class="btn btn-danger" id="btnEstadoCuentaPrestamo" name="btnEstadoCuentaPrestamo"><i class="far fa-file-pdf"></i> Estado de Cuenta Préstamo</button></a>
          </div>
        </div>
        <br>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Documentos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tablaDTDocumento" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Documento</th>
                  <th>Estatus</th>
                  <th>Descargar</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        <div class="col-lg-12 text-center">
          <a download="archivo.pdf" href="../process/reporteajax.php?idcliente=<?php echo $idcliente;?>&accion=reporteDocumentoCliente"><button class="btn btn-danger" id="btnCheckListDocumentos"><i class="far fa-file-pdf"></i> CheckList Documentos</button></a>
        </div>
        <br>
        </div>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>


<script type="text/javascript">
  $(document).ready(function () {
    asignarCargosAbonos();
    mostrarRegistrosDocumento();
    // generarReporteEstadoCuentaPension();
  });

  var idiomaDataTable = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
      "copy": "Copiar",
      "colvis": "Visibilidad"
    }
  };

  var asignarCargosAbonos = function () {
      $.ajax({
        method: "POST",
        url: "../process/transaccionajax.php",
        data: {"accion": "readbyidclientearray", "idcliente": "<?php echo $idcliente;?>"},
        success: function (data) {
          try {
            data = JSON.parse(data);
            var cargo = 0.0;
            var abono = 0.0;
            var total = 0.0;
            $.each(data, function (i, row) {
              if (data[i]['nombre_tipo_concepto'] === 'Cargo') {
                cargo += parseFloat(data[i]['monto']);
              } else {
                abono += parseFloat(data[i]['monto']);
              }
            });
            total = cargo - abono;
            $('#cargo').text("$" + cargo);
            $('#abono').text("$" + abono);
            $('#total').text("$" + total);
            mostrarRegistrosTransaccion();
          } catch (e) {
            var table = $("#tablaDTPension").DataTable({
              responsive: true,
              language: idiomaDataTable,
              lengthChange: true,
            });
          }
        }
      })
  }
  var mostrarRegistrosDocumento = function () {
      var table1 = $("#tablaDTDocumento").DataTable({
        ajax:{
          method: "POST",
          url: "../process/documentoclienteajax.php",
          data: {"accion":"readdocumentosbyidcliente", "idcliente" :  "<?php echo $idcliente;?>"}
        },
        columns: [
          {data:"nombre_documento"},
          {
            render: function (data, type, row) {
              if(row.docup == null) {
                return "<img class='text-center img-fluid' width='40px' height='40px' src='../../dist/img/icons/error.png'>";
              } else {
                return "<img class='text-center img-fluid' width='40px' height='40px' src='../../dist/img/icons/ok.png'>";
              }
            }
          },
          {
            render: function (data, type, row) {
              console.log(row);
              if(row.docup == null) {
                return "<button class='editar btn btn-default' disabled='true'><i class=\"fa fa-cloud-download-alt\"></i></button>";
              } else {
                return "<a target='_blank' href='../../upload/documents/<?php echo $nombreCompletoClienteDocumentos;?>/"+row.urldocumento+"'><button class='editar btn btn-primary'><i class=\"fa fa-cloud-download-alt\"></i></button></a>";
              }
            }
          }
        ],
        responsive: true,
        language: idiomaDataTable,
        lengthChange: true,
        dom: 'fltip'
      });

      table1.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
  }

  var mostrarRegistrosTransaccion = function () {
    var table = $("#tablaDTPension").DataTable({
      destroy: true,
      ajax:{
        method: "POST",
        url: "../process/transaccionajax.php",
        data: {"accion": "readbyidcliente", "idcliente": "<?php echo $idcliente;?>"}
      },
      columns: [
        {
          render: function (data, type, row) {
            if(row.nombre_modulo == "Préstamo") {
              $('#btnEstadoCuentaPrestamo').attr("disabled", false);
              return row.nombre_modulo;
            } else if(row.nombre_modulo == "Pensión"){
              $('#btnEstadoCuentaPension').attr("disabled", false);
              return row.nombre_modulo;
            }
          }
        },
        {data:"nombre_tipo_concepto"},
        {data:"nombre_concepto_transaccion"},
        {data:"fecha_registro"},
        {data:"monto", render: $.fn.dataTable.render.number( ',', '.', 2, '$') },
        {data:6} //En la posición 6 está la descripción de la transacción.
      ],
      responsive: true,
      language: idiomaDataTable,
      lengthChange: true,
      buttons: ['copy','excel','csv','pdf','colvis'],
      dom: 'Bfltip'
    });
    table.buttons().container().appendTo('#tablaDTPension_wrapper .col-md-6:eq(0)');
  }

  //Función para ver lo que retorna php al darle clic en el boton de generar reporte
  //var generarReporteEstadoCuentaPension = function () {
  //  $('#btnEstadoCuentaPension').click(function () {
  //    $.ajax({
  //      method: "POST",
  //      url: "../process/reporteajax.php",
  //      data: {"accion": "reporteEstadoCuentaPension", "idcliente": "<?php //echo $idcliente;?>//"},
  //      success: function (data) {
  //        console.log(data);
  //      }
  //    })
  //  });
  //}
  //
  ////Función para ver lo que retorna php al darle clic en el boton de generar reporte
  //var generarReporteEstadoCuentaPension = function () {
  //  $('#btnCheckListDocumentos').click(function () {
  //    $.ajax({
  //      method: "POST",
  //      url: "../process/reporteajax.php",
  //      data: {"accion": "reporteDocumentoCliente", "idcliente": "<?php //echo $idcliente;?>//"},
  //      success: function (data) {
  //        console.log(data);
  //      }
  //    })
  //  });
  //}
  </script>
