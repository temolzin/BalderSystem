<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Usuario implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario";
      $objUsuario = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objUsuario[] = $value;
      }
      echo $objUsuario;
    }

    public function insert($data)
    {
      // TODO: Implement insert() method.
    }

    public function delete($data)
    {
      // TODO: Implement delete() method.
    }

    public function update($id)
    {
      // TODO: Implement update() method.
    }

    public function readbyidandpass($id, $pass) {
      session_start();
      $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario WHERE username = '" . $id . "' and password = '" . $pass ."'";

      foreach ($this->conex->consultar($query) as $key => $value) {
        $_SESSION['user'] = $value;
      }
      //Se agregan la sesión al ingresar datos correctos
      $_SESSION['user']['nombrecompleto'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'] . " " . $_SESSION['user']['ap_mat'];
      $_SESSION['user']['nombremedio'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'];
      echo 'ok';
    }
  }
