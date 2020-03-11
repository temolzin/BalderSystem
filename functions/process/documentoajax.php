<?php
  require_once '../controller/documentocontroller.php';
  $documento = new Documento();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $data = array(
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $documento->insert($data);
  }
  else if($accion == "update") {
    $iddocumento = $_POST['iddocumento'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $data = array(
      'iddocumento' => $iddocumento,
      'nombre' => $nombre,
      'descripcion' => $descripcion
    );
    $documento->update($data);
  }
  else if($accion == "delete") {
    $id = $_POST['iddocumento'];
    echo $documento->delete($id);
  }
  else if($accion == "read") {
    echo $documento->read();
  }
