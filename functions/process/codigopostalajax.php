<?php
  require_once '../controller/codigopostalcontroller.php';

  $objCodigopostal = new Postal();
  $accion = $_POST['accion'];

  if($accion == 'readByCodigoPostal') {
    $codigopostal = $_POST['codigopostal'];
    echo $objCodigopostal->readbycodigopostal($codigopostal);
  }
  if($accion == 'readByIdPostal') {
    $idpostal = $_POST['idpostal'];
    echo $objCodigopostal->readbyidpostal($idpostal);
  }

