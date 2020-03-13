<?php
require_once '../controller/usuariocontroller.php';
$usuario = new Usuario();
$accion = $_POST['accion'];

if($accion == "insert") {
  $imagen = $_FILES["imagen"];
  $nombreImagen = $imagen["name"];
  $tipoImagen = $imagen["type"];
  $carpetaImagen = "../../upload/images/user/";
  $ruta_provisional = $imagen["tmp_name"];

  if ($tipoImagen != 'image/jpg' && $tipoImagen != 'image/jpeg' && $tipoImagen != 'image/png' && $tipoImagen != 'image/gif')       {
    echo 'El archivo no es una imagen';
  }
  else {
    copy($ruta_provisional, $carpetaImagen.$nombreImagen);
  }
  $idtipousuario = $_POST['idtipousuario'];
  $nombre = $_POST['nombre'];
  $appat = $_POST['appat'];
  $apmat = $_POST['apmat'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $username = $_POST['nombreusuario'];
  $password = $_POST['pass'];

  $data = array(
    'imagen' => $nombreImagen,
    'idtipousuario' => $idtipousuario,
    'nombre' => $nombre,
    'appat' => $appat,
    'apmat' => $apmat,
    'email' => $email,
    'telefono' => $telefono,
    'username' => $username,
    'password' => $password
  );
  $usuario->insert($data);
}
else if($accion == "update") {
  $idusuario = $_POST['idusuario'];
  $idtipousuario = $_POST['idtipousuario'];
  $nombre = $_POST['nombre'];
  $appat = $_POST['appat'];
  $apmat = $_POST['apmat'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $username = $_POST['nombreusuario'];
  $password = $_POST['pass'];

  $data = array(
    'idusuario' => $idusuario,
    'idtipousuario' => $idtipousuario,
    'nombre' => $nombre,
    'appat' => $appat,
    'apmat' => $apmat,
    'email' => $email,
    'telefono' => $telefono,
    'username' => $username,
    'password' => $password
  );
  $usuario->update($data);

  //Validación para ver si se está actualizando el perfil
  //En caso de que si se esté actualizando el perfil se va a ejecutar una consulta para actualizar los datos deel perfil en tiempo real
  if(isset($_POST['perfilUsuario'])) {
    echo $usuario->readbyidprofile($idusuario);
  }
}
else if($accion == 'actualizarImagen') {
  $idusuario = $_POST['idusuario'];
  $imagen = $_FILES["imagen"];
  $nombreImagen = $imagen["name"];
  $tipoImagen = $imagen["type"];
  $carpetaImagen = "../../upload/images/user/";
  $ruta_provisional = $imagen["tmp_name"];

  if ($tipoImagen != 'image/jpg' && $tipoImagen != 'image/jpeg' && $tipoImagen != 'image/png' && $tipoImagen != 'image/gif')       {
    echo 'El archivo no es una imagen';
  }
  else {
    copy($ruta_provisional, $carpetaImagen.$nombreImagen);
  }

  $data = array(
    "imagen" => $nombreImagen,
    "idusuario" => $idusuario
  );
  $usuario->updateimagen($data);
  //Validación para ver si se está actualizando el perfil
  //En caso de que si se esté actualizando el perfil se va a ejecutar una consulta para actualizar los datos deel perfil en tiempo real
  if(isset($_POST['perfilUsuario'])) {
    echo $usuario->readbyidprofile($idusuario);
  }
}
else if($accion == "delete") {
  $id = $_POST['idusuario'];
  echo $usuario->delete($id);
}
else if($accion == "read") {
  echo $usuario->read();
}
else if($accion == "validarUsername") {
  $username1 = $_POST['username'];
  echo $usuario->readByUserName($username1);
}
else if($accion == "login") {
  echo $usuario->readbyidandpass($_POST['username'], $_POST['password']);
}
