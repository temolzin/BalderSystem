<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('clientever','Listado de clientes');
  ?>
<div id="contenedor" name="contenedor">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Clientes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tablaDT" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>RFC</th>
              <th>CURP</th>
              <th>Fecha Nacimiento</th>
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
              <h3 class="card-title">Cliente <small> &nbsp; (*) Campos requeridos</small></h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="form" name="form">
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
                    <label>Foto del cliente</label>
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
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" class="form-control" id="idActualizar" name="idActualizar" placeholder="ID" disabled />
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
                      <input type="text" name="rfc" id="rfc" class="form-control" placeholder="RFC" value="" maxlength="13">
                    </div>
                  </div>
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="telefono">CURP (*)</label>
                      <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP" value="" maxlength="18">
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
                      <input type="text" class="form-control" id="nss" name="nss" placeholder="Número de Seguridad Social" value="" maxlength="11"/>
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
                      <input type="text" class="form-control" id="calle" name="calle" placeholder="Número de Seguridad Social" value="" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-3">
                    <div class="form-group">
                      <label>No. Exterior (*)</label>
                      <input type="number" value="" class="form-control" id="noexterior" name="noexterior" placeholder="No. Exterior" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-3">
                    <div class="form-group">
                      <label>No. Interior</label>
                      <input type="number" value="" class="form-control" id="nointerior" name="nointerior" placeholder="No. Interior" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-sm-3">
                    <div class="form-group">
                      <label>Código postal (*)</label>
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
                      <input type="text" id="clabe" name="clabe" value="" maxlength="18" class="form-control" placeholder="Clabe Interbancaria">
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
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar</button>
              </div>
            </form>
      </div>
    </div>
    </div>
  </div>
</div>
<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {
    mostrarRegistros();
    enviarFormulario();
    direccionbycodigopostal();
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
        url: "../process/clienteajax.php",
        data: {"accion":"read"}
      },
      columns: [
        {data:"id_cliente"},
        {data:"nombre_cliente"},
        {data:"ap_pat"},
        {data:"ap_mat"},
        {data:"rfc"},
        {data:"curp"},
        {data:"fecha_nacimiento"},
        {data:null, "defaultContent": "<button class='consultar btn btn-info'><i class=\"fas fa-search\"></i></button> " +
            "<button class='editar btn btn-primary'  data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button>	" +
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

  /*var enviarDatosPerfilCliente = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();

      var id_cliente = $("#idActualizar").val(data.id_cliente);
      var id_institucion_interbancaria = $("#banco option[value='"+ data.id_institucion_interbancaria +"']").attr("selected",true);
      var id_genero = $("#genero option[value='"+ data.id_genero +"']").attr("selected",true);
      var nombre_cliente = $("#nombre").val(data.nombre_cliente);
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
  }*/

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', 'tr', function() {
      var data = table.row(this).data();
      console.log(data);
      $(".consultar").on('click', function () {
        $.post( "clienteperfilview.php", data,function( data ) {
          $('#contenedor').html(data);
          $('#titulomenu').html('<h1>Perfil Cliente</h1>');
        });
      });

      if(typeof data.imagen == "undefined") {
        data.imagen = "sinimagen.jpg";
      }
      var idclienteEliminar = $('#idEliminar').val(data.id_cliente);
      var idpostal = direccionbyidpostal(data.id_postal);
      $('#imagenperfil').attr("src","../../upload/images/client/"+data.imagen);
      var id_cliente = $("#idActualizar").val(data.id_cliente);
      var id_institucion_interbancaria = $("#banco option[value='"+ data.id_institucion_interbancaria +"']").attr("selected",true);
      var id_genero = $("#genero option[value='"+ data.id_genero +"']").attr("selected",true);
      var nombre_cliente = $("#nombre").val(data.nombre_cliente);
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
        form_data.append('idcliente', idCliente.value);
        form_data.append('imagen', imagen);
        form_data.append('accion','actualizarImagen');
        $.ajax({
          type: "POST",
          url: "../process/clienteajax.php",
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
                window.location = "clienteconsultarview.php";
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
        url: "../process/clienteajax.php",
        data: {"accion":"delete", "idcliente": $('#idEliminar').val()},
        success: function(data) {
          if(data == 'ok') {
            Swal.fire(
              "¡Éxito!",
              "El cliente ha sido eliminado de manera correcta",
              "success"
            ).then(function() {
              window.location = "clienteconsultarview.php";
            });
          } else {
            Swal.fire(
              "¡Error!",
              "Ha ocurrido un error al eliminar el cliente. " + data,
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
        var idcliente = document.getElementById('idActualizar');

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
        form_data.append('idcliente', idcliente.value);
        form_data.append('accion', 'update');

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
                "El cliente ha sido actualizado de manera correcta",
                "success"
              ).then(function() {
                window.location = "clienteconsultarview.php";
              })
            } else {
              Swal.fire(
                "¡Error!",
                "Ha ocurrido un error al actualizar el cliente. " + data,
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
        nss: {
          minlength: "El NSS debe tener 11 dígitos"
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

  var direccionbyidpostal = function (idpostal) {
        $('#colonia').html("");
        $.ajax({
          type: "POST",
          url: "../process/codigopostalajax.php",
          data: {
            idpostal: idpostal,
            accion: "readByIdPostal"
          }
        }).done(function (data) {
          try {
            data = JSON.parse(data);
          } catch (e) {
            Swal.fire(
              "¡Error!", "No se encuentra el código postal", "error"
            );
          }
          $('#codigopostal').val(data[0].codigo);
          $('#estadocodigopostal').val(data[0].estado);
          $('#municipiocodigopostal').val(data[0].municipio);

          $('#colonia').prop('disabled', false);
          $.each(data, function (i, row) {
            $('#colonia').append("<option value='" + data[i].id + "' >" + data[i]['colonia'] + "</option>");
          });
        });
  }

  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

</script>
