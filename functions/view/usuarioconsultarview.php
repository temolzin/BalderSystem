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
    <div class="modal-dialog modal-lg" role="document">
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
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="form-group">
                      <label>Foto del usuario (*)</label>
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
                      <label for="username">Username (*)</label>
                      <input type="text" class="form-control" id="nombreusuario" name="nombreusuario" placeholder="Nombre de Usuario" />
                    </div>
                  </div>
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="genero">Password (*)</label>
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
                      <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono" value="">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Registrar</button>
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
        {data:null, "defaultContent": "<button class='editar btn btn-primary'  data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button>	" +
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
    $('#tablaDT tbody').on('click', '.eliminar', function() {
      var data = table.row(this).data();
      var idusuario = $('#idEliminar').val(data.id_usuario);
    });
    $('#tablaDT tbody').on('click', '.editar', function() {
      var data = table.row(this).data();
      if(data.imagen == null) {
        data.imagen = "sinimagen.jpg";
      }
      var idpostal = direccionbyidpostal(data.id_postal);
      $('#imagenperfil').attr("src","../../upload/images/client/"+data.imagen);
      var id_usuario = $("#idActualizar").val(data.id_usuario);
      var id_institucion_interbancaria = $("#banco option[value='"+ data.id_institucion_interbancaria +"']").attr("selected",true);
      var id_genero = $("#genero option[value='"+ data.id_genero +"']").attr("selected",true);
      var nombre_usuario = $("#nombre").val(data.nombre_usuario);
      var appat = $("#appat").val(data.ap_pat);
      var apmat = $("#apmat").val(data.ap_mat);
      var rfc = $("#rfc").val(data.rfc);
      var curp = $("#curp").val(data.curp);
      var fecha_nacimiento = $("#fechanacimiento").val(data.fecha_nacimiento);
      var estado_nacimiento = $("#estadonacimiento").val(data.estado_nacimiento);
      var email = $("#email").val(data.email);
      var telefono = $("#telefono").val(data.telefono);
      var calle = $("#calle").val(data.calle);
      var noexterior = $("#noexterior").val(data.noexterior);
      var nointerior = $("#nointerior").val(data.nointerior);
      var nss = $("#nss").val(data.nss);
      var altaimss = $("#altaimss").val(data.alta_imss);
      var bajaimss = $("#bajaimss").val(data.baja_imss);
      var clabe = $("#clabe").val(data.clabe_interbancaria);
      var observacion = $("#observacion").val(data.observacion);
      var activo = $("#activo").val(data.activo);

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
        var idCliente = document.getElementById('idActualizar');
        var imagen = $('#imagen').prop('files')[0];
        form_data.append('idusuario', idCliente.value);
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
        var idpostal = document.getElementById('colonia');
        var idbanco = document.getElementById('banco');
        var idgenero = document.getElementById('genero');
        var nombre = document.getElementById('nombre');
        var apPat = document.getElementById('appat');
        var apMat = document.getElementById('apmat');
        var rfc = document.getElementById('rfc');
        var curp = document.getElementById('curp');
        var fechanacimiento = document.getElementById('fechanacimiento');
        var estadonacimiento = document.getElementById('estadonacimiento');
        var clabe = document.getElementById('clabe');
        var email = document.getElementById('email');
        var telefono = document.getElementById('telefono');
        var calle = document.getElementById('calle');
        var noexterior = document.getElementById('noexterior');
        var nointerior = document.getElementById('nointerior');
        var nss = document.getElementById('nss');
        var altaimss = document.getElementById('altaimss');
        var bajaimss = document.getElementById('bajaimss');
        var observacion = document.getElementById('observacion');
        var idusuario = document.getElementById('idActualizar');

        form_data.append('idpostal', idpostal.value);
        form_data.append('idbanco', idbanco.value);
        form_data.append('idgenero', idgenero.value);
        form_data.append('nombre', nombre.value);
        form_data.append('appat', apPat.value);
        form_data.append('apmat', apMat.value);
        form_data.append('rfc', rfc.value);
        form_data.append('curp', curp.value);
        form_data.append('fechanacimiento', fechanacimiento.value);
        form_data.append('estadonacimiento', estadonacimiento.value);
        form_data.append('clabe', clabe.value);
        form_data.append('email', email.value);
        form_data.append('telefono', telefono.value);
        form_data.append('calle', calle.value);
        form_data.append('noexterior', noexterior.value);
        form_data.append('nointerior', nointerior.value);
        form_data.append('nss', nss.value);
        form_data.append('altaimss', altaimss.value);
        form_data.append('bajaimss', bajaimss.value);
        form_data.append('observacion', observacion.value);
        form_data.append('idusuario', idusuario.value);
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
        rfc: {
          required: true
        },
        curp: {
          required: true
        },
        fechanacimiento: {
          required: true
        },
        email: {
          required: true,
          email: true,
        },
        clabe: {
          minlength: 18
        },
        calle: {
          required: true
        },
        noexterior: {
          required: true
        },
        codigopostal: {
          required: true
        },
        colonia: {
          required: true
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
        rfc: {
          required: "Ingresa RFC"
        },
        curp: {
          required: "Ingresa CURP"
        },
        fechanacimiento: {
          required: "Ingresa Fecha de Nacimiento"
        },
        email: {
          required: "Ingresa email",
          email: "Ingresa una dirección de email correcta"
        },
        clabe: {
          minlength: "La Clabe debe tener 18 dígitos"
        },
        calle: {
          required: "Ingresa la calle del domicilio",
        },
        noexterior: {
          required: "Ingresa el número exterior",
        },
        codigopostal: {
          required: "Ingresa un número postal",
        },
        colonia: {
          required: "Selecciona una colonia",
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
