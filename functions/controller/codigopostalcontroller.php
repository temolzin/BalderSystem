<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Postal implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM postal";
      $objPostal = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPostal[] = $value;
      }
      echo $objPostal;
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

    public function readbycodigopostal($codigopostal) {
      $query = "SELECT * FROM postal WHERE codigo = '" . $codigopostal . "'";
      $objpostal = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objpostal[] = $value;
      }
      echo json_encode($objpostal);
    }
  }
