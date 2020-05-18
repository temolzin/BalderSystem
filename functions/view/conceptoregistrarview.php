<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('conceptoreg','Registro de Concepto');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Concepto <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="form" name="form">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="modulo">Modulo</label>
                    <select class="custom-select" name="modulo" id="modulo">
                      <?php

                      //*********************Se verifica que privilegios de módulo o modulos cuenta el usuario para hacer la consulta************************
                      $query = "";
                      if ($menu->privilegioModuloPrestamo == true && $menu->privilegioModuloPension == true) {
                        $query = "select * from modulo";
                      } else if ($menu->privilegioModuloPrestamo == false && $menu->privilegioModuloPension == true) {
                        $query = "select * from modulo where id_modulo = 1";
                      } else if ($menu->privilegioModuloPrestamo == true && $menu->privilegioModuloPension == false) {
                        $query = "select * from modulo where id_modulo = 2";
                      }

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
                      <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre Documento" />
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
<script>
  $(document).ready(function () {
    enviarFormulario();
  });
  var enviarFormulario = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var datos = $('#form').serialize() + "&accion=insert";
        $.ajax({
          type: "POST",
          url: "../process/conceptoajax.php",
          data: datos,
          success: function(data){
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El concepto ha sido registrado de manera correcta",
                "success"
              ).then(function() {
                window.location = "conceptoregistrarview.php";
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al registrar el concepto. " + data,
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
          required: "Ingresa un nombre de concepto"
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
</script>
