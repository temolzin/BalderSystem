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
                    <label>Foto del cliente (*)</label>
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
                    <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control" value="" placeholder="Email">
                  </div>
                </div>
                <div class="col-6 col-md-4">
                  <div class="form-group">
                    <label for="telefono">Estado Nacimiento (*)</label>
                    <select class="custom-select" name="estadonacimiento" id="estadonacimiento">
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
                    <input type="text" name="rfc" id="rfc" class="form-control" maxlength="13" placeholder="RFC" value="">
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="telefono">CURP (*)</label>
                    <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP" maxlength="18" value="">
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
              <hr class="bg-gradient-indigo">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="form-group">
                    <label>NSS</label>
                    <input type="text" class="form-control" id="nss" name="nss" placeholder="Número de Seguridad Social" value="" maxlength="11" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Alta IMSS</label>
                    <input type="date" class="form-control" id="altaimss" name="altaimss" placeholder="Alta IMSS" value="" />
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="form-group">
                    <label>Baja IMSS</label>
                    <input type="date" class="form-control" id="bajaimss" name="bajaimss" placeholder="Baja IMSS" value="" />
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-cyan">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Calle (*)</label>
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" value="" />
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="form-group">
                    <label>No. Exterior</label>
                    <input type="text" value="" class="form-control" id="noexterior" name="noexterior" placeholder="No. Exterior" />
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="form-group">
                    <label>No. Interior</label>
                    <input type="text" value="" class="form-control" id="nointerior" name="nointerior" placeholder="No. Interior" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-sm-3">
                  <div class="form-group">
                    <label>Código postal (*) </label>
                    <input type="text" id="codigopostal" name="codigopostal" onkeypress="return soloNumeros(this);" maxlength="5" class="form-control" placeholder="Código Postal" />
                  </div>
                </div>
                <div class="col-3 col-sm-3">
                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control" id="estadocodigopostal" name="estadocodigopostal" placeholder="Estado" disabled/>
                  </div>
                </div>
                <div class="col-3 col-sm-3">
                  <div class="form-group">
                    <label>Municipio</label>
                    <input type="text" value="" class="form-control" id="municipiocodigopostal" name="municipiocodigopostal" placeholder="Municipio" disabled/>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="form-group">
                    <label>Colonia (*)</label>
                    <select class="custom-select" disabled id="colonia" name="colonia"></select>
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-green">
              <div class="row">
                <div class="col-6 col-md-6">
                  <div class="form-group">
                    <label for="banco">Banco</label>
                    <select class="custom-select" name="banco" id="banco">
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
                    <input type="text" id="clabe" name="clabe" value="" class="form-control" placeholder="Clabe Interbancaria">
                  </div>
                </div>
              </div>
              <hr class="bg-gradient-fuchsia">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="observacion">Observaciones</label>
                    <textarea type="text" id="observacion" name="observacion" value="" class="form-control" placeholder="Observaciones"></textarea>
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

    direccionbycodigopostal();

    $.validator.setDefaults({
      submitHandler: function () {
        var form_data = new FormData();
        var imagen = $('#imagen').prop('files')[0];
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

        form_data.append('imagen', imagen);
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
        form_data.append('accion', 'insert');

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
                window.location = "clienteregistrarview.php";
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
        rfc: {
          required: true,
          minlength: 13
        },
        curp: {
          required: true,
          minlength: 18
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
        nss: {
          minlength: 11
        },
        calle: {
          required: true
        },
        // noexterior: {
        //   required: true
        // },
        codigopostal: {
          required: true
        },
        colonia: {
          required: true
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
        rfc: {
          required: "Ingresa RFC",
          minlength: "El RFC debe contener 13 carácteres"
        },
        curp: {
          required: "Ingresa CURP",
          minlength: "La CURP debe contener 18 carácteres"
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
        clabe: {
          minlength: "El NSS debe contener 11 dígitos"
        },
        calle: {
          required: "Ingresa la calle del domicilio",
        },
        // noexterior: {
        //   required: "Ingresa el número exterior",
        // },
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
  });

  var direccionbycodigopostal = function () {
    $("#codigopostal").on("keydown keypress keyup",function (e) {
      if(e.which == 9 || e.which == 13) {
        $('#colonia').html("");
        $.ajax({
          type: "POST",
          url: "../process/codigopostalajax.php",
          data: {
            codigopostal: document.getElementById("codigopostal").value,
            accion: "readByCodigoPostal"
          }
        }).done(function (data) {
          try {
            data = JSON.parse(data);
          } catch (e) {
            Swal.fire(
              "¡Error!", "No se encuentra el código postal", "error"
            );
          }
          $('#estadocodigopostal').val(data[0].estado);
          $('#municipiocodigopostal').val(data[0].municipio);

          $('#colonia').prop('disabled', false);
          $.each(data, function (i, row) {
            $('#colonia').append("<option value='" + data[i].id + "' >" + data[i]['colonia'] + "</option>");
          });
        });
      }
    });
  }

</script>
<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
