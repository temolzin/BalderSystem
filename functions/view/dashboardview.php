<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header("inicio", 'Inicio');
?>
  <div class="content">
    <div class="container-fluid">
      <?php
        if($menu->privilegioInicioUltimasTransacciones == "style='display:none'" && $menu->privilegioInicioUltimosClientes == "style='display:none'" && $menu->privilegioInicioGraficas == "style='display:none'") {
          echo '
          <br><br>
          <div class="row">
            <br><br>
            <div class="col-lg-12 text-center">
              <img src="../../dist/img/img-01.png" alt=""><br><br>
            </div>
          </div>
          ';
        }
      ?>
      <div class="row" <?php echo $menu->privilegioInicioGraficas?>>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Gráfica de Barras Pensiones</h3>
              <div class="card-tools">
                <button href="#" class="btn btn-tool btn-sm" id="btnExportarGraficaBarras">
                  <i class="fas fa-download"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <canvas id="graficaBarrasCargoAbono"></canvas>
            </div>
          </div>
          </div>
          <!-- /.card -->
          <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Gráfica de Puntos Pensiones</h3>
              <div class="card-tools">
                <button href="#" class="btn btn-tool btn-sm" id="btnExportarGraficaPuntos">
                  <i class="fas fa-download"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <canvas id="graficaPuntosCargoAbono"></canvas>
            </div>
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
      </div>

      <div class="row">
        <!-- /.col-md-6 -->
          <div class="col-lg-<?php echo $menu->privilegioInicioUltimosClientes == "style='display:none'" ? "12" : "6";?>" <?php echo $menu->privilegioInicioUltimasTransacciones?>>
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
                <a href="transaccionconsultarview.php">Ver todas las transacciones</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-lg-<?php echo $menu->privilegioInicioUltimasTransacciones == "style='display:none'" ? "12" : "6";?>" <?php echo $menu->privilegioInicioUltimosClientes?>>
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Últimos Clientes</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger" id="labelNuevosClientes"></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i  class="fas fa-times"></i>
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
                    <a href="clienteconsultarview.php">Ver todos los clientes</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
<?php
  $menu->footer();
  ?>
<script type="text/javascript">
  $(document).ready(function () {
    agregarClientesNuevos();
    agregarTransacciones();
    graficaTotal();
    exportarGrafica();
  });

  var exportarGrafica = function () {
    $('#btnExportarGraficaBarras').on('click', function () {
      $('#graficaBarrasCargoAbono').get(0).toBlob(function(blob){
        saveAs(blob, 'GraficaBarrasInicioPension.png');
      });
    });
    $('#btnExportarGraficaPuntos').on('click', function () {
      $('#graficaPuntosCargoAbono').get(0).toBlob(function(blob){
        saveAs(blob, 'GraficaPuntosInicioPension.png');
      });
    });
  }

  var agregarClientesNuevos = function () {
    $.ajax({
      method: "post",
      url: "../process/clienteajax.php",
      data: {"accion":"readbylimit","limit":"6"},
      success: function (data) {
        data = JSON.parse(data);
        $('#labelNuevosClientes').text("Nuevos Clientes");
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
      data: {"accion":"readbyidmoduloandlimit","limit":"6", "idmodulo":"1"},
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
            '   <div class="sparkbar" data-color="#00a65a">'+new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(data[i].monto)+'</div>' +
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
      data: {'accion': 'readbyidmoduloandidtipoconcepto', 'idtipoconcepto': '1', 'idmodulo':'1'}, //IDtipoconcepto 1 es CARGO, El módulo 1 es pensiones
      method: "POST",
      success: function (data) {
        data = JSON.parse(data);

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

        $.ajax({
          url: "../process/transaccionajax.php",
          data: {'accion': 'readbyidmoduloandidtipoconcepto', 'idtipoconcepto': '2', 'idmodulo':'1'}, //IDtipoconcepto 2 es ABONOS el idmodulo 1 es el módulo de pensiones
          method: "POST",
          success: function (data) {
            console.log(data);
            data = JSON.parse(data);

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
            crearGraficaBarras();
            crearGraficaPuntos();
          }
        });
      }
    });
  }

  var crearGraficaBarras = function() {
    var ctx = document.getElementById('graficaBarrasCargoAbono').getContext('2d');
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
              beginAtZero: true,
              callback: function(value, index, values) {
                return '$' + value;
              }
            }
          }]
        },
        responsive: true,
        fullWidth: true,
        legend: {responsive: false},
        title: {
          display: true,
          text: 'Cargos y Abonos Pensión'
        },
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              return data.datasets[tooltipItem.datasetIndex].label + ": $" + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function (c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
              });
            }

          }
        }
      }
    });
  }

  var crearGraficaPuntos = function() {
    var ctx = document.getElementById('graficaPuntosCargoAbono').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
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
              beginAtZero: true,
              callback: function(value, index, values) {
                return '$' + value;
              }
            }
          }]
        }, title: {
          display: true,
          text: 'Cargos y Abonos Pensión'
        },
        tooltips: { callbacks: { label: function(tooltipItem, data) { return "$" + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }); } } }
      }
    });
  }
</script>
