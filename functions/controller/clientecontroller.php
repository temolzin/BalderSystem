<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Cliente implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM cliente c 
                INNER JOIN postal p on c.id_postal = p.id 
                INNER JOIN institucionbancaria ib on c.id_institucion_bancaria = ib.id_institucion_bancaria
                INNER JOIN genero g on c.id_genero = g.id_genero
                WHERE activo = 1";
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente["data"][] = $value;
      }
      echo json_encode($objCliente, JSON_UNESCAPED_UNICODE);
    }

    public function readarray()
    {
      $query = "SELECT * FROM cliente c 
                INNER JOIN postal p on c.id_postal = p.id 
                INNER JOIN institucionbancaria ib on c.id_institucion_bancaria = ib.id_institucion_bancaria
                INNER JOIN genero g on c.id_genero = g.id_genero
                WHERE activo = 1";
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente[] = $value;
      }
      echo json_encode($objCliente, JSON_UNESCAPED_UNICODE);
    }

    public function readbyid($idcliente)
    {
      $query = "SELECT * FROM cliente c 
                INNER JOIN postal p on c.id_postal = p.id 
                INNER JOIN institucionbancaria ib on c.id_institucion_bancaria = ib.id_institucion_bancaria
                INNER JOIN genero g on c.id_genero = g.id_genero
                WHERE activo = 1 and id_cliente = ".$idcliente;
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente = $value;
      }
      echo json_encode($objCliente, JSON_UNESCAPED_UNICODE);
    }
    public function readbyidarray($idcliente)
    {
      $query = "SELECT * FROM cliente c 
                INNER JOIN postal p on c.id_postal = p.id 
                INNER JOIN institucionbancaria ib on c.id_institucion_bancaria = ib.id_institucion_bancaria
                INNER JOIN genero g on c.id_genero = g.id_genero
                WHERE activo = 1 and id_cliente = ".$idcliente;
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente[] = $value;
      }
      return $objCliente;
    }
    /*
     * Método para devolver a los últimos clientes registrados límitados por la variable LIMITE
     * */
    public function readbylimit($limite)
    {
      $query = "SELECT * FROM cliente c 
                INNER JOIN postal p on c.id_postal = p.id 
                INNER JOIN institucionbancaria ib on c.id_institucion_bancaria = ib.id_institucion_bancaria
                INNER JOIN genero g on c.id_genero = g.id_genero
                WHERE activo = 1 ORDER BY c.id_cliente DESC LIMIT " . $limite;
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente[] = $value;
      }
      echo json_encode($objCliente, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $imagen = $data['imagen'];
      $idpostal = $data['idpostal'];
      $idbanco = $data['idbanco'];
      $idgenero = $data['idgenero'];
      $nombre = $data['nombre'];
      $apPat = $data['appat'];
      $apMat = $data['apmat'];
      $rfc = $data['rfc'];
      $curp = $data['curp'];
      $fechanacimiento = $data['fechanacimiento'];
      $estadonacimiento = $data['estadonacimiento'];
      $clabe = $data['clabe'];
      $email = $data['email'];
      $telefono = $data['telefono'];
      $calle = $data['calle'];
      $noexterior = $data['noexterior'];
      $nointerior = $data['nointerior'];
      $nss = $data['nss'];
      $altaimss = $data['altaimss'];
      $bajaimss = $data['bajaimss'];
      $observacion = $data['observacion'];

      $valoresInsertar = array(
        ':idpostal' => $idpostal,
        ':idinstitucionbancaria' => $idbanco,
        ':idgenero' => $idgenero,
        ':nombrecliente' => $nombre,
        ':appat' => $apPat,
        ':apmat' => $apMat,
        ':rfc' => $rfc,
        ':curp' => $curp,
        ':fechanacimiento' => $fechanacimiento,
        ':estadonacimiento' => $estadonacimiento,
        ':clabe' => $clabe,
        ':email' => $email,
        ':telefono' => $telefono,
        ':imagen' => $imagen,
        ':calle' => $calle,
        ':noexterior' => $noexterior,
        ':nointerior' => $nointerior,
        ':nss' => $nss,
        ':altaimss' => $altaimss,
        ':bajaimss' => $bajaimss,
        ':observacion' => $observacion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO cliente(id_cliente, id_postal, id_institucion_bancaria, id_genero, 
                            nombre_cliente, ap_pat, ap_mat, rfc, curp, fecha_nacimiento, estado_nacimiento, clabe_interbancaria, email, 
                            telefono, imagen, calle, noexterior, nointerior, nss, alta_imss, baja_imss, observacion, activo) 
                            VALUES 
                            (null,:idpostal,:idinstitucionbancaria, :idgenero, :nombrecliente,:appat,:apmat,:rfc,:curp,:fechanacimiento,:estadonacimiento,:clabe,:email,:telefono,
                            :imagen,:calle,:noexterior,:nointerior,:nss,:altaimss,:bajaimss,:observacion, true)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':idcliente' => $id,
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE cliente SET activo = 0 WHERE id_cliente = :idcliente", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $idpostal = $data['idpostal'];
      $idbanco = $data['idbanco'];
      $idgenero = $data['idgenero'];
      $nombre = $data['nombre'];
      $apPat = $data['appat'];
      $apMat = $data['apmat'];
      $rfc = $data['rfc'];
      $curp = $data['curp'];
      $fechanacimiento = $data['fechanacimiento'];
      $estadonacimiento = $data['estadonacimiento'];
      $clabe = $data['clabe'];
      $email = $data['email'];
      $telefono = $data['telefono'];
      $calle = $data['calle'];
      $noexterior = $data['noexterior'];
      $nointerior = $data['nointerior'];
      $nss = $data['nss'];
      $altaimss = $data['altaimss'];
      $bajaimss = $data['bajaimss'];
      $observacion = $data['observacion'];
      $idcliente = $data['idcliente'];

      $valoresActualizar = array(
        ':idcliente' => $idcliente,
        ':idpostal' => $idpostal,
        ':idinstitucionbancaria' => $idbanco,
        ':idgenero' => $idgenero,
        ':nombrecliente' => $nombre,
        ':appat' => $apPat,
        ':apmat' => $apMat,
        ':rfc' => $rfc,
        ':curp' => $curp,
        ':fechanacimiento' => $fechanacimiento,
        ':estadonacimiento' => $estadonacimiento,
        ':clabe' => $clabe,
        ':email' => $email,
        ':telefono' => $telefono,
        ':calle' => $calle,
        ':noexterior' => $noexterior,
        ':nointerior' => $nointerior,
        ':nss' => $nss,
        ':altaimss' => $altaimss,
        ':bajaimss' => $bajaimss,
        ':observacion' => $observacion
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE cliente SET id_cliente=:idcliente,id_postal=:idpostal,
                                                id_institucion_bancaria=:idinstitucionbancaria,id_genero=:idgenero,nombre_cliente=:nombrecliente,
                                                ap_pat=:appat,ap_mat=:apmat,rfc=:rfc,curp=:curp,fecha_nacimiento=:fechanacimiento,estado_nacimiento=:estadonacimiento,
                                                email=:email,telefono=:telefono,calle=:calle,noexterior=:noexterior,nointerior=:nointerior,nss=:nss,alta_imss=:altaimss,
                                                baja_imss=:bajaimss,clabe_interbancaria=:clabe,observacion=:observacion WHERE id_cliente = :idcliente", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function updateimagen($data)
    {
      $imagen = $data['imagen'];
      $valoresActualizar = array(
        ":imagen" => $imagen,
        ":idcliente" => $data['idcliente']
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE cliente SET imagen = :imagen WHERE id_cliente = :idcliente", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
