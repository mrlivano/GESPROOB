<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Periodo_Ejecucion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function listaPlazoEjecucion($id_Et)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et=$id_Et order by estado desc,fecha_fin desc");
		return  $query->result();
	}

	function plazoEjecucion($idExpedienteTecnico, $tipo)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et=$idExpedienteTecnico and tipo='$tipo' order by fecha_inicio asc ");
		
		return  $query->result();
	}

	function insertar($data)
	{
		$this->db->insert('ET_TIEMPO_EJECUCION',$data);
		return $this->db->affected_rows();
	}

	function editarEstado($data,$idET)
	{
		$this->db->set($data);
		$this->db->where('id_et', $idET);
		$this->db->update('ET_TIEMPO_EJECUCION');
		return $this->db->affected_rows();
	}

	function plazoPorDescripcion($idEt, $descripcion)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et='$idEt' and tipo='$descripcion' order by fecha_inicio");
		
		return  $query->result();
	}
}