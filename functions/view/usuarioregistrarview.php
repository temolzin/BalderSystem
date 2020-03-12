<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('usuarioreg','Registro de Usuario');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Usuario <small> &nbsp; (*) Campos requeridos</small></h3>
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
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {

    $.validator.setDefaults({
      submitHandler: function () {
        var form_data = new FormData();
        var imagen = $('#imagen').prop('files')[0];
        var tipousuario = document.getElementById('tipousuario');
        var nombre = document.getElementById('nombre');
        var apPat = document.getElementById('appat');
        var apMat = document.getElementById('apmat');
        var email = document.getElementById('email');
        var telefono = document.getElementById('telefono');
        var username = document.getElementById('nombreusuario');
        var password = document.getElementById('pass');


        form_data.append('imagen', imagen);
        form_data.append('idtipousuario', tipousuario.value);
        form_data.append('nombre', nombre.value);
        form_data.append('appat', apPat.value);
        form_data.append('apmat', apMat.value);
        form_data.append('email', email.value);
        form_data.append('telefono', telefono.value);
        form_data.append('nombreusuario', username.value);
        form_data.append('pass', password.value);
        form_data.append('accion', 'insert');

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
                "El usuario ha sido registrado de manera correcta",
                "success"
              ).then(function() {
                window.location = "usuarioregistrarview.php";
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al registrar el usuario. " + data,
                "error"
              );
            }
          },
        });
      }
    });
    $('#form').validate({
      rules: {
        imagen: {
          required: true
        },
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
          required: true,
          remote: {
            url: "../process/usuarioajax.php",
            type: "post",
            data: {
              username: function() {
                return $( "#nombreusuario" ).val();
              },
              accion: "validarUsername"
            }
          }
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
        imagen: {
          required: "Ingresa una imagen"
        },
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
          required: "Ingresa el nombre de usuario",
          remote: "<i class='fas fa-times'></i> Usuario no disponible"
        },
        pass: {
          required: "Ingresa una contraseña"
        },
        email: {
          required: "Ingresa email",
          email: "Ingresa una dirección de email correcta"
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
  });

</script>
<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
