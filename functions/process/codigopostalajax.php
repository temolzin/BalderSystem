<?php
  require_once '../controller/codigopostalcontroller.php';

  $objCodigopostal = new Postal();
  $codigopostal = $_POST['codigopostal'];
  $accion = $_POST['accion'];

  if($accion == 'read'){
    echo $objCodigopostal->readbycodigopostal($codigopostal);
  }

