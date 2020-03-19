<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('subirdocumento','Carga de documentos');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Carga Documentos <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="formCliente" name="formCliente">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="idcliente">ID Cliente</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" maxlength="7" onkeypress="return soloNumeros();" placeholder="ID Cliente" id="idcliente" name="idcliente" aria-label="ID Cliente">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="submit" id="btnBuscarCliente"><i class="fas fa-search"></i> Buscar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div id = "divcontainer" name="divcontainer" style="display: none">
            <form role="form" id="form" name="form">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- Profile Image -->
                    <div class="card card-blue card-outline" disabled="disabled">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img style="height: 100px;" class="profile-user-img img-fluid img-circle" src=""
                               alt="Foto del cliente" id="imagencliente" name="imagencliente">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" disabled class="form-control" id="nombrecliente" name="nombrecliente" value="" placeholder="Nombre Cliente" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Paterno</label>
                      <input type="text" disabled class="form-control" id="appat" name="appat" value="" placeholder="Apellido Paterno" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Materno</label>
                      <input type="text" disabled class="form-control" id="apmat" name="apmat" value="" placeholder="Apellido Materno" />
                    </div>
                  </div>
                </div>
            </form>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Documentos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                      <th>Documento</th>
                      <th>Estatus</th>
                      <th></th>
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
    enviarFormularioIdcliente();
    mostrarRegistros();
  });

  var enviarFormularioIdcliente = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var datos = $('#formCliente').serialize() + "&accion=readbyid";
        $.ajax({
          type: "POST",
          url: "../process/clienteajax.php",
          data: datos,
          success: function(data) {
            try {
              data = JSON.parse(data);
              $('#imagencliente').attr("src", "../../upload/images/client/" + data.imagen);
              $('#nombrecliente').val(data.nombre_cliente);
              $('#appat').val(data.ap_pat);
              $('#apmat').val(data.ap_mat);
              document.getElementById('divcontainer').style.display = 'block';
            } catch (e) {
              document.getElementById('divcontainer').style.display = 'none';
              Swal.fire(
                "¡No encontrado!",
                "No se ha encontrado ese ID, favor de revisarlo. ",
                "error"
              );
            }
          }
        });
      }
    });
    $('#formCliente').validate({
      rules: {
        idcliente: {
          required: true
        }
      },
      messages: {
        idcliente: {
          required: "Ingresa un ID del cliente"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  }


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
  var mostrarRegistros = function () {
    var table = $("#tablaDT").DataTable({
      ajax:{
        method: "POST",
        url: "../process/documentoajax.php",
        data: {"accion":"read"}
      },
      columns: [
        {data:"nombre_documento"},
        {data:null, "defaultContent": "<img class='text-center img-fluid' width='40px' height='40px' src='../../dist/img/icons/error.png'>" },
        {data:null, "defaultContent": "<button class='editar btn btn-primary' data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-cloud-upload-alt\"></i></button>" }
      ],
      responsive: true,
      language: idiomaDataTable,
      lengthChange: true,
      dom: 'fltip'
    });

    table.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
    obtenerdatosDT(table);
  }

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();
      var ideliminar = $('#idEliminar').val(data.id_documento);
      var iddocumento = $("#iddocumento").val(data.id_documento);
      var nombre_documento = $("#nombre").val(data.nombre_documento);
      var descripcion = $("#descripcion").val(data.descripcion);
    });
  }

</script>
