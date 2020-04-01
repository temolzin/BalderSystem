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
          </div>

          <hr class="bg-gradient-navy">

          <div class="row">
            <div class="col-12">
              <div>
<!--              <div class="card">-->
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
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

  <!-- Modal Subir Documento-->
  <div class="modal fade" id="modalSubirDocumento" tabindex="-1" role="dialog" aria-labelledby="modalSubirDocumento" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="card-primary">
          <div class="card-header">
          <h3 class="card-title">Subir Documento <small> &nbsp; (*) Campos requeridos</small></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="formSubirDocumento" name="formSubirDocumento">
          <input type="hidden" id="iddocumento" name="iddocumento"/>
          <input type="hidden" id="idclientedoc" name="idclientedoc"/>
          <input type="hidden" id="nombrecompletocliente" name="nombrecompletocliente"/>
          <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $menu->idusuario; ?>"/>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="form-group">
                  <label>Documento (*)</label>
                  <div class="custom-file">
                    <input type="file" accept="application/pdf" class="custom-file-input" id="documentocliente" name="documentocliente" lang="es">
                    <label class="custom-file-label" for="documentocliente">Selecciona Documento</label>
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="observacion">Observación </label>
                    <textarea name="observacion" id="observacion" class="form-control" placeholder="Observación" value=""></textarea>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Subir Documento</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<?php
  $menu->footer();
?>
<script>
  $(document).ready(function () {
    enviarFormularioIdcliente();
    enviarFormularioSubirDocumento();
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
              $('#idclientedoc').val(data.id_cliente);
              $('#imagencliente').attr("src", "../../upload/images/client/" + data.imagen);
              var nombrecliente = $('#nombrecliente').val(data.nombre_cliente);
              var appat = $('#appat').val(data.ap_pat);
              var apmat = $('#apmat').val(data.ap_mat);
              //Se manda el nombre completo del cliente seleccionado al modal de subir documento
              $('#nombrecompletocliente').val(data.ap_pat + "_" + data.ap_mat + "_" + data.nombre_cliente);
              document.getElementById('divcontainer').style.display = 'block';
              mostrarDocumentos(data.id_cliente);
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

  var enviarFormularioSubirDocumento = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var form_data = new FormData();
        var documentocliente = $('#documentocliente').prop('files')[0];
        var iddocumento = document.getElementById('iddocumento');
        var idclientedoc = document.getElementById('idclientedoc');
        var idusuario = document.getElementById('idusuario');
        var observacion = document.getElementById('observacion');

        form_data.append('documentocliente', documentocliente);
        form_data.append('iddocumento', iddocumento.value);
        form_data.append('idcliente', idclientedoc.value);
        form_data.append('idusuario', idusuario.value);
        form_data.append('observacion', observacion.value);
        form_data.append('nombrecompletocliente', document.getElementById('nombrecompletocliente').value);
        form_data.append('accion', "insert");

        $.ajax({
          type: "POST",
          url: "../process/documentoclienteajax.php",
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(data) {
            if(data == "ok") {
              Swal.fire(
                "¡Éxito!",
                "Se ha subido el archivo de manera correcta",
                "success"
              );
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al subir el archivo. " + data,
                "error"
              );
            }
          }
        });
      }
    });
    $('#formSubirDocumento').validate({
      rules: {
        documentocliente: {
          required: true
        }
      },
      messages: {
        documentocliente: {
          required: "Selecciona un archivo"
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
  var mostrarDocumentos = function (idcliente) {
    var table = $("#tablaDT").DataTable({
      ajax:{
        method: "POST",
        url: "../process/documentoclienteajax.php",
        data: {"accion":"readdocumentos", "idcliente" : idcliente}
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
        {data:null, "defaultContent": "<button class='editar btn btn-primary' data-toggle='modal' data-target='#modalSubirDocumento'><i class=\"fa fa-cloud-upload-alt\"></i></button>" }
      ],
      responsive: true,
      language: idiomaDataTable,
      destroy: true,
      lengthChange: true,
      dom: 'fltip'
    });

    table.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
    obtenerdatosDT(table);
  }

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();
      var iddocumento = $("#iddocumento").val(data.id_documento);
    });
  }

</script>
