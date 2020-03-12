<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class Usuario implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function read()
    {
      session_start();
      $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario where username not in ('temolzin','" . $_SESSION['user']['username'] . "') and activo = 1";
      $objUsuario = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objUsuario['data'][] = $value;
      }
      echo json_encode($objUsuario, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $imagen = $data['imagen'];
      $idtipousuario = $data['idtipousuario'];
      $nombre = $data['nombre'];
      $apPat = $data['appat'];
      $apMat = $data['apmat'];
      $email = $data['email'];
      $telefono = $data['telefono'];
      $username = $data['username'];
      $password = $data['password'];

      $valoresInsertar = array(
        ':idtipousuario' => $idtipousuario,
        ':nombrecliente' => $nombre,
        ':appat' => $apPat,
        ':apmat' => $apMat,
        ':email' => $email,
        ':telefono' => $telefono,
        ':imagen' => $imagen,
        ':username' => $username,
        ':password' => $password
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO usuario(id_tipo_usuario, username, password, nombre, 
                                                ap_pat, ap_mat, email, telefono, imagen, activo) VALUES (
                                                :idtipousuario,:username,:password,:nombrecliente,:appat,:apmat,:email,:telefono,:imagen,1)", $valoresInsertar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function delete($id)
    {
      $valoresActualizar = array(
        ":idusuario" => $id
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE usuario SET activo = 0 WHERE id_usuario = :idusuario", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function update($data)
    {
      $idtipousuario = $data['idtipousuario'];
      $idusuario = $data['idusuario'];
      $nombre = $data['nombre'];
      $apPat = $data['appat'];
      $apMat = $data['apmat'];
      $email = $data['email'];
      $telefono = $data['telefono'];
      $username = $data['username'];
      $password = $data['password'];

      $valoresActualizar = array(
        ':idtipousuario' => $idtipousuario,
        ':idusuario' => $idusuario,
        ':nombre' => $nombre,
        ':appat' => $apPat,
        ':apmat' => $apMat,
        ':email' => $email,
        ':telefono' => $telefono,
        ':username' => $username,
        ':password' => $password
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE usuario SET id_tipo_usuario=:idtipousuario,username=:username,password=:password,
                                                        nombre=:nombre,ap_pat=:appat,ap_mat=:apmat,email=:email,telefono=:telefono 
                                                        WHERE id_usuario = :idusuario", $valoresActualizar);

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
        ":idusuario" => $data['idusuario']
      );
      $sentencia = $this->conex->ejecutarAccion("UPDATE usuario SET imagen = :imagen WHERE id_usuario = :idusuario", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    /*
     * Método para iniciar sesión
     */
    public function readbyidandpass($id, $pass) {
      session_start();
      $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario WHERE username = '" . $id . "' and password = '" . $pass ."'";

      foreach ($this->conex->consultar($query) as $key => $value) {
        $_SESSION['user'] = $value;
      }
      //Se agregan la sesión al ingresar datos correctos
      $_SESSION['user']['nombrecompleto'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'] . " " . $_SESSION['user']['ap_mat'];
      $_SESSION['user']['nombremedio'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'];
      echo 'ok';
    }

    /*
     * Método para ver si el usuario existe en la base de datos
     */
    public function readByUserName($username)
    {
      $query = "SELECT * FROM usuario where username = '" . $username . "'";
      $objUsuario = null;
      if($this->conex->consultar($query)) {
        echo "false";
      } else {
        echo "true";
      }
    }

    /*
 * Método para ActualizarPerfil
 */
    public function readbyid($id) {
      session_start();
      $query = "SELECT * FROM usuario u INNER JOIN tipousuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario WHERE id_usuario = '" . $id . "'";

      foreach ($this->conex->consultar($query) as $key => $value) {
        $_SESSION['user'] = $value;
      }
      //Se agregan la sesión al ingresar datos correctos
      $_SESSION['user']['nombrecompleto'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'] . " " . $_SESSION['user']['ap_mat'];
      $_SESSION['user']['nombremedio'] = $_SESSION['user']['nombre'] . " " . $_SESSION['user']['ap_pat'];
    }

  }
