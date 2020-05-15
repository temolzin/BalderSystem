<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('usuariover','Listado de usuarios');
  ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
            <thead>
            <tr>
              <th>Username</th>
              <th>Tipo Usuario</th>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Email</th>
              <th>Teléfono</th>
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
              <h3 class="card-title">Usuario <small> &nbsp; (*) Campos requeridos</small></h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="form" name="form">
              <input type="hidden" id="idActualizar" name="idActualizar"/>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- Profile Image -->
                    <div class="card card-warning card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img style="height: 100px;" class="profile-user-img img-fluid img-circle" src=""
                               alt="User profile picture" id="imagenperfil" name="imagenperfil">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <label>Foto del usuario</label>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <button class="btn btn-warning" style="z-index: 0;" id="btnSubirImagen" type="button" name="btnSubirImagen">Subir</button>
                      </div>
                      <div class="custom-file">
                        <input type="file" accept="image/*" class="custom-file-input" name="imagen" id="imagen" lang="es">
                        <label class="custom-file-label" for="imagen">Selecciona Imagen</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="bg-gradient-orange">
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="tipousuario">Tipo Usuario (*)</label>
                      <select class="custom-select" name="tipousuario" id="tipousuario">
                        <?php
                        $query = "select * from tipousuario";
                        foreach ($menu->conex->consultar($query) as $key => $value) {
                          echo '<option value="'.$value['id_tipo_usuario'].'">' . $value['nombre_tipo_usuario'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="username">Nombre de usuario (*)</label>
                      <input type="text" class="form-control" id="nombreusuario" name="nombreusuario" placeholder="Nombre de Usuario" />
                    </div>
                  </div>
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="genero">Contraseña (*)</label>
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" />
                    </div>
                  </div>
                </div>
                <hr class="bg-gradient-orange">
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="form-group">
                      <label>Nombre (*)</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Paterno (*)</label>
                      <input type="text" class="form-control" id="appat" name="appat" placeholder="Apellido Paterno" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Materno (*)</label>
                      <input type="text" class="form-control" id="apmat" name="apmat" placeholder="Apellido Materno" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="email">Email (*)</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="telefono">Teléfono</label>
                      <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" value="" onkeypress="return soloNumeros(this);" maxlength="10">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
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
    subirImagen();
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
        url: "../process/usuarioajax.php",
        data: {"accion":"read"},
      },
      columns: [
        {data:"username"},
        {data:"nombre_tipo_usuario"},
        {data:"nombre"},
        {data:"ap_pat"},
        {data:"ap_mat"},
        {data:"email"},
        {data:"telefono"},
        {data:null, "defaultContent": "<button class='editar btn btn-primary' <?php echo $menu->privilegioUsuarioEditar?> data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button>	" +
            "<button class='eliminar btn btn-danger' data-toggle='modal' <?php echo $menu->privilegioUsuarioEliminar?> data-target='#modalEliminar'><i class=\"far fa-trash-alt\"></i></button>" }
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
      if(typeof data.imagen == "undefined") {
        data.imagen = "sinimagen.jpg";
      }
      var idusuarioEliminar = $('#idEliminar').val(data.id_usuario);
      $('#imagenperfil').attr("src","../../upload/images/user/"+data.imagen);
      var id_usuario = $("#idActualizar").val(data.id_usuario);
      var idtipousuario= $("#tipousuario option[value='"+ data.id_tipo_usuario +"']").attr("selected",true);
      var nombre = $("#nombre").val(data.nombre);
      var appat = $("#appat").val(data.ap_pat);
      var apmat = $("#apmat").val(data.ap_mat);
      var username = $("#nombreusuario").val(data.username);
      var pass = $("#pass").val(data.password);
      var email = $("#email").val(data.email);
      var telefono = $("#telefono").val(data.telefono);
    });
  }

  //PARA SUBIR SOLAMENTE LA IMAGEN
  var subirImagen = function() {
    $('#btnSubirImagen').on("click", subirImagen);
    function subirImagen() {
      var imagen = document.getElementById('imagen');
      if(imagen.value == "") {
        Swal.fire(
          "¡Cuidado!",
          "Debes seleccionar una imagen para actualizar",
          "warning"
        );
      } else {
        var form_data = new FormData();
        var idUsuario = document.getElementById('idActualizar');
        var imagen = $('#imagen').prop('files')[0];
        form_data.append('idusuario', idUsuario.value);
        form_data.append('imagen', imagen);
        form_data.append('accion','actualizarImagen');
        $.ajax({
          type: "POST",
          url: "../process/usuarioajax.php",
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(data) {
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "La imagen fue actualizada correctamente",
                "success"
              ).then(function() {
                window.location = "usuarioconsultarview.php";
              });
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al actualizar la imagen: " + data,
                "error"
              )
            }
          }
        });
      }
    }
  }

  var eliminarRegistro = function() {
    $("#btnEliminar").click(function () {
      $.ajax({
        type: "POST",
        url: "../process/usuarioajax.php",
        data: {"accion":"delete", "idusuario": $('#idEliminar').val()},
        success: function(data) {
          if(data == 'ok') {
            Swal.fire(
              "¡Éxito!",
              "El usuario ha sido eliminado de manera correcta",
              "success"
            ).then(function() {
              window.location = "usuarioconsultarview.php";
            });
          } else {
            Swal.fire(
              "¡Error!",
              "Ha ocurrido un error al eliminar el usuario. " + data,
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
        var form_data = new FormData();
        var idtipousuario = document.getElementById('tipousuario');
        var nombre = document.getElementById('nombre');
        var apPat = document.getElementById('appat');
        var apMat = document.getElementById('apmat');
        var email = document.getElementById('email');
        var telefono = document.getElementById('telefono');
        var username = document.getElementById('nombreusuario');
        var password = document.getElementById('pass');
        var idusuario = document.getElementById('idActualizar');

        form_data.append('idtipousuario', idtipousuario.value);
        form_data.append('nombre', nombre.value);
        form_data.append('appat', apPat.value);
        form_data.append('apmat', apMat.value);
        form_data.append('email', email.value);
        form_data.append('telefono', telefono.value);
        form_data.append('idusuario', idusuario.value);
        form_data.append('nombreusuario', username.value);
        form_data.append('pass', password.value);
        form_data.append('accion', 'update');

        $.ajax({
          type: "POST",
          url: "../process/usuarioajax.php",
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(data){
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El usuario ha sido actualizado de manera correcta",
                "success"
              ).then(function() {
                window.location = "usuarioconsultarview.php";
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al actualizar el usuario. " + data,
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
        appat: {
          required: true
        },
        apmat: {
          required: true
        },
        nombreusuario: {
          required: true
        },
        pass: {
          required: true
        },
        email: {
          required: true,
          email: true,
        }
      },
      messages: {
        nombre: {
          required: "Ingresa un nombre"
        },
        appat: {
          required: "Ingresa apellido paterno"
        },
        apmat: {
          required: "Ingresa apellido materno"
        },
        nombreusuario: {
          required: "Ingresa un nombre de usuario"
        },
        email: {
          required: "Ingresa email",
          email: "Ingresa una dirección de email correcta"
        },
        pass: {
          required: "Ingresa una contraseña",
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
