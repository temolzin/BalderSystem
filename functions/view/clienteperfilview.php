<?php
      $imagenCliente = $_POST['imagen'];
      $idcliente = $_POST['id_cliente'];
      $nombre = $_POST['nombre_cliente'];
      $appat = $_POST['ap_pat'];
      $apmat = $_POST['ap_mat'];
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
      $nombreCompletoClienteDocumentos = $apmat . "_" . $apmat . "_" . $nombre;
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
            <button class="btn btn-danger" id="btnEstadoCuentaPension"><i class="far fa-file-pdf"></i> Estado de Cuenta Pensión</button>
          </div>
          <div class="col-lg-6 text-center">
            <button class="btn btn-danger" id="btnEstadoCuentaPension"><i class="far fa-file-pdf"></i> Estado de Cuenta Préstamo</button>
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
          <button class="btn btn-danger" id="btnCheckListDocumentos"><i class="far fa-file-pdf"></i> CheckList Documentos</button>
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
        {data:"nombre_modulo"},
        {data:"nombre_tipo_concepto"},
        {data:"nombre_concepto_transaccion"},
        {data:"fecha_registro"},
        {data:"monto"},
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
  </script>
