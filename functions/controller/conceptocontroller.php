<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Concepto implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM conceptotransaccion ct INNER JOIN modulo m ON ct.id_modulo = m.id_modulo 
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion WHERE ct.activo = 1";
      $objConcepto = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objConcepto[] = $value;
      }
      echo json_encode($objConcepto, JSON_UNESCAPED_UNICODE);
    }

    public function readbyidmodulo($idmodulo)
    {
      $query = "SELECT * FROM conceptotransaccion ct INNER JOIN modulo m ON ct.id_modulo = m.id_modulo 
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion 
                WHERE ct.activo = 1 and ct.id_modulo = " . $idmodulo;
      $objConcepto = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objConcepto[] = $value;
      }
      echo json_encode($objConcepto, JSON_UNESCAPED_UNICODE);
    }

    public function readbyidconcepto($idconcepto)
    {
      $query = "SELECT * FROM conceptotransaccion ct INNER JOIN modulo m ON ct.id_modulo = m.id_modulo 
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion 
                WHERE ct.activo = 1 and ct.id_concepto_transaccion = " . $idconcepto;
      $objConcepto = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objConcepto = $value;
      }
      echo json_encode($objConcepto, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $idmodulo = $data['idmodulo'];
      $idtipoconceptotransaccion = $data['idtipoconceptotransaccion'];
      $nombre = $data['nombre'];
      $descripcion = $data['descripcion'];

      $valoresInsertar = array(
        ':idmodulo' => $idmodulo,
        ':idtipoconceptotransaccion' => $idtipoconceptotransaccion,
        ':nombreconcepto' => $nombre,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO conceptotransaccion VALUES (null, :idtipoconceptotransaccion, :idmodulo, :nombreconcepto, :descripcion,1)", $valoresInsertar);

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
      $sentencia = $this->conex->ejecutarAccion("UPDATE conceptotransaccion SET activo = 0 WHERE id_concepto = :idconcepto", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $idconcepto = $data['idconcepto'];
      $idtipoconcepto = $data['idtipoconceptotransaccion'];
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

      $sentencia = $this->conex->ejecutarAccion("UPDATE conceptotransaccion SET id_tipo_concepto_transaccion=:idtipoconcepto,
                                                id_modulo = :idmodulo, nombre_concepto_transaccion=:nombreconcepto,descripcion=:descripcion 
                                                WHERE id_concepto_transaccion = :idconcepto", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
