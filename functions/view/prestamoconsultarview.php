<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('prestamover','Listado de Préstamos');
  ?>
  <div class="container">
    <div class="col-12">
      <div class="row">
        <img src="../../dist/img/construccion.png" alt="" class="img-fluid">
      </div>
    </div>
  </div>

  <?php
    $menu->footer();
    ?>

