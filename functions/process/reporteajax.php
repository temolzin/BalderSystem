<?php
  require '../../vendor/autoload.php';
  require '../../build/config/config.php';
  require_once '../controller/transaccioncontroller.php';
  require_once '../controller/documentoclientecontroller.php';
  use Dompdf\Dompdf;
  $transaccion = new Transaccion();
  $accion = $_REQUEST['accion'];
  $idcliente = $_REQUEST['idcliente'];

  if($accion == "reporteEstadoCuentaPension") {
    $datosConsulta = $transaccion->readbyidmoduloandidclientearray(1, $idcliente);
    $nombrePDF = "EstadodeCuentaPensión.pdf";
    $htmlPDF = headerPDF($datosConsulta);
    $htmlPDF .= contentPDF($datosConsulta);
    generarPDF($htmlPDF,$nombrePDF);
  } else if($accion == "reporteEstadoCuentaPrestamo") {
    $datosConsulta = $transaccion->readbyidmoduloandidclientearray(2, $idcliente);
    $nombrePDF = "EstadodeCuentaPrestamo.pdf";
    $htmlPDF = headerPDF($datosConsulta);
    $htmlPDF .= contentPDF($datosConsulta);
    generarPDF($htmlPDF,$nombrePDF);
  } else if($accion == "reporteDocumentoCliente") {
    $documentoCliente = new DocumentoCliente();
    $datosConsulta = $documentoCliente->readdocumentosbyidclientearray($idcliente);
    $htmlPDF = headerPDFDocumentClient($datosConsulta);
    $htmlPDF .= contentPDFDocumentClient($datosConsulta);
    generarPDF($htmlPDF,"CheckListDocumentoCliente.pdf");
  }

  function headerPDF($datosConsulta) {
    //Se pone setLocale es_MX para traducir el día y el mes a español, pero la fecha no funciona AM/PM
    setlocale(LC_ALL, 'es_MX.UTF-8');
    $horaActual = strftime("%I:%M:%S %p");
    //Se establece SetLocale Spanish para que funcione AM/PM
    setlocale(LC_ALL, 'spanish');
    $fechaActual = strftime("%A, %d de %B de %Y");

    foreach ($datosConsulta as $key => $value) {
      $nombreModulo = $value['nombre_modulo'];
      $nombreCliente = $value['nombre_cliente'] . ' '. $value['ap_pat'] . ' ' . $value['ap_mat'];
      $direccionCliente = $value['calle'] . ' No.Ext. ' . $value['noexterior'] . ', ' . $value['codigo'];
      $direccionEstadoCliente = $value['municipio']. ', ' . $value['estado'];
      $emailCliente = $value['email'];
    }

    $html = '
      <!DOCTYPE html>
        <html lang="es">
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
                  <div><h2 class="name">Módulo: '.$nombreModulo.'</h2></div>
  <!--                 <div class="date">Impresión: ' . $fechaActual . ', ' . $horaActual . '</div>-->
                </div>
              </div>
              <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th class="no">#</th>
                    <th class="datehead">Fecha</th>
                    <th class="deschead">Concepto</th>
                    <th class="unithead">Cargo</th>
                    <th class="qtyhead">Abono</th>
                    <th class="totalhead">Total</th>
                  </tr>
                </thead>
                <tbody>';
    return $html;
  }

  function contentPDF($datosConsulta) {
    $i = 1;
    $totalCargo = 0;
    $totalAbono = 0;
    $total = 0;
    $html = "";

    foreach ($datosConsulta as $key => $value) {
      $nombreTransaccion = $value['nombre_concepto_transaccion'];
      $descripcionPago = $value['6'];
      $tipoconcepto = $value['nombre_tipo_concepto'];
      $montoTransaccion = $value['monto'];
      $fechaTransaccion = $value['fecha_registro'];
      $cargo = 0;
      $abono = 0;
      if($tipoconcepto == "Cargo") {
        $cargo = $montoTransaccion;
        $abono = 0;
      } else if ($tipoconcepto == "Abono") {
        $abono = $montoTransaccion;
        $cargo = 0;
      }
      $total += $abono - $cargo;
      $totalCargo += $cargo;
      $totalAbono += $abono;
      $grandTotal = $totalAbono - $totalCargo;

      if($total < 0) {
        $total = number_format($total,2, ".",",");
      } else {
        $total = "$" . number_format($total,2, ".",",");
      }
      $html .= '<tr>
                    <td class="no">'.$i.'</td>
                    <td class="dateTransaccion">'.$fechaTransaccion.'</td>
                    <td class="desc"><h3>'.$nombreTransaccion.'</h3> Tipo: '.$tipoconcepto.'<br> '.$descripcionPago.'</td>
                    <td class="unit">$'.number_format($cargo,2, ".",",").'</td>
                    <td class="qty">$'.number_format($abono,2, ".",",").'</td>
                    <td class="total">'.str_replace("-","-$", $total).'</td>
                  </tr>';
      $i++;
      //Se reemplazan los símbolos para castear la variable total y guardar el mismo valor para el foreach para imprimir la columna total en el PDF
      $total = str_replace("$","", $total);
      $total = str_replace("-$","", $total);
      $total = str_replace(",","", $total);
      $total = (double) $total;
    }

    if($grandTotal < 0) {
      $grandTotal = number_format($grandTotal,2, ".",",");
      $estiloTotal = "border-top: 1px solid #DF0909; color: #DF0909;";
    } else {
      $estiloTotal = "color: #57B223;";
      $grandTotal = "$" . number_format($grandTotal,2, ".",",");
    }
    $html .= '</tbody>
                <tfoot>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">CARGOS</td>
                    <td>$'.number_format($totalCargo,2, ".",",").'</td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">ABONOS</td>
                    <td>$'.number_format($totalAbono,2, ".",",").'</td>
                  </tr>
                  <tr style="'.$estiloTotal.'">
                    <td colspan="3"></td>
                    <td colspan="2">TOTAL</td>
                    <td>'.str_replace("-","-$", $grandTotal).'</td>
                  </tr>
                </tfoot>
              </table>
            </main>
            <footer>
              Estado de cuenta generado por <a href="' . URL . '">BalderSystem</a> Copyright &copy; 2020 All rights reserved.
            </footer>
          </body>
        </html>';
    return $html;
  }

  function generarPDF($html,$nombrePDF) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html, "UTF-8");
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // add the header
    $canvas = $dompdf->get_canvas();
    $font = $dompdf->getFontMetrics()->getFont("Arial", "");

    // the same call as in my previous example
    $canvas->page_text(490, 792, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 12, array(0, 0, 0));

    $dompdf->stream($nombrePDF, array("Attachment" => 0));
  }

  function headerPDFDocumentClient($datosConsulta) {
    //Se pone setLocale es_MX para traducir el día y el mes a español, pero la fecha no funciona AM/PM
    setlocale(LC_ALL, 'es_MX.UTF-8');
    $horaActual = strftime("%I:%M:%S %p");
    //Se establece SetLocale Spanish para que funcione AM/PM
    setlocale(LC_ALL, 'spanish');
    $fechaActual = strftime("%A, %d de %B de %Y");

    foreach ($datosConsulta as $key => $value) {

      $documentosubido = $value['docup'];
      $nombredocumento = $value['nombre_documento'];
//      $nombreModulo = $value['nombre_modulo'];
//      $nombreCliente = $value['nombre_cliente'] . ' '. $value['ap_pat'] . ' ' . $value['ap_mat'];
//      $direccionCliente = $value['calle'] . ' No.Ext. ' . $value['noexterior'] . ', ' . $value['codigo'];
//      $direccionEstadoCliente = $value['municipio']. ', ' . $value['estado'];
//      $emailCliente = $value['email'];
    }
      $html = '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>CheckList Documentos Balder System</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> 
            <style type="text/css"> 
                .fa { display: inline; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: 1; 
                font-family: FontAwesome; font-size: inherit; text-rendering: auto; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; } 
            </style> 
            <link rel="stylesheet" href="../../dist/css/reportedocumentocliente.css" media="all" />
          </head>
          <body>
            <header class="clearfix">
              <div id="logo">
                <img src="../../dist/img/icons/faviconletter.png">
              </div>
              <h1>Documentación</h1>
              <div id="details" class="clearfix">
                <div id="company">
                  <div>Balder System</div>
                  <div></div>
                  <div>55-35-09-29-65</div>
                  <div><a href="mailto:company@example.com">direccion@balder.com</a></div>
                  <br>
                  <div class="date">Fecha de impresión: ' . $fechaActual . ', <br>' . $horaActual . '</div>
                </div>
                <div id="project">
                  <div><span>PROJECT</span> Website development</div>
                  <div><span>CLIENT</span> John Doe</div>
                  <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
                  <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
                  <div><span>DATE</span> August 17, 2015</div>
                  <div><span>DUE DATE</span> September 17, 2015</div>
                </div>
              </div>
            </header>
            <main>
              <table>
                <thead>
                  <tr>
                    <th class="no">No.</th>
                    <th class="service">Documento</th>
                    <th>Cumple</th>
                    <th class="desc">Observaciones</th>
                  </tr>
                </thead>
                <tbody>';
      return $html;
  }

  function contentPDFDocumentClient($datosConsulta) {
    $cumple = "";
    $nombredocumento = "";
    $observacion = "";
    $i = 1;
    $html = "";
    foreach ($datosConsulta as $key => $value) {
      $nombredocumento = $value['nombre_documento'];
      $observacion = $value['observacion'];
      if($value['docup'] == null) {
        $cumple = '<img src="../../dist/img/icons/errorplano.png" width="28px" height="28px">';
      } else {
        $cumple = '<img src="../../dist/img/icons/ok.png" width="32px" height="32px">';
      }
      $html .= '
                <tr>
                    <td class="no">'.$i.'</td>
                    <td class="service">'.$nombredocumento.'</td>
                    <td class="desc">'.$cumple.'</td>
                    <td class="unit">'.$observacion.'</td>
                  </tr>';
      $i++;
    }
    $html .= '</tbody>
              </table>
            </main>
            <footer>
              Estado de cuenta generado por <a href="' . URL . '">BalderSystem</a> Copyright &copy; 2020 All rights reserved.
            </footer>
          </body>
        </html>';
    return $html;
  }
