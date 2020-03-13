<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('pensionreg','Registro de Pensión');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pensión <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="formCliente" name="formCliente">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="idcliente">ID Cliente</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="ID Cliente" id="idcliente" name="idcliente" aria-label="ID Cliente">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="submit" id="btnBuscarCliente"><i class="fas fa-search"></i> Buscar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div id = "divcontainer" name="divcontainer" style="display: none">
            <form role="form" id="form" name="form">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- Profile Image -->
                    <div class="card card-blue card-outline" disabled="disabled">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img style="height: 100px;" class="profile-user-img img-fluid img-circle" src=""
                               alt="Foto del cliente" id="imagencliente" name="imagencliente">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" disabled class="form-control" id="nombrecliente" name="nombrecliente" value="" placeholder="Nombre Cliente" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Paterno</label>
                      <input type="text" disabled class="form-control" id="appat" name="appat" value="" placeholder="Apellido Paterno" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-4">
                    <div class="form-group">
                      <label>Apellido Materno</label>
                      <input type="text" disabled class="form-control" id="apmat" name="apmat" value="" placeholder="Apellido Materno" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="modulo">Concepto (*)</label>
                      <select class="form-control select2" name="conceptotransaccion" id="conceptotransaccion" style="width: 100%;">
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="modulo">Tipo Concepto</label>
                      <input type="text" disabled class="form-control" id="tipoconceptotransaccion" name="tipoconceptotransaccion" value="" placeholder="Tipo concepto" />
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                      <label for="modulo">Monto (*)</label>
                      <div class="form-group input-group">

                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                          </span>
                        </div>
                        <input type="number" onkeypress="return soloNumeros(this);"  maxlength="10" class="form-control" id="monto" name="monto">
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
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
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
    enviarFormularioIdcliente();
    llenarComboConcepto();
    consultarTipoConcepto();
  });

  var llenarComboConcepto = function () {
    $.ajax({
      type: "POST",
      url: "../process/conceptoajax.php",
      data: {'accion':'readbymodulo','idmodulo':'1'},
      success: function(data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          $('#conceptotransaccion').append("<option value='" + data[i]['id_concepto_transaccion'] + "'>"+ data[i]['nombre_concepto_transaccion'] +"</option>");
        });
        $.each(data, function (i, row) {
          $('#tipoconceptotransaccion').val(data[i]['nombre_tipo_concepto'] + "(" +data[i]['signo_concepto'] + ")" );
          return false;
        });
      }
    });
  }

  var enviarFormularioIdcliente = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var datos = $('#formCliente').serialize() + "&accion=readbyid";
        $.ajax({
          type: "POST",
          url: "../process/clienteajax.php",
          data: datos,
          success: function(data) {
            try {
              data = JSON.parse(data);
              $('#imagencliente').attr("src", "../../upload/images/client/" + data.imagen);
              $('#nombrecliente').val(data.nombre_cliente);
              $('#appat').val(data.ap_pat);
              $('#apmat').val(data.ap_mat);
              document.getElementById('divcontainer').style.display = 'block';
            } catch (e) {
              document.getElementById('divcontainer').style.display = 'none';
              Swal.fire(
                "¡Error!",
                "No se ha encontrado ese ID, favor de revisarlo. ",
                "error"
              );
            }
          }
        });
      }
    });
    $('#formCliente').validate({
      rules: {
        idcliente: {
          required: true
        }
      },
      messages: {
        idcliente: {
          required: "Ingresa un ID del cliente"
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

  var consultarTipoConcepto = function () {
    $('#conceptotransaccion').change(function () {
      $.ajax({
        type: "POST",
        url: "../process/conceptoajax.php",
        data: {'accion':'readbyidconcepto','idconceptotransaccion': $('#conceptotransaccion').val()},
        success: function(data) {
          data = JSON.parse(data);
          $('#tipoconceptotransaccion').val(data.nombre_tipo_concepto + "(" +data.signo_concepto + ")" );
        }
      });
    });
  }

  var enviarFormulario = function () {
    $.validator.setDefaults({
      submitHandler: function () {
        var datos = $('#form').serialize() + "&accion=insert";
        $.ajax({
          type: "POST",
          url: "../process/pensionajax.php",
          data: datos,
          success: function(data){
            if(data == 'ok') {
              Swal.fire(
                "¡Éxito!",
                "El registro de la pensión ha sido registrado de manera correcta",
                "success"
              ).then(function() {
                window.location = "pensionregistrarview.php";
              });
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al registrar el registro de la pensión. ",
                "error"
              );
            }
          },
        });
      }
    });
    $('#form').validate({
      rules: {
        monto: {
          required: true
        },
        descripcion: {
          required: true
        }
      },
      messages: {
        monto: {
          required: "Ingresa un monto"
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
