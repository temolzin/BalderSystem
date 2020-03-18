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

            <ul class="list-group list-group-unbordered mb-3">
              <li class="text-center list-group-item">
                <b>Pensión</b> <br>
              </li>
              <li class="list-group-item">
                <b>Cargos</b> <a id="cargo" name="cargo" class="float-right">$0.0</a> <br>
                <b>Abonos</b> <a id="abono" name="abono" class="float-right">$0.0</a>
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
            <h3 class="card-title">Pensiones</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
              <thead>
              <tr>
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
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>


<script type="text/javascript">
  $(document).ready(function () {
    asignarCargosAbonos();
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
        url: "../process/pensionajax.php",
        data: {"accion": "readbyidclientearray", "idcliente": "<?php echo $idcliente;?>"},
        success: function (data) {
          try {
            data = JSON.parse(data);
            var cargo = 0.0;
            var abono = 0.0;
            $.each(data, function (i, row) {
              if (data[i]['nombre_tipo_concepto'] === 'Cargo') {
                cargo += parseFloat(data[i]['monto']);
              } else {
                abono += parseFloat(data[i]['monto']);
              }
            });
            $('#cargo').text("$" + cargo);
            $('#abono').text("$" + abono);
            mostrarRegistros();
          } catch (e) {
            var table = $("#tablaDT").DataTable({
              responsive: true,
              language: idiomaDataTable,
              lengthChange: true,
            });
          }
        }
      })
  }

  var mostrarRegistros = function () {

    var table = $("#tablaDT").DataTable({
      destroy: true,
      ajax:{
        method: "POST",
        url: "../process/pensionajax.php",
        data: {"accion": "readbyidcliente", "idcliente": "<?php echo $idcliente;?>"}
      },
      columns: [
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
    table.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
  }
  </script>
