<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Act_Prog_Visto_Bueno extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('MO_ACT_PROG_VISTO_BUENO',$data);
		return $this->db->insert_id();
	}

	function editar($vistoBueno,$idVistoBueno)
	{
		$this->db->set($vistoBueno);
		$this->db->where('id_act_prog_visto_bueno', $idVistoBueno);
		$this->db->update('MO_ACT_PROG_VISTO_BUENO');
		return $this->db->affected_rows();
	}

	function eliminar($idVistoBueno)
	{
		$this->db->where('id_act_prog_visto_bueno',$idVistoBueno);
		$this->db->delete('MO_ACT_PROG_VISTO_BUENO');
		return $this->db->affected_rows();
	}

	function ListaObservacionProducto($idProducto)
	{
		$this->db->select('MO_ACT_PROG_VISTO_BUENO.*');
		$this->db->from('MO_ACT_PROG_VISTO_BUENO');
		$this->db->where('MO_ACT_PROG_VISTO_BUENO.id_producto',$idProducto);
		return $this->db->get()->result();
	}
	function ListaObservacionActividad($idActividad)
	{
		$this->db->select('MO_ACT_PROG_VISTO_BUENO.*');
		$this->db->from('MO_ACT_PROG_VISTO_BUENO');
		$this->db->where('MO_ACT_PROG_VISTO_BUENO.id_actividad',$idActividad);
		return $this->db->get()->result();
	}	
}