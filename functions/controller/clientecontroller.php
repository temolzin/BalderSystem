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
      $query = "SELECT * FROM cliente";
      $objCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objCliente[] = $value;
      }
      echo $objCliente;
    }

    public function insert($data)
    {
      $imagen = $_FILES["imagen"];
      $nombreImagen = $imagen["name"];
      $tipoImagen = $imagen["type"];
      $carpetaImagen = "../../img/images/";
      $ruta_provisional = $imagen["tmp_name"];

      if ($tipoImagen != 'image/jpg' && $tipoImagen != 'image/jpeg' && $tipoImagen != 'image/png' && $tipoImagen != 'image/gif')       {
        echo 'El archivo no es una imagen';
      }
      else {
        copy($ruta_provisional, $carpetaImagen.$nombreImagen);
      }

      $idpostal = $data['idpostal'];
      $idbanco = $data['idbanco'];
      $idgenero = $data['idgenero'];
      $nombre = $data['nombre'];
      $apPat = $data['apPat'];
      $apMat = $data['apMat'];
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
        ':imagen' => $nombreImagen,
        ':calle' => $calle,
        ':noexterior' => $noexterior,
        ':nointerior' => $nointerior,
        ':nss' => $nss,
        ':altaimss' => $altaimss,
        ':bajaimss' => $bajaimss,
        ':observacion' => $observacion
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO cliente(id_cliente, id_postal, id_institucion_bancaria, id_genero, 
                            nombre_cliente, ap_pat, ap_mat, rfc, curp, fecha_nacimiento, estado_nacimiento, clabe, email, 
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

    public function delete($data)
    {
      // TODO: Implement delete() method.
    }

    public function update($id)
    {
      // TODO: Implement update() method.
    }

  }
