<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Compromiso extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('MO_COMPROMISO',$data);
		return $this->db->insert_id();
	}

	function editar($data, $idCompromiso)
	{
		$this->db->set($data);
		$this->db->where('id_compromiso', $idCompromiso);
		$this->db->update('MO_COMPROMISO');
		return $this->db->affected_rows();
	}

	function eliminar($idCompromiso)
	{
		$this->db->where('id_compromiso', $idCompromiso);
		$this->db->delete('MO_COMPROMISO');
		return $this->db->affected_rows();
	}

	function listaCompromiso($idMonitoreo)
	{
		$this->db->select('MO_COMPROMISO.*');
		$this->db->from('MO_COMPROMISO');
		$this->db->where('MO_COMPROMISO.id_monitoreo',$idMonitoreo);
		return $this->db->get()->result();
	}
}