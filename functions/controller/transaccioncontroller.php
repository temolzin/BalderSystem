<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Transaccion implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    //Metoodo que regresa las transacciones hechas en el módulo consultado
    public function readbyidmodulo($idmodulo)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 and m.id_modulo = " . $idmodulo;
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion["data"][] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    public function read()
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1";
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion["data"][] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    //Metodo que regresa las últimas transacciones limitadas por el parámetro LIMITE y el id del modulo.
    public function readbyidmoduloandlimit($idmodulo, $limite)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 and m.id_modulo = $idmodulo ORDER BY t.id_transaccion DESC LIMIT " . $limite;
      $objTransaccion = null;

      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion[] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    public function readbyidmoduloandidcliente($idmodulo, $idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 and  m.id_modulo = $idmodulo and t.id_cliente = " .$idcliente;
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion["data"][] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    public function readbyidcliente($idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 and t.id_cliente = " .$idcliente;
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion["data"][] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }
    //Metodo que regresa el objeto del cliente para ver el perfil del cliente por idmodulo y idcliente
    public function readbyidmoduloandidclientejson($idmodulo, $idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 and m.id_modulo = $idmodulo and t.id_cliente = " .$idcliente;
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion[] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    //Metodo que regresa el objeto del cliente y sus tranasacciones para sacar el reporte de Estado de Cuenta
    public function readbyidmoduloandidclientearray($idmodulo, $idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                INNER JOIN postal po ON cl.id_postal = po.id
                WHERE t.activo = 1 and m.id_modulo = $idmodulo and t.id_cliente = " .$idcliente;
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion[] = $value;
      }
      return $objTransaccion;
    }

    //Metodo que regresa el objeto del cliente para ver el perfil del cliente
    public function readbyidclientearray($idcliente)
    {
      $query = "SELECT * FROM transaccion t INNER JOIN usuario u ON t.id_usuario = u.id_usuario 
                INNER JOIN cliente cl ON t.id_cliente = cl.id_cliente
                INNER JOIN conceptotransaccion ct ON t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN tipoconceptotransaccion tct ON ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                WHERE t.activo = 1 AND t.id_cliente = $idcliente";
      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion[] = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }

    /*
     * Método que devuelve las transacciones hechas o recibidas por MES y por idmodulo
     * */
    public function readbyidmoduloandidtipoconcepto($idmodulo, $idtipoconcepto)
    {
      $query = "SELECT 
              SUM(IF(MONTH(fecha_registro)=1,monto,0)) As 'Enero',
              SUM(IF(MONTH(fecha_registro)=2,monto,0)) As 'Febrero',
              SUM(IF(MONTH(fecha_registro)=3,monto,0)) As 'Marzo',
              SUM(IF(MONTH(fecha_registro)=4,monto,0)) As 'Abril',
              SUM(IF(MONTH(fecha_registro)=5,monto,0)) As 'Mayo',
              SUM(IF(MONTH(fecha_registro)=6,monto,0)) As 'Junio',
              SUM(IF(MONTH(fecha_registro)=7,monto,0)) As 'Julio',
              SUM(IF(MONTH(fecha_registro)=8,monto,0)) As 'Agosto',
              SUM(IF(MONTH(fecha_registro)=9,monto,0)) As 'Septiembre',
              SUM(IF(MONTH(fecha_registro)=10,monto,0)) As 'Octubre',
              SUM(IF(MONTH(fecha_registro)=11,monto,0)) As 'Noviembre',
              SUM(IF(MONTH(fecha_registro)=12,monto,0)) As 'Diciembre'
                FROM transaccion t 
                INNER JOIN conceptotransaccion ct ON 
                t.id_concepto_transaccion = ct.id_concepto_transaccion
                INNER JOIN modulo m ON ct.id_modulo = m.id_modulo
                INNER JOIN tipoconceptotransaccion tct ON
                ct.id_tipo_concepto_transaccion = tct.id_tipo_concepto_transaccion 
                WHERE m.id_modulo = $idmodulo AND ct.id_tipo_concepto_transaccion = $idtipoconcepto";

      $objTransaccion = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objTransaccion = $value;
      }
      echo json_encode($objTransaccion, JSON_UNESCAPED_UNICODE);
    }


    public function insert($data)
    {
      $idconceptotransaccion = $data['idconceptotransaccion'];
      $idmodulo = $data['idmodulo'];
      $idusuario = $data['idusuario'];
      $idcliente = $data['idcliente'];
      $monto = $data['monto'];
      $descripcion = $data['descripcion'];

      $valoresInsertar = array(
        ':idconceptotransaccion' => $idconceptotransaccion,
        ':idmodulo' => $idmodulo,
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
