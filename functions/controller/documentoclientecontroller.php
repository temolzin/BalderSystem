<?php
  require_once 'crudinterface.php';
  require_once 'conexion.php';
  class DocumentoCliente implements Crud {
    public $conex;

    public function __construct() {
      $this->conex = Conexion::getInstance();
    }

    public function readdocumentosbyidcliente($idcliente)
    {
      $query = "select *, (select url_documento from documentocliente dc where doc.id_documento = dc.id_documento and id_cliente = $idcliente) as urldocumento,(select id_documento from documentocliente dc where doc.id_documento = dc.id_documento and id_cliente = $idcliente) as docup from documento doc
                WHERE activo = 1";
      $objDocumentoCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objDocumentoCliente["data"][] = $value;
      }
      echo json_encode($objDocumentoCliente, JSON_UNESCAPED_UNICODE);
    }

    public function read()
    {
      $query = "select * from documentocliente";
      $objDocumentoCliente = null;
      foreach ($this->conex->consultar($query) as $key => $value) {
        $objDocumentoCliente["data"][] = $value;
      }
      echo json_encode($objDocumentoCliente, JSON_UNESCAPED_UNICODE);
    }

    public function insert($data)
    {
      $iddocumento = $data['iddocumento'];
      $idcliente = $data['idcliente'];
      $idusuario = $data['idusuario'];
      $observacion = $data['observacion'];
      $urldocumento = $data['urldocumento'];

      $valoresInsertar = array(
        ':iddocumento' => $iddocumento,
        ':idcliente' => $idcliente,
        ':idusuario' => $idusuario,
        ':observacion' => $observacion,
        ':urldocumento' => $urldocumento
      );

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO documentocliente VALUES (:iddocumento, :idcliente, :idusuario, CURDATE(), :observacion, :urldocumento)", $valoresInsertar);

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

      $sentencia = $this->conex->ejecutarAccion("INSERT INTO documentocliente VALUES (:iddocumento, :idcliente, :idusuario, CURDATE(), :observacion, :urldocumento)", $valoresInsertar);

      $iddocumento = $data['iddocumento'];
      $idcliente = $data['idcliente'];
      $idusuario = $data['idusuario'];
      $observacion = $data['observacion'];
      $urldocumento = $data['urldocumento'];

      $valoresActualizar = array(
        ':iddocumento' => $iddocumento,
        ':idcliente' => $idcliente,
        ':idusuario' => $idusuario,
        ':observacion' => $observacion,
        ':urldocumento' => $urldocumento
      );

      $sentencia = $this->conex->ejecutarAccion("UPDATE documentocliente SET id_usuario = :idusuario, observacion = :observacion, url_documento = :urldocumento
                                                WHERE id_documento = :iddocumento and id_cliente = :idcliente", $valoresActualizar);

      if($sentencia) {
        echo 'ok';
      } else {
        echo 'error';
      }
    }

  }
