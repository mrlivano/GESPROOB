<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Ejecucion_Actividad extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('MO_EJECUCION_ACTIVIDAD',$data);
		return $this->db->insert_id();
	}

	function listaEjecucionActividad($idActividad)
	{
		$this->db->select('MO_EJECUCION_ACTIVIDAD.*');
		$this->db->from('MO_EJECUCION_ACTIVIDAD');
		$this->db->where('MO_EJECUCION_ACTIVIDAD.id_actividad',$idActividad);
		return $this->db->get()->result();
	}

	function verprogramacion($id_ejecucion)
	{
		$this->db->select('MO_EJECUCION_ACTIVIDAD.*');
		$this->db->from('MO_EJECUCION_ACTIVIDAD');
		$this->db->where('MO_EJECUCION_ACTIVIDAD.id_ejecucion',$id_ejecucion);
		return $this->db->get()->result()[0];
	} 

	function eliminar($idEjecucion)
	{
		$this->db->where('id_ejecucion',$idEjecucion);
		$this->db->delete('MO_EJECUCION_ACTIVIDAD');
		return $this->db->affected_rows();
	}

	function ejecucionMensual($idActividad, $mes, $anio)
	{
		$query = $this->db->query("select sum(ejec_fisic_real) as metames, sum(ejec_finan_real) as montomes from MO_EJECUCION_ACTIVIDAD where id_actividad = $idActividad and Datepart(mm,fecha_ejec) = '$mes' and Datepart(yy,fecha_ejec) = '$anio'");
		return  $query->result()[0];
	}

	function ejecucionAcumulado($idActividad)
	{
		$query = $this->db->query("select sum(ejec_fisic_real) as metaacumulado, sum(ejec_finan_real) as montoacumulado from MO_EJECUCION_ACTIVIDAD where id_actividad = $idActividad");
		return  $query->result()[0];
	}
}