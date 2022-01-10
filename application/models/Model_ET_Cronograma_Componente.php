<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Cronograma_Componente extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETCronogramaPorIdComponente($idComponente, $anio)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_COMPONENTE where id_componente='$idComponente' and anio='$anio'");

		return $data->result();
	}

	function ETCronogramaPorIdComponenteAndNumeroMes($idComponente, $numeroMes, $anio)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_COMPONENTE where id_componente='$idComponente' and numero_mes='$numeroMes' and anio='$anio'");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function insertar($data)
	{
		$this->db->insert('ET_CRONOGRAMA_COMPONENTE',$data);

		return $this->db->affected_rows();
	}

	function editar($id_cronograma, $data)
	{
		$this->db->set($data);

		$this->db->where('id_cronograma_componente', $id_cronograma);

		$this->db->update('ET_CRONOGRAMA_COMPONENTE');
		
		return $this->db->affected_rows();
	}
}