<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header("inicio", 'Inicio');
?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <canvas id="graficaBarrasCargoAbono"></canvas>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Últimas transacciones</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                    <th>Tipo</th>
                  </tr>
                  </thead>
                  <tbody id="cuerpoTablaTransaccion">

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="pensionconsultarview.php">Ver todas las transacciones</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <canvas id="migrafica"></canvas>
            </div>
          <!-- /.card -->

          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Últimos Clientes</h3>

                  <div class="card-tools">
                    <span class="badge badge-danger" id="labelNuevosClientes"></span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="users-list clearfix" id="listaClientesNuevos">

                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="clienteconsultarview.php">Ver todos los usuarios</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!--/.card -->
            </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {
    agregarClientesNuevos();
    agregarTransacciones();
    graficaTotal();
  });

  var agregarClientesNuevos = function () {
    $.ajax({
      method: "post",
      url: "../process/clienteajax.php",
      data: {"accion":"readbylimit","limit":"6"},
      success: function (data) {
        data = JSON.parse(data);
        $('#labelNuevosClientes').text("6 Nuevos Clientes");
        $.each(data, function (i, row) {
          $('#listaClientesNuevos').append(
            '<li style="width: 50%"> ' +
            '  <img width="36px" height="36px" style="height: 40px;" src="../../upload/images/client/'+ data[i].imagen +'" alt="Imagen cliente">' +
            '  <a class="users-list-name" href="#">' + data[i].nombre_cliente + '</a>' +
            '  <span class="users-list-date">' + data[i].ap_pat + ' ' + data[i].ap_mat +'</span>' +
            '</li>'
          );
        });
      }
    });
  }

  var agregarTransacciones = function () {
    $.ajax({
      method: "post",
      url: "../process/transaccionajax.php",
      data: {"accion":"readbylimit","limit":"6"},
      success: function (data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          var tipoConcepto = "";
          if(data[i].nombre_tipo_concepto == "Abono") {
            tipoConcepto = "success"
          } else {
            tipoConcepto = "danger";
          }
          $('#cuerpoTablaTransaccion').append(
            '<tr>' +
            '   <td><a>' + data[i].id_transaccion + '</a></td>' +
            '   <td>' + data[i].nombre_concepto_transaccion + '</td>' +
            '   <td>' +
            '   <div class="sparkbar" data-color="#00a65a">$'+data[i].totalesCargos+'</div>' +
            '   </td>' +
            '   <td><span class="badge badge-'+tipoConcepto+'">'+data[i].nombre_tipo_concepto+'</span></td>' +
            '</tr>'
          );
        });
      }
    });
  }
</script>

<script type="text/javascript">
  var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  var totalesCargos = [];
  var totalesAbonos = [];
  var graficaTotal = function() {

    $.ajax({
      url: "../process/transaccionajax.php",
      data: {'accion': 'readbyidtipoconcepto', 'idtipoconcepto': '1'}, //IDtipoconcepto 1 es CARGO
      method: "POST",
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);

        totalesCargos.push(data.Enero);
        totalesCargos.push(data.Febrero);
        totalesCargos.push(data.Marzo);
        totalesCargos.push(data.Abril);
        totalesCargos.push(data.Mayo);
        totalesCargos.push(data.Junio);
        totalesCargos.push(data.Julio);
        totalesCargos.push(data.Agosto);
        totalesCargos.push(data.Septiembre);
        totalesCargos.push(data.Octubre);
        totalesCargos.push(data.Noviembre);
        totalesCargos.push(data.Diciembre);

        console.log(totalesCargos);
        console.log(meses);
        $.ajax({
          url: "../process/transaccionajax.php",
          data: {'accion': 'readbyidtipoconcepto', 'idtipoconcepto': '2'}, //IDtipoconcepto 2 es ABONOS
          method: "POST",
          success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            totalesAbonos.push(data.Enero);
            totalesAbonos.push(data.Febrero);
            totalesAbonos.push(data.Marzo);
            totalesAbonos.push(data.Abril);
            totalesAbonos.push(data.Mayo);
            totalesAbonos.push(data.Junio);
            totalesAbonos.push(data.Julio);
            totalesAbonos.push(data.Agosto);
            totalesAbonos.push(data.Septiembre);
            totalesAbonos.push(data.Octubre);
            totalesAbonos.push(data.Noviembre);
            totalesAbonos.push(data.Diciembre);
            crearGrafica();
            console.log(totalesAbonos);
            console.log(meses);
          }
        });
      }
    });
  }

  var crearGrafica = function() {
    var ctx = document.getElementById('graficaBarrasCargoAbono').getContext('2d');
    console.log("aqui" + totalesCargos);
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: meses,
        datasets: [{
          label: 'Cargos',
          data: totalesCargos,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }, {
          label: 'Abonos',
          data: totalesAbonos,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }, title: {
          display: true,
          text: 'Cargos y Abonos'
        }
      }
    });
  }
</script>
