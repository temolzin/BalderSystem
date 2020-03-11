<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('documentoreg','Registro de Documento');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Documento <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="form" name="form">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label>Nombre Documento (*)</label>
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
          url: "../process/documentoajax.php",
          data: datos,
          success: function(data){
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El documento ha sido registrado de manera correcta",
                "success"
              ).then(function() {
                window.location = "documentoregistrarview.php";
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al registrar el documento. " + data,
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
          required: "Ingresa un nombre de documento"
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
