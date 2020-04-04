<?php

  require '../../vendor/autoload.php';
  require '../../build/config/config.php';
  use Dompdf\Dompdf;

  //  $nombreCompletoCliente = $_POST[''];
  //  $nombre  = $_POST[''];
  //Se pone setLocale es_MX para traducir el día y el mes a español, pero la fecha no funciona AM/PM
  setlocale(LC_ALL, 'es_MX.UTF-8');
  $horaActual = strftime("%I:%M:%S %p");
  //Se establece SetLocale Spanish para que funcione AM/PM
  setlocale(LC_ALL, 'spanish');
  $fechaActual = strftime("%A, %d de %B de %Y");

  $html = '
      <!DOCTYPE html>
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
            </div>
            </div>
          </header>
          <main>
            <div id="details" class="clearfix">
              <div id="client">
                <div class="to">Cliente:</div>
                <h2 class="name">John Doe</h2>
                <div class="address">796 Silver Harbour, TX 79273, US</div>
                <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
              </div>
              <div id="invoice">
                <h1>Estado de cuenta</h1>
<!--                <div class="date">Date of Invoice: 01/06/2014</div>-->
                <div class="date">Fecha de impresión: ' .$fechaActual . ', ' .$horaActual . '</div>
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
              <tbody>
                <tr>
                  <td class="no">01</td>
                  <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company\'s existing visual identity</td>
                  <td class="unit">$40.00</td>
                  <td class="qty">30</td>
                  <td class="total">$1,200.00</td>
                </tr>
                <tr>
                  <td class="no">02</td>
                  <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                  <td class="unit">$40.00</td>
                  <td class="qty">80</td>
                  <td class="total">$3,200.00</td>
                </tr>                <tr>
                  <td class="no">02</td>
                  <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                  <td class="unit">$40.00</td>
                  <td class="qty">80</td>
                  <td class="total">$3,200.00</td>
                </tr>  
                </tr>              
                <tr>
                  <td class="no">03</td>
                  <td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                  <td class="unit">$40.00</td>
                  <td class="qty">20</td>
                  <td class="total">$800.00</td>
                </tr>
              </tbody>
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
            Estado de cuenta generado por Copyright &copy; 2020 <a href="'.URL.'">BalderSystem</a> All rights reserved.
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
  $font, 12, array(0,0,0));

  $dompdf->stream("document.pdf");
?>
