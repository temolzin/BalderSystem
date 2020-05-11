<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('conceptover','Listado de conceptos');
  ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Conceptos</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
          <thead>
          <tr>
            <th>Módulo</th>
            <th>Tipo Transacción</th>
            <th>Nombre Concepto</th>
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
          <h3 class="card-title">Concepto <small> &nbsp; (*) Campos requeridos</small></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="form" name="form">
          <div class="card-body">
            <input type="hidden" id="idconcepto" name="idconcepto" value="" />
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="form-group">
                  <label for="modulo">Modulo</label>
                  <select class="custom-select" name="modulo" id="modulo">
                    <?php
                    $query = "select * from modulo";
                    foreach ($menu->conex->consultar($query) as $key => $value) {
                      echo '<option value="'.$value['id_modulo'].'">' . $value['nombre_modulo'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="form-group">
                  <label for="modulo">Tipo Concepto</label>
                  <select class="custom-select" name="tipoconceptotransaccion" id="tipoconceptotransaccion">
                    <?php
                    $query = "select * from tipoconceptotransaccion";
                    foreach ($menu->conex->consultar($query) as $key => $value) {
                      echo '<option value="'.$value['id_tipo_concepto_transaccion'].'">' . $value['nombre_tipo_concepto'] . ' ('.$value['signo_concepto'] .')</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Nombre Concepto (*)</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Concepto" />
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
          url: "../process/conceptoajax.php",
          data: {"accion":"read"}
        },
        columns: [
          {data:"nombre_modulo"},
          {data:"nombre_tipo_concepto"},
          {data:"nombre_concepto_transaccion"},
          {data:"descripcion"},
          {data:null, "defaultContent": "<button class='editar btn btn-primary' data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button> " +
              "<button class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar'><i class=\"far fa-trash-alt\"></i></button>" }
        ],
        responsive: true,
        language: idiomaDataTable,
        lengthChange: true,
        buttons: ['copy','excel','csv','pdf','colvis'],
        dom: 'Bfltip'
      });
    obtenerdatosDT(table);
      table.buttons().container().appendTo('#tablaDT_wrapper .col-md-6:eq(0)');
  }

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();
      var ideliminar = $('#idEliminar').val(data.id_concepto_transaccion);
      var idconcepto = $("#idconcepto").val(data.id_concepto_transaccion);
      var id_genero = $("#tipoconceptotransaccion option[value='"+ data.id_tipo_concepto_transaccion +"']").attr("selected",true);
      var id_genero = $("#modulo option[value='"+ data.id_modulo +"']").attr("selected",true);
      var nombre_concepto = $("#nombre").val(data.nombre_concepto_transaccion);
      var descripcion = $("#descripcion").val(data.descripcion);
    });
  }

  var eliminarRegistro = function() {
    $("#btnEliminar").click(function () {
      $.ajax({
          type: "POST",
          url: "../process/conceptoajax.php",
          data: {"accion":"delete", "idconcepto": $('#idEliminar').val()},
          success: function(data) {
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El concepto ha sido eliminado de manera correcta",
                "success"
              ).then(function() {
                window.location = "conceptoconsultarview.php";
              });
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al eliminar el concepto. " + data,
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
      var datos = $("#form").serialize() + "&accion=update";
        $.ajax({
              type: "POST",
              url: "../process/conceptoajax.php",
              data: datos,
              success: function(data){
                if(data == 'ok') {
                  Swal.fire(
                    "¡Éxito!",
                    "El concepto ha sido actualizado de manera correcta",
                    "success"
                  ).then(function() {
                    window.location = "conceptoconsultarview.php";
                  })
                } else {
                  Swal.fire(
                    "¡Error!",
                    "Ha ocurrido un error al actualizar el concepto. " + data,
                    "error"
                  );
                }
          },
        });
      }
    });
    $('#form').validate({
      rules: {
        nombre: {
          required: true
        },
        descripcion: {
          required: true
        }
      },
      messages: {
        nombre: {
          required: "Ingresa un nombre"
        },
        descripcion: {
          required: "Ingresa una descripción",
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
