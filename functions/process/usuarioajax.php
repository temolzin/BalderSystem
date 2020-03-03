<?php
  require_once '../controller/usuariocontroller.php';
  $usuario = new Usuario();
  $accion = $_POST['accion'];

  if($accion == "insert") {

  }
  else if($accion == "update") {

  }
  else if($accion == "delete") {

  }
  else if($accion == "read") {

  }
  else if($accion == "login") {
    echo $usuario->readbyidandpass($_POST['username'], $_POST['password']);
  }
