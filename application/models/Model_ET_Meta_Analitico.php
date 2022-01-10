<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Meta_Analitico extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETClasificadorPorMeta($idMeta)
	{
		$data=$this->db->query("select * from et_meta_analitico where id_meta='$idMeta'");		
		return $data->result();
	}

	function insertar($data)
	{
		$this->db->insert('et_meta_analitico',$data);
		return $this->db->insert_id();
	}

	function ClasificadorPorMeta($idMeta)
	{
		$data=$this->db->query("select * from et_meta_analitico ma inner join ET_PRESUPUESTO_ANALITICO pa on ma.id_analitico=pa.id_analitico inner join ET_CLASIFICADOR c on pa.id_clasificador=c.id_clasificador where id_meta='$idMeta'");		
		return $data->result();
	}

	function eliminar($idAnalisis)
	{
		$this->db->where('id_meta_analitico', $idAnalisis);
		$this->db->delete('ET_META_ANALITICO');
		return $this->db->affected_rows();
	}
}