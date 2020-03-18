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
    session_start();
    $idtransaccion = $_POST['idActualizar'];
    $idconceptotransaccion = $_POST['conceptotransaccion'];
    $idusuario = $_SESSION['user']['id_usuario'];
    $idcliente = $_POST['idcliente'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'idtransaccion' => $idtransaccion,
      'idconceptotransaccion' => $idconceptotransaccion,
      'idusuario' => $idusuario,
      'idcliente' => $idcliente,
      'monto' => $monto,
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
  else if($accion == "readbyidcliente") {
    $idcliente = $_POST['idcliente'];
    echo $pension->readbyidcliente($idcliente);
  }
  else if($accion == "readbyidclientearray") {
    $idcliente = $_POST['idcliente'];
    echo $pension->readbyidclientearray($idcliente);
  }
