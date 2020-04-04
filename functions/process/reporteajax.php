<?php
  require '../../vendor/autoload.php';
  require '../../build/config/config.php';
  require_once '../controller/transaccioncontroller.php';
  use Dompdf\Dompdf;
  $transaccion = new Transaccion();
  $accion = $_REQUEST['accion'];
  //Se pone setLocale es_MX para traducir el día y el mes a español, pero la fecha no funciona AM/PM
  setlocale(LC_ALL, 'es_MX.UTF-8');
  $horaActual = strftime("%I:%M:%S %p");
  //Se establece SetLocale Spanish para que funcione AM/PM
  setlocale(LC_ALL, 'spanish');
  $fechaActual = strftime("%A, %d de %B de %Y");

  if($accion == "reporteEstadoCuentaPension") {
    $idcliente = $_REQUEST['idcliente'];
    $datos = $transaccion->readbyidmoduloandidclientearray(1, $idcliente);
    foreach ($datos as $key => $value) {
      $nombreCliente = $value['nombre_cliente'] . ' '. $value['ap_pat'] . ' ' . $value['ap_mat'];
      $direccionCliente = $value['calle'] . ' No.Ext. ' . $value['noexterior'] . ', ' . $value['codigo'];
      $direccionEstadoCliente = $value['municipio']. ', ' . $value['estado'];
      $emailCliente = $value['email'];
    }

    $html = '<!DOCTYPE html>
      <html lang="en">
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          <title>Estado de Cuenta Balder System</title>
          <link rel="stylesheet" href="../../dist/css/reporteestadodecuenta.css" media="all" />
        </head>
        <body>
          <header class="clearfix">
            <div id="logo">
              <img src="../../dist/img/icons/faviconletter.png">
            </div>
            <div id="company">
              <h2 class="name">Balder System</h2>
              <div></div>
              <div>55-35-09-29-65</div>
              <div><a href="mailto:company@example.com">direccion@balder.com</a></div>
              <div class="date">Fecha de impresión: ' . $fechaActual . ', ' . $horaActual . '</div>
            </div>
            </div>
          </header>
          <main>
            <div id="details" class="clearfix">
              <div id="client">
                <div class="to">Cliente:</div>
                <h2 class="name">'.$nombreCliente.'</h2>
                <div class="address">'.$direccionCliente.'</div>
                <div class="address">'.$direccionEstadoCliente.'</div>
                <div class="email"><a href="'.$emailCliente.'">'.$emailCliente.'</a></div>
              </div>
              <div id="invoice">
                <h1>Estado de cuenta</h1>
                <div class="date">Módulo: Pensión</div>
<!--                 <div class="date">Impresión: ' . $fechaActual . ', ' . $horaActual . '</div>-->
              </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th class="no">#</th>
                  <th class="deschead">Concepto</th>
                  <th class="unithead">Cargo</th>
                  <th class="qtyhead">Abono</th>
                  <th class="totalhead">Total</th>
                </tr>
              </thead>
              <tbody>';
    $i = 1;
    foreach ($datos as $key => $value) {
      $nombreTransaccion = $value['nombre_concepto_transaccion'];
      $descripcionPago = $value['6'];
      $tipoconcepto = $value['nombre_tipo_concepto'];
      $montoTransaccion = $value['monto'];
//      $direccionEstadoCliente = $value['municipio']. ', ' . $value['estado'];
//      $emailCliente = $value['email'];
//      {data:"nombre_modulo"},
//      {data:"nombre_tipo_concepto"},
//      {data:"nombre_concepto_transaccion"},
//      {data:"fecha_registro"},
//      {data:"monto"},
      $cargo = 0;
      $abono = 0;
      if($tipoconcepto == "Cargo") {
        $cargo = $montoTransaccion;
        $abono = 0;
      } else if ($tipoconcepto == "Abono") {
        $abono = $montoTransaccion;
        $cargo = 0;
      }
      $total = 0;
      $total = $total - ($cargo - $abono);
      $html .= '<tr>
                  <td class="no">'.$i.'</td>
                  <td class="desc"><h3>'.$nombreTransaccion.'</h3>'.$descripcionPago.$tipoconcepto.'</td>
                  <td class="unit">'.$cargo.'</td>
                  <td class="qty">'.$abono.'</td>
                  <td class="total">'.$total.'</td>
                </tr>';
      $i++;
    }

    $html .= '</tbody>
              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2">SUBTOTAL</td>
                  <td>$5,200.00</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2">TAX 25%</td>
                  <td>$1,300.00</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2">GRAND TOTAL</td>
                  <td>$6,500.00</td>
                </tr>
              </tfoot>
            </table>
<!--            <div id="thanks">Thank you!</div>-->
<!--            <div id="notices">
              <div>Nota:</div>
              <div class="notice">El estado de cuenta fue generado por: </div>
            </div>-->
          </main>
          <footer>
            Estado de cuenta generado por Copyright &copy; 2020 <a href="' . URL . '">BalderSystem</a> All rights reserved.
          </footer>
        </body>
      </html>';
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html, "UTF-8");
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

// add the header
    $canvas = $dompdf->get_canvas();
    $font = $dompdf->getFontMetrics()->getFont("Arial", "");

// the same call as in my previous example
    $canvas->page_text(490, 792, "Página {PAGE_NUM} de {PAGE_COUNT}",
      $font, 12, array(0, 0, 0));

    $dompdf->stream("EstadoCuentaPension".$idcliente.".pdf", array("Attachment" => 0));
  } else if($accion == "reporteEstadoCuentaPrestamo") {
    return require '../view/reporteestadodecuentaprestamoview.php';
  }
