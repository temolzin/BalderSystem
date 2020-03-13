<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Pension implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                WHERE t.activo = 1";
      $objPension = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPension["data"][] = $value;
      }
      echo json_encode($objPension, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $idconceptotransaccion = $data['idconceptotransaccion'];
      $idusuario = $data['idusuario'];
      $idcliente = $data['idcliente'];
      $monto = $data['monto'];
      $descripcion = $data['descripcion'];

      $valoresInsertar = array(
        ':idconceptotransaccion' => $idconceptotransaccion,
        ':idusuario' => $idusuario,
        ':idcliente' => $idcliente,
        ':monto' => $monto,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO transaccion VALUES (null, :idconceptotransaccion, :idusuario, :idcliente, :monto, NOW(),:descripcion, 1)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':idtransaccion' => $id,
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE transaccion SET activo = 0 WHERE id_transaccion = :idtransaccion", $valoresEliminar);

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
