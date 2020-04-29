<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('rolusuarioreg','Registro de Rol de Usuario');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Rol de usuario <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formPriv" name="formPriv">
            <div class="card-body">
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
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {
    mostrarchecks();
  });

  var mostrarchecks = function () {
    var cadena = "";
    $.ajax({
      type: "POST",
      async: false,
      url: "../process/tipousuarioajax.php",
      data: {"accion" : "readmoduloprivilegio"},
      // data: $('#formRol').serialize(),
      success: function(data){
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          cadena += '<div class="form-group clearfix" data-toggle="collapse" href="#divp'+row.id_modulo_privilegio_usuario+'" id="div'+row.id_modulo_privilegio_usuario+'" role="button" aria-expanded="false">\n' +
            '                    <div class="icheck-primary">\n' +
            '                      <input type="checkbox" checked name="mod'+row.id_modulo_privilegio_usuario +'" id="mod'+row.id_modulo_privilegio_usuario +'">\n' +
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
                cadena += '<div class="form-group clearfix">\n' +
                  '                    <div class="icheck-primary">\n' +
                  '                      &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" class="chbPriv" name="priv' + rowP.id_privilegio_usuario + '" checked id="priv' + rowP.id_privilegio_usuario + '">\n' +
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
        var datos = $("#formPriv").serialize() + "&accion=inserttipousuarioprivilegio";
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
                window.location = "rolusuarioregistrarview.php";
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
