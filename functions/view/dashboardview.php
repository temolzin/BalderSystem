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
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
              </div>
            </div>
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
      url: "../process/pensionajax.php",
      data: {"accion":"readbylimit","limit":"6"},
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
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
            '   <div class="sparkbar" data-color="#00a65a">$'+data[i].monto+'</div>' +
            '   </td>' +
            '   <td><span class="badge badge-'+tipoConcepto+'">'+data[i].nombre_tipo_concepto+'</span></td>' +
            '</tr>'
          );
        });
      }
    });
  }
</script>

<script>
  $.ajax({
    url: "../process/clienteajax",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    data: {'accion':'readbytipoconcepto', 'idtipoconcepto':'1'}, //IDtipoconcepto 1 es CARGO
    method: "POST",
    success: function(data) {
      var nombre = [];
      var stock = [];
      var color = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
      var bordercolor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
      console.log(data);

      for (var i in data) {
        nombre.push(data[i].nombre);
        stock.push(data[i].stock);
      }

      var chartdata = {
        labels: nombre,
        datasets: [{
          label: nombre,
          backgroundColor: color,
          borderColor: color,
          borderWidth: 2,
          hoverBackgroundColor: color,
          hoverBorderColor: bordercolor,
          data: stock
        }]
      };

      var mostrar = $("#miGrafico");

      var grafico = new Chart(mostrar, {
        type: 'doughnut',
        data: chartdata,
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });


  var ctx = document.getElementById('graficaBarrasCargoAbono').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
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
      },       title: {
        display: true,
        text: 'Custom Chart Title'
      }
    }
  });
</script>
