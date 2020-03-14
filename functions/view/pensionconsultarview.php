<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('pensionver','Listado de Pensiones');
  ?>
<div class="row">
  <div class="col-12">
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
            <th>Usuario</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Descripción</th>
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

<!-- Modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modallogoutLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de eliminar este registro?
      </div>
      <form method="post" id="formEliminar" name="formEliminar">
        <div class="modal-footer">
          <input type="hidden" id="idEliminar" name="idEliminar" value="">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Actualizar-->
<div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="ModalActualizar" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="card-warning">
        <div class="card-header">
          <h3 class="card-title">Pensión <small> &nbsp; (*) Campos requeridos</small></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="form" name="form">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="form-group">
                  <label for="idcliente">ID Cliente</label>
                  <div class="input-group mb-3">
                    <input type="text" readonly class="form-control" placeholder="ID Cliente" id="idcliente" name="idcliente" aria-label="ID Cliente">
                    <input type="hidden" class="form-control" placeholder="ID Actualizar" id="idActualizar" name="idActualizar" aria-label="Idactualizar">
                  </div>
                </div>
              </div>
            </div>

              <div class="row">
                <div class="col-sm-12">
                  <!-- Profile Image -->
                  <div class="card card-warning card-outline" disabled="disabled">
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
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="modulo">Concepto (*)</label>
                    <select class="form-control select2" name="conceptotransaccion" id="conceptotransaccion" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="modulo">Tipo Concepto</label>
                    <input type="text" disabled class="form-control" id="tipoconceptotransaccion" name="tipoconceptotransaccion" value="" placeholder="Tipo concepto" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-12">
                  <label for="modulo">Monto (*)</label>
                  <div class="form-group input-group">

                    <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                          </span>
                    </div>
                    <input type="number" onkeypress="return soloNumeros(this);"  maxlength="10" class="form-control" id="monto" placeholder="Monto" name="monto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="descripcion">Descripción (*)</label>
                    <textarea type="text" id="descripcion" name="descripcion" value="" class="form-control" placeholder="Descripción"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
          </form>
      </div>
    </div>
<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {
    mostrarRegistros();
    enviarFormulario();
    eliminarRegistro();
    llenarComboConcepto();
    consultarTipoConcepto();
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
  var mostrarRegistros = function () {
    var table = $("#tablaDT").DataTable({
        ajax:{
          method: "POST",
          url: "../process/pensionajax.php",
          data: {"accion":"read"}
        },
        columns: [
          {data:"nombre_tipo_concepto"},
          {data:"nombre_concepto_transaccion"},
          {data:"nombre"},
          {data:"nombre_cliente"},
          {data:"fecha_registro"},
          {data:"monto"},
          {data:6}, //En la posición 6 está la descripción de la transacción.
          {data:null, "defaultContent": "<button class='editar btn btn-primary' data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button> " +
              "<button class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar'><i class=\"far fa-trash-alt\"></i></button>" }
        ],
        responsive: true,
        language: idiomaDataTable,
        lengthChange: true,
        buttons: ['copy','excel','csv','pdf','colvis'],
        dom: 'Bfltip'
      });

      table.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
      obtenerdatosDT(table);
  }

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();
      var ideliminar = $('#idEliminar').val(data.id_transaccion);
      var idactualizar = $("#idActualizar").val(data.id_transaccion);
      var idcliente = $("#idcliente").val(data.id_cliente);
      $('#imagencliente').attr("src","../../upload/images/client/"+data.imagen);
      var concepto = $("#conceptotransaccion option[value='"+ data.id_concepto_transaccion +"']").attr("selected",true);
      var concepto = $("#conceptotransaccion").val(data.id_concepto_transaccion).trigger('change.select2');
      var nombrecliente = $("#nombrecliente").val(data.nombre_cliente);
      var appat = $("#appat").val(data[24]); //En la posición 24 está el apellido paterno del cliente
      var apmat = $("#apmat").val(data[25]); //En la posición 25 está el apellido materno del cliente
      var monto = $("#monto").val(data.monto);
      var tipoconcepto = $("#tipoconceptotransaccion").val(data.nombre_tipo_concepto + "("+ data.signo_concepto +")");
      var descripcion = $("#descripcion").val(data[6]); //En la posición 25 está la descripción de la transacción
    });
  }

  var llenarComboConcepto = function () {
    $.ajax({
      type: "POST",
      url: "../process/conceptoajax.php",
      data: {'accion':'readbymodulo','idmodulo':'1'},
      success: function(data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          $('#conceptotransaccion').append("<option value='" + data[i]['id_concepto_transaccion'] + "'>"+ data[i]['nombre_concepto_transaccion'] +"</option>");
        });
        $.each(data, function (i, row) {
          $('#tipoconceptotransaccion').val(data[i]['nombre_tipo_concepto'] + "(" +data[i]['signo_concepto'] + ")" );
          return false;
        });
      }
    });
  }

  var consultarTipoConcepto = function () {
    $('#conceptotransaccion').change(function () {
      $.ajax({
        type: "POST",
        url: "../process/conceptoajax.php",
        data: {'accion':'readbyidconcepto','idconceptotransaccion': $('#conceptotransaccion').val()},
        success: function(data) {
          data = JSON.parse(data);
          $('#tipoconceptotransaccion').val(data.nombre_tipo_concepto + "(" +data.signo_concepto + ")" );
        }
      });
    });
  }
  var eliminarRegistro = function() {
    $("#btnEliminar").click(function () {
      $.ajax({
          type: "POST",
          url: "../process/pensionajax.php",
          data: {"accion":"delete", "idtransaccion": $('#idEliminar').val()},
          success: function(data) {
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El registro de pensión ha sido eliminado de manera correcta",
                "success"
              ).then(function() {
                window.location = "pensionconsultarview.php";
              });
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al eliminar el registro de pensión. " + data,
                "error"
              );
            }
          }
      });
    });
  }

  var enviarFormulario = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var datos = $('#form').serialize() + "&accion=update";
        $.ajax({
          type: "POST",
          url: "../process/pensionajax.php",
          data: datos,
          success: function(data){
            console.log(data);
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El registro de la pensión ha sido actualizado de manera correcta",
                "success"
              ).then(function() {
                window.location = "pensionconsultarview.php";
              });
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al actualizar el registro de la pensión. ",
                "error"
              );
            }
          },
        });
      }
    });
    $('#form').validate({
      rules: {
        monto: {
          required: true
        },
        descripcion: {
          required: true
        }
      },
      messages: {
        monto: {
          required: "Ingresa un monto"
        },
        descripcion: {
          required: "Ingresa una descripción"
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
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

</script>
