<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class PEnsion implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM transaccion ct INNER JOIN modulo m ON ct.id_modulo = m.id_modulo 
                INNER JOIN tipotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion WHERE ct.activo = 1";
      $objPension = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPension["data"][] = $value;
      }
      echo json_encode($objPension, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $idmodulo = $data['idmodulo'];
      $idtipotransaccion = $data['idtipotransaccion'];
      $nombre = $data['nombre'];
      $descripcion = $data['descripcion'];

      $valoresInsertar = array(
        ':idmodulo' => $idmodulo,
        ':idtipotransaccion' => $idtipotransaccion,
        ':nombreconcepto' => $nombre,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO transaccion VALUES (null, :idtipotransaccion, :idmodulo, :nombreconcepto, :descripcion,1)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':idconcepto' => $id,
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE transaccion SET activo = 0 WHERE id_concepto = :idconcepto", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $idconcepto = $data['idconcepto'];
      $idtipoconcepto = $data['idtipotransaccion'];
      $idmodulo = $data['idmodulo'];
      $nombre = $data['nombre'];
      $descripcion = $data['descripcion'];

      $valoresActualizar = array(
        ':idconcepto' => $idconcepto,
        ':idtipoconcepto' => $idtipoconcepto,
        ':idmodulo' => $idmodulo,
        ':nombreconcepto' => $nombre,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE transaccion SET id_tipo_concepto_transaccion=:idtipoconcepto,
                                                id_modulo = :idmodulo, nombre_concepto_transaccion=:nombreconcepto,descripcion=:descripcion 
                                                WHERE id_concepto_transaccion = :idconcepto", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
