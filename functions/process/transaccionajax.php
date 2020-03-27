<?php
  require_once '../controller/transaccioncontroller.php';
  $transaccion = new Transaccion();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    session_start();
    $idconceptotransaccion = $_POST['conceptotransaccion'];
    $idmodulo = $_POST['modulo'];
    $idusuario = $_SESSION['user']['id_usuario'];
    $idcliente = $_POST['idcliente'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'idconceptotransaccion' => $idconceptotransaccion,
      'idmodulo' => $idmodulo,
      'idusuario' => $idusuario,
      'idcliente' => $idcliente,
      'monto' => $monto,
      'descripcion' => $descripcion
    );
    $transaccion->insert($data);
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
    $transaccion->update($data);
  }
  else if($accion == "deletepension") {
    $id = $_POST['idtransaccion'];
    echo $transaccion->delete($id);
  }
  else if($accion == "readbyidmodulo") {
    $idmodulo = $_POST['idmodulo'];
    echo $transaccion->readbyidmodulo($idmodulo);
  }
  else if($accion == "readbyidmoduloandlimit") {
    $idmodulo = $_POST['idmodulo'];
    $limite = $_POST['limit'];
    echo $transaccion->readbyidmoduloandlimit($idmodulo, $limite);
  }
  else if($accion == "readbyidmoduloandidcliente") {
    $idmodulo = $_POST['idmodulo'];
    $idcliente = $_POST['idcliente'];
    echo $transaccion->readbyidmoduloandidcliente($idmodulo,$idcliente);
  }
  else if($accion == "readbyidcliente") {
    $idcliente = $_POST['idcliente'];
    echo $transaccion->readbyidcliente($idcliente);
  }
  else if($accion == "readbyidmoduloandidclientearray") {
    $idmodulo= $_POST['idmodulo'];
    $idcliente = $_POST['idcliente'];
    echo $transaccion->readbyidmoduloandidclientearray($idmodulo, $idcliente);
  }
  else if($accion == "readbyidclientearray") {
    $idcliente = $_POST['idcliente'];
    echo $transaccion->readbyidclientearray($idcliente);
  }
  else if($accion == "readbyidmoduloandidtipoconcepto") {
    $idmodulo = $_POST['idmodulo'];
    $idtipoconcepto = $_POST['idtipoconcepto'];
    echo $transaccion->readbyidmoduloandidtipoconcepto($idmodulo, $idtipoconcepto);
  }
  else if($accion == "read") {
    echo $transaccion->read();
  }
