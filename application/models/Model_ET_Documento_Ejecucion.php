<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Documento_Ejecucion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idTareaET, $fechaSubidaDocumentoEjecucion, $extensionDocumentoEjecucion)
	{
		$this->db->query("exec sp_Gestionar_ETDocumentoEjecucion_c @opcion='insertar', @idTareaET=".$idTareaET.", @fechaSubidaDocumentoEjecucion='".$fechaSubidaDocumentoEjecucion."', @extensionDocumentoEjecucion='".$extensionDocumentoEjecucion."'");

		return true;
	}

	public function actualizarExtension($idDocumentoEjecucion, $extensionDocumentoEjecucion)
	{
		$this->db->query("exec sp_Gestionar_ETDocumentoEjecucion_c @opcion='editarext', @idDocumentoEjecucion=".$idDocumentoEjecucion.", @extensionDocumentoEjecucion='".$extensionDocumentoEjecucion."'");

		return true;
	}

	public function ETDocumentoEjecucionPorIdTareaET($idTareaET)
	{
		$data=$this->db->query("select * from ET_DOCUMENTO_EJECUCION where id_tarea_et=$idTareaET");

		return $data->result();
	}

	public function eliminar($idDocumentoEjecucion)
	{
		$this->db->query("delete from ET_DOCUMENTO_EJECUCION where id_doc_ejecucion=$idDocumentoEjecucion");

		return true;
	}

	public function ultimoETDocumentoEjecucion()
	{
		$data=$this->db->query("select * from ET_DOCUMENTO_EJECUCION where id_doc_ejecucion=(select max(id_doc_ejecucion) from ET_DOCUMENTO_EJECUCION)");

		return $data->result()[0];
	}

	public function ETDocumentoEjecucion($idDocumentoEjecucion)
	{
		$data=$this->db->query("select * from ET_DOCUMENTO_EJECUCION where id_doc_ejecucion=$idDocumentoEjecucion");

		return count($data->result())==0 ? null : $data->result()[0];
	}
}
?>