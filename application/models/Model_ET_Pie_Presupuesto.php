<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Pie_Presupuesto extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function PiePresupuestoPorIdET($idExpedienteTecnico)
	{
		$data=$this->db->query("select * from pie_presupuesto where id_et='".$idExpedienteTecnico."' order by orden");

		return $data->result();
	}

	function buscar($id)
	{
		$this->db->insert('PIE_PRESUPUESTO',$data);

		return $this->db->affected_rows();
	}

	function insertar($data)
	{
		$this->db->insert('PIE_PRESUPUESTO',$data);

		return $this->db->affected_rows();
	}

	function editar($id, $data)
	{
		$this->db->set($data);

		$this->db->where('id_pie_presupuesto', $id);

		$this->db->update('PIE_PRESUPUESTO');

		return $this->db->affected_rows();
	}

	function eliminar($id)
	{
		$this->db->where('id_pie_presupuesto',$id);
		$this->db->delete('PIE_PRESUPUESTO');
		return $this->db->affected_rows();
	}

}