<?php
  require_once '../controller/documentoclientecontroller.php';
  $documentoCliente = new DocumentoCliente();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    $iddocumento = $_POST['iddocumento'];
    $idcliente = $_POST['idcliente'];
    $idusuario = $_POST['idusuario'];
    $observacion = $_POST['observacion'];
    $nombrecompletocliente = $_POST['nombrecompletocliente'];

    $documentocliente = $_FILES["documentocliente"];
    $nombreDocumento = $documentocliente["name"];
    $tipoImagen = $documentocliente["type"];
    $carpetaDocumento = "../../upload/documents/".$nombrecompletocliente."/";
    $ruta_provisional = $documentocliente["tmp_name"];

    if (!file_exists($carpetaDocumento)) {
      mkdir($carpetaDocumento, 0777, true);
    }

    copy($ruta_provisional, $carpetaDocumento.$nombreDocumento);

    $data = array(
      'iddocumento' => $iddocumento,
      'idcliente' => $idcliente,
      'idusuario' => $idusuario,
      'observacion' => $observacion,
      'urldocumento' => $nombreDocumento
    );
    $documentoCliente->insert($data);
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
    $documentoCliente->update($data);
  }
  else if($accion == "delete") {
    $id = $_POST['iddocumento'];
    echo $documentoCliente->delete($id);
  }
  else if($accion == "read") {
    echo $documentoCliente->read();
  }
  else if($accion == "readdocumentosbyidcliente") {
    $idcliente = $_POST['idcliente'];
    echo $documentoCliente->readdocumentosbyidcliente($idcliente);
  }
