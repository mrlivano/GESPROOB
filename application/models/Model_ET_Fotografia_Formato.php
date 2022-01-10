<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Fotografia_Formato extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($data)
	{
		$this->db->insert('ET_FOTOGRAFIA_FORMATO',$data);

 		return $this->db->insert_id();
	}
	
	public function eliminar($idFotografia)
	{
		$this->db->where('id_fotografia', $idFotografia);

		$this->db->delete('ET_FOTOGRAFIA_FORMATO');

		return $this->db->affected_rows();
	}

	function listaFotografia($idDetalleFormato)
	{
		$data=$this->db->query("select * from ET_FOTOGRAFIA_FORMATO where id_detalle='".$idDetalleFormato."'");

        return $data->result();
	}
}