<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('clientever','Listado de clientes');
  ?>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a href="../process/logout.php" class="btn btn-danger">Eliminar</a>
        </div>
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
                  <div class="col-12 col-sm-12">
                    <label>Foto del cliente</label>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <button class="btn btn-warning" style="z-index: 0;" id="btnSubirImagen" name="btnSubirImagen">Subir</button>
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
                      <input type="text" class="form-control" id="id" name="id" placeholder="ID" disabled />
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
                      <input type="text" name="rfc" id="rfc" class="form-control" placeholder="RFC" value="">
                    </div>
                  </div>
                  <div class="col-6 col-md-6">
                    <div class="form-group">
                      <label for="telefono">CURP (*)</label>
                      <input type="text" id="curp" name="curp" class="form-control" placeholder="CURP" value="">
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
                      <input type="text" class="form-control" id="nss" name="nss" placeholder="Número de Seguridad Social" value="" />
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
                      <label>Calle</label>
                      <input type="text" class="form-control" id="calle" name="calle" placeholder="Número de Seguridad Social" value="" />
                    </div>
                  </div>
                  <div class="col-6 col-sm-3">
                    <div class="form-group">
                      <label>No. Exterior</label>
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
                      <label>Código postal </label>
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
                      <label>Colonia</label>
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
        {data:null, "defaultContent": "<button class='editar btn btn-primary'  data-toggle='modal' data-target='#modalActualizar'><i class=\"fa fa-edit\"></i></button>	" +
            "<button class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class=\"far fa-trash-alt\"></i></button>"}
      ],
      responsive: true,
      language: idiomaDataTable
    });
    obtenerdatosDT(table);
  }

  var obtenerdatosDT = function (table) {
    $('#tablaDT tbody').on('click', '.editar', function() {
      var data = table.row(this).data();
      // var id = $("idActualizar").val(data.id_cliente);

    });
  }

</script>
