<?php
  require_once '../controller/pensioncontroller.php';
  $pension = new Pension();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    $idmodulo = $_POST['modulo'];
    $idtipopensiontransaccion = $_POST['tipopensiontransaccion'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'idmodulo' => $idmodulo,
      'idtipopensiontransaccion' => $idtipopensiontransaccion,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $pension->insert($data);
  }
  else if($accion == "update") {
    $idpension = $_POST['idpension'];
    $idmodulo = $_POST['modulo'];
    $tipopensiontransaccion = $_POST['tipopensiontransaccion'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $data = array(
      'idpension' => $idpension,
      'idmodulo' => $idmodulo,
      'idtipopensiontransaccion' => $tipopensiontransaccion,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $pension->update($data);
  }
  else if($accion == "delete") {
    $id = $_POST['idpension'];
    echo $pension->delete($id);
  }
  else if($accion == "read") {
    echo $pension->read();
  }
