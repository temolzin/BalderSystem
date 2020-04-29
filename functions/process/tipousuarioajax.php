<?php
  require_once '../controller/tipousuariocontroller.php';
  $tipousuario = new TipoUsuario();
  $accion = $_POST['accion'];

  if($accion == "inserttipousuarioprivilegio") {
    $nombrerol = $_POST['nombrerol'];
    // Se utiliza FOREACH para recorrer todas las variables envíadas por POST, ya que no se sabe cuantos combobox activos se vayan a mandar.
    $arrayModuloPrivilegio = array();
    $arrayPrivilegio = array();
    $i = 0;
    foreach($_POST as $campo => $valor){
      //Se contempla LENGHT -3 para obtener PR de la palabra PRIV y así agregar los valores al arreglo indicado
      if(substr($campo , 0, -3) == "pr") {
        //Se hace START -1 ya que el valor recibido es PRIV1 y se necesita obtener el valor entero de esta cadena por eso START es -1
        $arrayPrivilegio[] = substr($campo , -1);
      }
      //Se hace LENGHT -4 ya que hay algunos valores que son PRIV10 y són 2 dígitos al final por eso es -4 y el de arriba -3 para validar que sea PR
      else if(substr($campo , 0, -4) == "pr") {
        //Se hace START -2 ya que hay algunos valores que son PRIV10 y són 2 dígitos al final por eso es -2 para obtener los números enteros que sería el ID del privilegio
        $arrayPrivilegio[] = substr($campo , -2);
      }
      //Es el mismo proceso que los if de arriba, sólo que este válida si la variable envíada empieza con m para mandarlo al arreglo correspondiente
      else if(substr($campo , 0, -3) == "m") {
        $arrayModuloPrivilegio[] = substr($campo , -1);
      }
      else if(substr($campo , 0, -4) == "m") {
        $arrayModuloPrivilegio[] = substr($campo , -2);
      }
    }
//    var_dump($arrayModuloPrivilegio);
//    var_dump($arrayPrivilegio);
//      echo "- ". $campo ." = ". $valor;

    $data = array(
      "arrayModuloPrivilegio" => $arrayModuloPrivilegio,
      "arrayPrivilegio" => $arrayPrivilegio,
      "nombrerol" => $nombrerol
    );
    $tipousuario->inserttipousuarioprivilegio($data);
  }
  else if($accion == "updatetipousuarioprivilegio") {
    $nombrerol = $_POST['nombrerol'];
    $idtipousuario = $_POST['idtipousuario'];
    // Se utiliza FOREACH para recorrer todas las variables envíadas por POST, ya que no se sabe cuantos combobox activos se vayan a mandar.
    $arrayModuloPrivilegio = array();
    $arrayPrivilegio = array();
    $i = 0;
    foreach($_POST as $campo => $valor){
      //Se contempla LENGHT -3 para obtener PR de la palabra PRIV y así agregar los valores al arreglo indicado
      if(substr($campo , 0, -3) == "pr") {
        //Se hace START -1 ya que el valor recibido es PRIV1 y se necesita obtener el valor entero de esta cadena por eso START es -1
        $arrayPrivilegio[] = substr($campo , -1);
      }
      //Se hace LENGHT -4 ya que hay algunos valores que son PRIV10 y són 2 dígitos al final por eso es -4 y el de arriba -3 para validar que sea PR
      else if(substr($campo , 0, -4) == "pr") {
        //Se hace START -2 ya que hay algunos valores que son PRIV10 y són 2 dígitos al final por eso es -2 para obtener los números enteros que sería el ID del privilegio
        $arrayPrivilegio[] = substr($campo , -2);
      }
      //Es el mismo proceso que los if de arriba, sólo que este válida si la variable envíada empieza con m para mandarlo al arreglo correspondiente
      else if(substr($campo , 0, -3) == "m") {
        $arrayModuloPrivilegio[] = substr($campo , -1);
      }
      else if(substr($campo , 0, -4) == "m") {
        $arrayModuloPrivilegio[] = substr($campo , -2);
      }
    }
//    var_dump($arrayModuloPrivilegio);
//    var_dump($arrayPrivilegio);
//      echo "- ". $campo ." = ". $valor;

    $data = array(
      "arrayModuloPrivilegio" => $arrayModuloPrivilegio,
      "arrayPrivilegio" => $arrayPrivilegio,
      "nombrerol" => $nombrerol,
      "idtipousuario" => $idtipousuario
    );
    $tipousuario->updatetipousuarioprivilegio($data);
  }
  else if($accion == "delete") {
    $id = $_POST['idprivilegiousuario'];
    echo $tipousuario->delete($id);
  }
  else if($accion == "read") {
    echo $tipousuario->read();
  }
  else if($accion == "readbyidmoduloprivilegio") {
    $idmoduloprivilegio = $_POST['idmoduloprivilegio'];
    echo $tipousuario->readbyidmoduloprivilegio($idmoduloprivilegio);
  }
  else if($accion == "readmoduloprivilegio") {
    echo $tipousuario->readmoduloprivilegio();
  }
  else if($accion == "readprivilegiobyidtipousuario") {
    $idtipousuario = $_POST['idtipousuario'];
    echo $tipousuario->readprivilegiobyidtipousuario($idtipousuario);
  }

