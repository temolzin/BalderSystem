<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Documento implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM documento
                WHERE activo = 1";
      $objDocumento = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objDocumento["data"][] = $value;
      }
      echo json_encode($objDocumento, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $nombre = $data['nombre'];
      $descripcion = $data['descripcion'];

      $valoresInsertar = array(
        ':nombredocumento' => $nombre,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO documento VALUES (null, :nombredocumento, :descripcion,1)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':iddocumento' => $id,
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE documento SET activo = 0 WHERE id_documento = :iddocumento", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $iddocumento = $data['iddocumento'];
      $nombre = $data['nombre'];
      $descripcion = $data['descripcion'];

      $valoresActualizar = array(
        ':iddocumento' => $iddocumento,
        ':nombredocumento' => $nombre,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE documento SET id_documento=:iddocumento,
                                                nombre_documento=:nombredocumento,descripcion=:descripcion 
                                                WHERE id_documento = :iddocumento", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
