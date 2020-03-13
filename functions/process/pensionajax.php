<?php
  require_once '../controller/pensioncontroller.php';
  $pension = new Pension();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    session_start();
    $idconceptotransaccion = $_POST['conceptotransaccion'];
    $idusuario = $_SESSION['user']['id_usuario'];
    $idcliente = $_POST['idcliente'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'idconceptotransaccion' => $idconceptotransaccion,
      'idusuario' => $idusuario,
      'idcliente' => $idcliente,
      'monto' => $monto,
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
      'idmodulo' => $idmodulo,
      'idtipopensiontransaccion' => $tipopensiontransaccion,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $pension->update($data);
  }
  else if($accion == "delete") {
    $id = $_POST['idtransaccion'];
    echo $pension->delete($id);
  }
  else if($accion == "read") {
    echo $pension->read();
  }
