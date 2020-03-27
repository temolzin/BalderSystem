<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Modulo implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM modulo";
      $objModulo = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objModulo[] = $value;
      }
      echo json_encode($objModulo, JSON_UNESCAPED_UNICODE);
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

    public function readbyidmodulo($idmodulo) {
      $query = "SELECT * FROM modulo WHERE id_modulo = $idmodulo";
      $objmodulo = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objmodulo[] = $value;
      }
      echo json_encode($objmodulo);
    }

  }
