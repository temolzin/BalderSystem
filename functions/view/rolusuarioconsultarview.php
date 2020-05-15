<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('rolusuariover','Listado de Rol de Usuarios');
  ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rol Usuarios</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
          <thead>
          <tr>
            <th>ID</th>
            <th>Nombre del rol</th>
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
          <h3 class="card-title">Rol de usuario <small> &nbsp; (*) Campos requeridos</small></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="formPriv" name="formPriv">
          <div class="card-body">
            <input type="hidden" id="idtipousuario" name="idtipousuario" value="" />
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Nombre del Rol (*)</label>
                  <input type="text" class="form-control" id="nombrerol" name="nombrerol" placeholder="Nombre del Rol" />
                </div>
              </div>
              <div class="col-12 col-sm-12">
                <div id="check" name="check">

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
      // enviarFormulario();
      // eliminarRegistro();
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
            url: "../process/tipousuarioajax.php",
            data: {"accion":"read"}
          },
          columns: [
            {data:"id_tipo_usuario"},
            {data:"nombre_tipo_usuario"},
            {data:null, "defaultContent": "<button class='editar btn btn-primary' <?php echo $menu->privilegioTipoUsuarioEditar?> data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button> " +
                "<button class='eliminar btn btn-danger' data-toggle='modal' style='display: none;' data-target='#modalEliminar'><i class=\"far fa-trash-alt\"></i></button>" }
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
         var nombrerol = $('#nombrerol').val(data.nombre_tipo_usuario);
         var idtipousuario = $('#idtipousuario').val(data.id_tipo_usuario);
        mostrarchecks(data.id_tipo_usuario);
      //   var iddocumento = $("#iddocumento").val(data.id_documento);
      //   var nombre_documento = $("#nombre").val(data.nombre_documento);
      //   var descripcion = $("#descripcion").val(data.descripcion);
       });
    }

    var eliminarRegistro = function() {
      $("#btnEliminar").click(function () {
        $.ajax({
            type: "POST",
            url: "../process/tipousuarioajax.php",
            data: {"accion":"delete", "iddocumento": $('#idEliminar').val()},
            success: function(data) {
              if(data == 'ok') {
                Swal.fire(
                  "¡Éxito!",
                  "El Rol de Usuario ha sido eliminado de manera correcta",
                  "success"
                ).then(function() {
                  window.location = "rolusuarioconsultarview.php";
                });
              } else {
                Swal.fire(
                  "¡Error!",
                  "Ha ocurrido un error al eliminar el documento. " + data,
                  "error"
                );
              }
            }
        });
      });
    }

    var mostrarchecks = function (idtipousuario) {
        var cadena = "";
        //Ajax para consultar los módulos generales de la base de datos
        $.ajax({
          type: "POST",
          async: false,
          url: "../process/tipousuarioajax.php",
          data: {"accion" : "readmoduloprivilegio"},
          success: function(data){
            data = JSON.parse(data);
            $.each(data, function (i, row) {
              var checkPrivilegio = "";
              //AJAX para consultar los privilegios del usuario insertados en la base de datos
              $.ajax({
                type: "POST",
                async: false,
                url: "../process/tipousuarioajax.php",
                data: {"accion" : "readprivilegiobyidtipousuario", "idtipousuario" : idtipousuario},
                success: function(data){
                  data = JSON.parse(data);
                  $.each(data, function (i, rowC) {
                    //Se evalua si el privilegio general está registrado en el cliente, si el cliente tiene ese privilegio se activa el check
                    if(rowC.id_modulo_privilegio_usuario == row.id_modulo_privilegio_usuario) {
                      checkPrivilegio = "checked";
                    }
                    if(row.nombre_modulo_privilegio == "Inicio") {
                      checkPrivilegio = "checked";
                    }
                  });
                }
              });
              cadena += '<div class="form-group clearfix" data-toggle="collapse" href="#divp'+row.id_modulo_privilegio_usuario+'" id="div'+row.id_modulo_privilegio_usuario+'" role="button" aria-expanded="false">\n' +
                '                    <div class="icheck-primary">\n' +
                '                      <input type="checkbox" ' + checkPrivilegio +' name="mod'+row.id_modulo_privilegio_usuario +'" id="mod'+row.id_modulo_privilegio_usuario +'">\n' +
                '                      <label for="mod' + row.id_modulo_privilegio_usuario +'">\n' +
                                          row.nombre_modulo_privilegio +
                '                      </label>\n' +
                '                    </div>\n' +
                '                  </div>';
              //***************** Ajax para consultar los submodulos de cada privilegio *********************
              cadena += '<div class="collapse" id="divp'+row.id_modulo_privilegio_usuario+'">';
              $.ajax({
                type: "POST",
                async:false,
                url: "../process/tipousuarioajax.php",
                data: {"accion" : "readbyidmoduloprivilegio", "idmoduloprivilegio":row.id_modulo_privilegio_usuario},
                // data: $('#formRol').serialize(),
                success: function(data){
                  data = JSON.parse(data);
                  $.each(data, function (i, rowP) {
                    var checkPrivilegio = "";
                    //AJAX para consultar los privilegios del usuario insertados en la base de datos
                    $.ajax({
                      type: "POST",
                      async: false,
                      url: "../process/tipousuarioajax.php",
                      data: {"accion" : "readprivilegiobyidtipousuario", "idtipousuario" : idtipousuario},
                      success: function(data){
                        data = JSON.parse(data);
                        $.each(data, function (i, rowC) {
                          //Se evalua si el privilegio general está registrado en el cliente, si el cliente tiene ese privilegio se activa el check
                          if(rowC.id_privilegio_usuario == rowP.id_privilegio_usuario) {
                            checkPrivilegio = "checked";
                          }
                        });
                      }
                    });
                    cadena += '<div class="form-group clearfix">\n' +
                      '                    <div class="icheck-primary">\n' +
                      '                      &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" class="chbPriv" name="priv' + rowP.id_privilegio_usuario + '" '+checkPrivilegio+' id="priv' + rowP.id_privilegio_usuario + '">\n' +
                      '                      <label for="priv' + rowP.id_privilegio_usuario + '">\n' +
                      rowP.nombre_privilegio +
                      '                      </label>\n' +
                      '                    </div>\n' +
                      '                  </div>';
                  });
                },
              });
              cadena += '</div>';
              //Se muestran los checks en el DIV con id check
              $('#check').html(cadena);
              enviarFormulario();
            });
          },
        });
      }

      var enviarFormulario = function() {
        $.validator.setDefaults({
          submitHandler: function () {
            var datos = $("#formPriv").serialize() + "&accion=updatetipousuarioprivilegio";
            $.ajax({
              type: "POST",
              url: "../process/tipousuarioajax.php",
              data: datos,
              success: function (data) {
                console.log(data);
                if(data == 'error') {
                  Swal.fire(
                    "¡Error!",
                    "Ha ocurrido un error al registrar el cliente. " + data,
                    "error"
                  );
                } else {
                  Swal.fire(
                    "¡Éxito!",
                    "El Rol de Usuario ha sido registrado de manera correcta",
                    "success"
                  ).then(function() {
                    window.location = "rolusuarioconsultarview.php";
                  })
                }
              },
            });
          }
        });
        $('#formPriv').validate({
          rules: {
            nombrerol: {
              required: true
            }
          },
          messages: {
            nombrerol: {
              required: "Ingresa un nombre"
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
    </script>
