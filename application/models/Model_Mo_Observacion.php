<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Observacion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($observacion)
	{
		$this->db->insert('MO_OBSERVACION',$observacion);
		return $this->db->insert_id();
	}

	function editar($observacion,$idObservacion)
	{
		$this->db->set($observacion);
		$this->db->where('id_observacion',$idObservacion);
		$this->db->update('MO_OBSERVACION');
		return $this->db->affected_rows();
	}

	function eliminar($idObservacion)
	{
		$this->db->where('id_observacion',$idObservacion);
		$this->db->delete('MO_OBSERVACION');
		return $this->db->affected_rows();
	}

	function listaObservacion($idMonitoreo)
	{
		$this->db->select('MO_OBSERVACION.*');
		$this->db->from('MO_OBSERVACION');
		$this->db->where('MO_OBSERVACION.id_monitoreo',$idMonitoreo);
		return $this->db->get()->result();
	}
}