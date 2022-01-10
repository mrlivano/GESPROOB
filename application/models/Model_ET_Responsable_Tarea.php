<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Responsable_Tarea extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idPersona, $idTareaET, $fechaAsignacionActividadET)
	{
		$this->db->query("exec sp_Gestionar_ETResponsableTarea_c @opcion='insertar', @idPersona=".$idPersona.", @idTareaET=".$idTareaET.", @fechaAsignacionActividadET='".$fechaAsignacionActividadET."'");

		return true;
	}

	public function eliminarPorIdTareaET($idTareaET)
	{
		$this->db->query("delete from ET_RESPONSABLE_TAREA where id_tarea_et=".$idTareaET);

		return true;
	}

	public function ETResponsableTareaPorIdTareaET($idTareaET)
	{
		$data=$this->db->query("select * from ET_RESPONSABLE_TAREA where id_tarea_et=".$idTareaET);

		return $data->result();
	}
}
?>