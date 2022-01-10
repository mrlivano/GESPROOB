<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Archivo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idETComentario, $nombreArchivo, $fechaCarga, $extArchivo)
	{
		$this->db->query("exec sp_Gestionar_ETArchivo_c @opcion='insertar', @idETComentario=$idETComentario, @nombreArchivo='$nombreArchivo', @fechaCarga='$fechaCarga', @extArchivo='$extArchivo'");

		return true;
	}

	public function ultimoETArchivo()
	{
		$data=$this->db->query("select * from ET_ARCHIVO where id_et_archivo=(select max(id_et_archivo) from ET_ARCHIVO)");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	public function ETArchivoPorIdETComentario($idETComentario)
	{
		$data=$this->db->query("select * from ET_ARCHIVO where id_et_comentario=$idETComentario");

		return $data->result();
	}

	public function ETArchivo($idETArchivo)
	{
		$data=$this->db->query("select * from ET_ARCHIVO where id_et_archivo=$idETArchivo");

		return count($data->result())==0 ? null : $data->result()[0];
	}
}