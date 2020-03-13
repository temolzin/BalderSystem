<?php
  require_once '../controller/conceptocontroller.php';
  $concepto = new Concepto();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    $idmodulo = $_POST['modulo'];
    $idtipoconceptotransaccion = $_POST['tipoconceptotransaccion'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'idmodulo' => $idmodulo,
      'idtipoconceptotransaccion' => $idtipoconceptotransaccion,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $concepto->insert($data);
  }
  else if($accion == "update") {
    $idconcepto = $_POST['idconcepto'];
    $idmodulo = $_POST['modulo'];
    $tipoconceptotransaccion = $_POST['tipoconceptotransaccion'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $data = array(
      'idconcepto' => $idconcepto,
      'idmodulo' => $idmodulo,
      'idtipoconceptotransaccion' => $tipoconceptotransaccion,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $concepto->update($data);
  }
  else if($accion == "delete") {
    $id = $_POST['idconcepto'];
    echo $concepto->delete($id);
  }
  else if($accion == "read") {
    echo $concepto->read();
  }
  else if($accion == "readbymodulo") {
    $idmodulo = $_POST['idmodulo'];
    echo $concepto->readbymodulo($idmodulo);
  }
  else if($accion == "readbyidconcepto") {
    $idconceptotransaccion = $_POST['idconceptotransaccion'];
    echo $concepto->readbyidconcepto($idconceptotransaccion);
  }
