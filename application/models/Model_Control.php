<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Control extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('control_acceso',$data);
		return $this->db->affected_rows();
	}

	function editar($data,$idControlAcceso)
	{
		$this->db->set($data);
		$this->db->where('id_control_acceso', $idControlAcceso);
		$this->db->update('control_acceso');
		return $this->db->affected_rows();
	}

	function eliminar($idControlAcceso)
	{
		$this->db->where('id_control_acceso',$idControlAcceso);
		$this->db->delete('control_acceso');
		return $this->db->affected_rows();
	}

	function getAll()
	{
		$this->db->select('control_acceso.*');
		$this->db->from('control_acceso');
		return $this->db->get()->result();
	}

	function getControlAcceso($idControlAcceso)
	{
		$this->db->select('control_acceso.*');
		$this->db->where('id_control_acceso',$idControlAcceso);
		$this->db->from('control_acceso');
		return $this->db->get()->result()[0];
	}

	function verificarControlPorAnio($anio)
	{
		$this->db->select('control_acceso.*');
		$this->db->where('anio',$anio);
		$this->db->from('control_acceso');
		return $this->db->get()->result();
	}
}