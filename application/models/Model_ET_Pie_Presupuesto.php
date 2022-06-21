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




	function insertarComponente($data)
	{
		$this->db->insert('ET_COMPONENTE',$data);

		return $this->db->insert_id();
	}

	function insert($data)
	{
		$this->db->insert('ET_COMPONENTE',$data);

		return $this->db->affected_rows();
	}

	function editar($idComponente, $data)
	{
		$this->db->set($data);

		$this->db->where('id_componente', $idComponente);

		$this->db->update('ET_COMPONENTE');

		return $this->db->affected_rows();
	}

}