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
            <tbody>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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
    var table = $('#tablaDT').DataTable({
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
        {defaultContent: "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button>" +
            "<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
      ],
      responsive: true,
      language: idiomaDataTable
    });
  }

</script>
