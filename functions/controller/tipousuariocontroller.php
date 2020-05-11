<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class TipoUsuario implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      $query = "SELECT * FROM tipousuario";
      $objPrivilegio = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPrivilegio['data'][] = $value;
      }
      echo json_encode($objPrivilegio,JSON_UNESCAPED_UNICODE);
    }

    public function readIdMax()
    {
      $query = "SELECT MAX(id_tipo_usuario) as 'idtipousuario' FROM tipousuario";
      $idtipousuario = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $idtipousuario = $value['idtipousuario'];
      }
      return $idtipousuario;
    }

    /*
     * Consulta para mostrar los privilegios de los usuarios por modulo
     * */
    public function readbyidmoduloprivilegio($idmoduloprivilegio)
    {
      $query = "SELECT * FROM privilegiousuario WHERE id_modulo_privilegio_usuario = " . $idmoduloprivilegio;
      $objPrivilegio = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPrivilegio[] = $value;
      }
      echo json_encode($objPrivilegio, JSON_UNESCAPED_UNICODE);
    }

    public function readmoduloprivilegio()
    {
      $query = "SELECT * FROM moduloprivilegiousuario";
      $objPrivilegio = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPrivilegio[] = $value;
      }
      echo json_encode($objPrivilegio, JSON_UNESCAPED_UNICODE);
    }

    public function inserttipousuarioprivilegio($data)
    {
      $nombretipousuario = $data['nombrerol'];
      $arrayPrivilegio = $data['arrayPrivilegio'];
      $valoresInsertarTipoUsuario = array(
        'nombretipousuario' => $nombretipousuario,
      );
      //Se Inserta en la tabla tipoUsuario el nombre del rol
      $this->insert($valoresInsertarTipoUsuario);

      $idtipousuario = $this->readIdMax();
      foreach ($arrayPrivilegio as $idprivilegio) {
        $valoresInsertar = array(
          ':idtipousuario' => $idtipousuario,
          ':idprivilegio' => $idprivilegio
        );
        //Se inserta los valores de los ID
        $sentencia = $this->conex->ejecutarAccion("INSERT INTO tipousuarioprivilegio VALUES (:idtipousuario, :idprivilegio)", $valoresInsertar);

        if($sentencia) {
          echo 'ok';
        } else {
          echo 'error';
        }
      }
    }

    public function updatetipousuarioprivilegio($data)
    {
      //para actualizar el nombre del usuario
      $this->update($data);

      $idtipousuario = $data['idtipousuario'];
      $arrayPrivilegio = $data['arrayPrivilegio'];

      //Se eliminan los registros de los privilegios según el id del tipo usuario
      $this->deleteprivilegios($idtipousuario);

      foreach ($arrayPrivilegio as $idprivilegio) {
        $valoresInsertar = array(
          ':idtipousuario' => $idtipousuario,
          ':idprivilegio' => $idprivilegio
        );
        //Se inserta los valores de los ID
        $sentencia = $this->conex->ejecutarAccion("INSERT INTO tipousuarioprivilegio VALUES (:idtipousuario, :idprivilegio)", $valoresInsertar);

        if($sentencia) {
          echo 'ok';
        } else {
          echo 'error';
        }
      }
    }

    public function delete($id)
    {
      $valoresEliminar = array(
        ':idtipousuario' => $id,
      );

      $sentencia = $this->conex->ejecutarAccion("DELETE FROM tipousuario WHERE id_tipo_usuario = $id", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function deleteprivilegios($id)
    {
      $valoresEliminar = array(
        ':idtipousuario' => $id,
      );

      $sentencia = $this->conex->ejecutarAccion("DELETE FROM tipousuarioprivilegio WHERE id_tipo_usuario = $id", $valoresEliminar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function insert($data)
    {
      $nombretipousuario = $data['nombretipousuario'];

      $valoresInsertar = array(
        ':nombretipousuario' => $nombretipousuario,
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO tipousuario VALUES (null, :nombretipousuario)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $nombretipousuario = $data['nombrerol'];
      $idtipousuario = $data['idtipousuario'];

      $valoresActualizar = array(
        ':idtipousuario' => $idtipousuario,
        ':nombretipousuario' => $nombretipousuario,
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE tipousuario SET nombre_tipo_usuario = :nombretipousuario WHERE id_tipo_usuario = :idtipousuario", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function readprivilegiobyidtipousuario($idtipousuario) {
      $query = "SELECT * FROM privilegiousuario pu
                INNER JOIN moduloprivilegiousuario mpu ON pu.id_modulo_privilegio_usuario = mpu.id_modulo_privilegio_usuario
                INNER JOIN tipousuarioprivilegio tup ON pu.id_privilegio_usuario = tup.id_privilegio_usuario 
                INNER JOIN tipousuario tu ON tup.id_tipo_usuario = tu.id_tipo_usuario 
                WHERE tu.id_tipo_usuario = " . $idtipousuario;
      $objPrivilegio = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objPrivilegio[] = $value;
      }
      echo json_encode($objPrivilegio);
    }
  }
