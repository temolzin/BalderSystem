<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('clientereg','Registro de cliente');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cliente <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="form" name="form">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label>Imagen (*)</label>
                    <div class="custom-file">
                      <input type="file" accept="image/*" class="custom-file-input" name="imagen" id="imagen" lang="es">
                      <label class="custom-file-label" for="imagen">Selecciona Imagen</label>
                    </div>
                  </div>
                </div>
              </div>
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
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="genero">Género (*)</label>
                    <select class="custom-select" name="genero" id="genero">
                      <?php
                      $query = "select * from genero";
                      foreach ($menu->conex->consultar($query) as $key => $value) {
                        echo '<option value="'.$value['id_genero'].'">' . $value['nombre_genero'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-6 col-md-4">
                  <div class="form-group">
                    <label for="fechanacimiento">Fecha Nacimiento (*)</label>
                    <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-6 col-md-4">
                  <div class="form-group">
                    <label for="telefono">Estado Nacimiento (*)</label>
                    <select class="custom-select" name="estado" id="estado">
                      <?php
                      $query = "select distinct estado from postal";
                      foreach ($menu->conex->consultar($query) as $key => $value) {
                        echo '<option value="'.$value['estado'].'">' . $value['estado'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="rfc">RFC (*)</label>
                    <input type="text" name="rfc" id="rfc" class="form-control" placeholder="RFC">
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="telefono">CURP (*)</label>
                    <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="email">Email (*)</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono">
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-indigo">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="form-group">
                    <label>NSS</label>
                    <input type="text" class="form-control" id="nss" name="nss" placeholder="Número de Seguridad Social" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Alta IMSS</label>
                    <input type="date" class="form-control" id="altaimss" name="altaimss" placeholder="Alta IMSS" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Baja IMSS</label>
                    <input type="date" class="form-control" id="bajaimss" name="bajaimss" placeholder="Baja IMSS" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="email">Email (*)</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono">
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-indigo">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="form-group">
                    <label>NSS</label>
                    <input type="text" class="form-control" id="nss" name="nss" placeholder="Número de Seguridad Social" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Alta IMSS</label>
                    <input type="date" class="form-control" id="altaimss" name="altaimss" placeholder="Alta IMSS" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Baja IMSS</label>
                    <input type="date" class="form-control" id="bajaimss" name="bajaimss" placeholder="Baja IMSS" />
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-green">
              <div class="row">
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="email">Banco</label>
                    <select class="custom-select" name="banco" id="banco">
                      <option value="default">Selecciona</option>
                      <?php
                      $query = "select * from institucionbancaria";
                      foreach ($menu->conex->consultar($query) as $key => $value) {
                        echo '<option value="'.$value['id_institucion_bancaria'].'">' . $value['nombre_institucion_bancaria'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="clabe">Clabe</label>
                    <input type="text" id="clabe" name="clabe" class="form-control" placeholder="Clabe Interbancaria">
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-fuchsia">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="observacion">Observaciones</label>
                    <textarea type="text" id="observacion" name="observacion" class="form-control" placeholder="Observaciones"></textarea>
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
        var imagen = $('#imagenAuditor').prop('files')[0];
        var nombre = document.getElementById('nombre');
        var apPat = document.getElementById('apPat');
        var apMat = document.getElementById('apMat');
        var email = document.getElementById('email');
        var username = document.getElementById('username');
        var telefono = document.getElementById('telefono');
        var password = document.getElementById('password');

        form_data.append('imagen', imagen);
        form_data.append('username', username.value);
        form_data.append('nombre', nombre.value);
        form_data.append('apPat', apPat.value);
        form_data.append('apMat', apMat.value);
        form_data.append('email', email.value);
        form_data.append('telefono', telefono.value);
        form_data.append('password', password.value);
        $.ajax({
          type: "POST",
          url: "../process/clienteajax.php",
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(data){
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El cliente ha sido registrado de manera correcta",
                "success"
              ).then(function() {
                window.location = "registrarclienteview.php";
                limpiarCajas();
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al registrar el cliente. " + data,
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
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        clabe: {
          minlength: 18
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
        email: {
          required: "Ingresa email",
          email: "Ingresa una dirección de email correcta"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        clabe: {
          minlength: "La Clabe debe tener 18 dígitos"
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
