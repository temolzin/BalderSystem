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

    public function readbyidcliente($idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                WHERE t.activo = 1 and t.id_cliente = " .$idcliente;
      $objPension = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPension["data"][] = $value;
      }
      echo json_encode($objPension, JSON_UNESCAPED_UNICODE);
    }

    public function readbyidclientearray($idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                WHERE t.activo = 1 and t.id_cliente = " .$idcliente;
      $objPension = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPension[] = $value;
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
      $idtransaccion = $data['idtransaccion'];
      $idconceptotransaccion = $data['idconceptotransaccion'];
      $idusuario = $data['idusuario'];
      $idcliente = $data['idcliente'];
      $monto = $data['monto'];
      $descripcion = $data['descripcion'];

      $valoresActualizar = array(
        ':idtransaccion' => $idtransaccion,
        ':idconceptotransaccion' => $idconceptotransaccion,
        ':idusuario' => $idusuario,
        ':idcliente' => $idcliente,
        ':monto' => $monto,
        ':descripcion' => $descripcion
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE transaccion SET  id_concepto_transaccion=:idconceptotransaccion,id_usuario=:idusuario,id_cliente=:idcliente,
                                                monto=:monto,fecha_registro=NOW(),descripcion=:descripcion  WHERE id_transaccion = :idtransaccion", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
