<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Programacion_Actividad extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('mo_actividad_programacion',$data);
		return $this->db->insert_id();
	}

	function editar($programacion,$idProgramacion)
	{
		$this->db->set($programacion);
		$this->db->where('id_actividad_programacion', $idProgramacion);
		$this->db->update('mo_actividad_programacion');
		return $this->db->affected_rows();
	}

	function eliminar($idProgramacion)
	{
		$this->db->where('id_actividad_programacion',$idProgramacion);
		$this->db->delete('mo_actividad_programacion');
		return $this->db->affected_rows();
	}

	function listaProgramacionActividad($idActividad)
	{
		$this->db->select('mo_actividad_programacion.*');
		$this->db->from('mo_actividad_programacion');
		$this->db->where('mo_actividad_programacion.id_actividad',$idActividad);
		return $this->db->get()->result();
	}

	function verprogramacion($idProgramacion)
	{
		$this->db->select('mo_actividad_programacion.*');
		$this->db->from('mo_actividad_programacion');
		$this->db->where('mo_actividad_programacion.id_actividad_programacion',$idProgramacion);
		return $this->db->get()->result()[0];
	}

	function verificarProgramacion($fecha,$idActividad)
	{
		$this->db->select('mo_actividad_programacion.*');
		$this->db->from('mo_actividad_programacion');
		$this->db->where('mo_actividad_programacion.fecha_programacion',$fecha);
		$this->db->where('mo_actividad_programacion.id_actividad',$idActividad);
		return $this->db->get()->result();
	}

	function verificarProgramacionDiferente($fecha,$idActividad,$idProgramacion)
	{
		$this->db->select('mo_actividad_programacion.*');
		$this->db->from('mo_actividad_programacion');
		$this->db->where('mo_actividad_programacion.fecha_programacion',$fecha);
		$this->db->where('mo_actividad_programacion.id_actividad',$idActividad);
		$this->db->where('mo_actividad_programacion.id_actividad_programacion !=',$idProgramacion);
		return $this->db->get()->result();
	}

	function EjecucionAcumulado($idActividad)
	{
		$data = $this->db->query("select sum(cantidad_ejecucion_programada) as metaacumulado, sum(ejec_finan_programada) as montoacumulado from mo_actividad_programacion where id_actividad = $idActividad");
		return $data->result()[0];
	}
}