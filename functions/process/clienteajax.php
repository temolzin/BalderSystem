<?php
  require_once '../controller/clientecontroller.php';
  $cliente = new Cliente();
  $accion = $_POST['accion'];

  if($accion == "insert") {
    $imagen = $_FILES["imagen"];
    $nombreImagen = $imagen["name"];
    $tipoImagen = $imagen["type"];
    $carpetaImagen = "../../upload/images/client/";
    $ruta_provisional = $imagen["tmp_name"];

    if ($tipoImagen != 'image/jpg' && $tipoImagen != 'image/jpeg' && $tipoImagen != 'image/png' && $tipoImagen != 'image/gif')       {
      echo 'El archivo no es una imagen';
    }
    else {
      copy($ruta_provisional, $carpetaImagen.$nombreImagen);
    }
    $idpostal = $_POST['idpostal'];
    $idbanco = $_POST['idbanco'];
    $idgenero = $_POST['idgenero'];
    $nombre = $_POST['nombre'];
    $appat = $_POST['appat'];
    $apmat = $_POST['apmat'];
    $rfc = $_POST['rfc'];
    $curp = $_POST['curp'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $estadonacimiento = $_POST['estadonacimiento'];
    $clabe = $_POST['clabe'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $noexterior = $_POST['noexterior'];
    $nointerior = $_POST['nointerior'];
    $nss = $_POST['nss'];
    $altaimss = $_POST['altaimss'];
    $bajaimss = $_POST['bajaimss'];
    $observacion = $_POST['observacion'];

    $data = array(
      'imagen' => $nombreImagen,
      'idpostal' => $idpostal,
      'idbanco' => $idbanco,
      'idgenero' => $idgenero,
      'nombre' => $nombre,
      'appat' => $appat,
      'apmat' => $apmat,
      'rfc' => $rfc,
      'curp' => $curp,
      'fechanacimiento' => $fechanacimiento,
      'estadonacimiento' => $estadonacimiento,
      'clabe' => $clabe,
      'email' => $email,
      'telefono' => $telefono,
      'calle' => $calle,
      'noexterior' => $noexterior,
      'nointerior' => $nointerior,
      'nss' => $nss,
      'altaimss' => $altaimss,
      'bajaimss' => $bajaimss,
      'observacion' => $observacion
    );
    $cliente->insert($data);
  }
  else if($accion == "update") {
    $idcliente = $_POST['idcliente'];
    $idpostal = $_POST['idpostal'];
    $idbanco = $_POST['idbanco'];
    $idgenero = $_POST['idgenero'];
    $nombre = $_POST['nombre'];
    $appat = $_POST['appat'];
    $apmat = $_POST['apmat'];
    $rfc = $_POST['rfc'];
    $curp = $_POST['curp'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $estadonacimiento = $_POST['estadonacimiento'];
    $clabe = $_POST['clabe'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $noexterior = $_POST['noexterior'];
    $nointerior = $_POST['nointerior'];
    $nss = $_POST['nss'];
    $altaimss = $_POST['altaimss'];
    $bajaimss = $_POST['bajaimss'];
    $observacion = $_POST['observacion'];

    $data = array(
      'idcliente' => $idcliente,
      'idpostal' => $idpostal,
      'idbanco' => $idbanco,
      'idgenero' => $idgenero,
      'nombre' => $nombre,
      'appat' => $appat,
      'apmat' => $apmat,
      'rfc' => $rfc,
      'curp' => $curp,
      'fechanacimiento' => $fechanacimiento,
      'estadonacimiento' => $estadonacimiento,
      'clabe' => $clabe,
      'email' => $email,
      'telefono' => $telefono,
      'calle' => $calle,
      'noexterior' => $noexterior,
      'nointerior' => $nointerior,
      'nss' => $nss,
      'altaimss' => $altaimss,
      'bajaimss' => $bajaimss,
      'observacion' => $observacion
    );
    $cliente->update($data);
  }
  else if($accion == 'actualizarImagen') {
    $idcliente = $_POST['idcliente'];
    $imagen = $_FILES["imagen"];
    $nombreImagen = $imagen["name"];
    $tipoImagen = $imagen["type"];
    $carpetaImagen = "../../upload/images/client/";
    $ruta_provisional = $imagen["tmp_name"];

    if ($tipoImagen != 'image/jpg' && $tipoImagen != 'image/jpeg' && $tipoImagen != 'image/png' && $tipoImagen != 'image/gif')       {
      echo 'El archivo no es una imagen';
    }
    else {
      copy($ruta_provisional, $carpetaImagen.$nombreImagen);
    }

    $data = array(
      "imagen" => $nombreImagen,
      "idcliente" => $idcliente
    );
    $cliente->updateimagen($data);
  }
  else if($accion == "delete") {
    $id = $_POST['idcliente'];
    echo $cliente->delete($id);
  }
  else if($accion == "read") {
    echo $cliente->read();
  }
  else if($accion == "readarray") {
    echo $cliente->readarray();
  }
  else if($accion == "readbyid") {
    $idcliente = $_POST['idcliente'];
    echo $cliente->readbyid($idcliente);
  }
  else if($accion == "readbylimit") {
    $limite = $_POST['limit'];
    echo $cliente->readbylimit($limite);
  }
