<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Tarea_Observacion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idTareaET, $descripcionObservacion, $descripcionLevantamientoObservacion, $fechaObservacion, $fechaLevantamientoObservacion, $estadoObservacion)
	{
		$this->db->query("exec sp_Gestionar_ETTareaObservacion_c @opcion='insertar', @idTareaET=".$idTareaET.", @descTObservacion='".$descripcionObservacion."', @levantamientoTObservacion='".$descripcionLevantamientoObservacion."', @fechaTObservacion='".$fechaObservacion."', @fechaLevTObservacion='".$fechaLevantamientoObservacion."', @estadoTObsevacion=".$estadoObservacion);

		return true;
	}

	public function ETTareaObservacionPorIdTareaET($idTareaET)
	{
		$data=$this->db->query("select * from ET_TAREA_OBSERVACION where id_tarea_et=".$idTareaET);

		return $data->result();
	}

	public function eliminar($idTareaObservacion)
	{
		$this->db->query("delete from ET_TAREA_OBSERVACION where id_tarea_observacion=".$idTareaObservacion);

		return true;
	}

	public function levantarObservacion($idTareaObservacion, $descripcionLevantamientoObservacion, $fechaLevantamientoObservacion, $estadoObservacion)
	{
		$this->db->query("exec sp_Gestionar_ETTareaObservacion_c @opcion='levantamientoobs', @idTareaObservacion=".$idTareaObservacion.", @levantamientoTObservacion='".$descripcionLevantamientoObservacion."', @fechaLevTObservacion='".$fechaLevantamientoObservacion."', @estadoTObsevacion=".$estadoObservacion);

		return true;
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_tarea_observacion) as idTareaObservacion from ET_TAREA_OBSERVACION");

		return $data->result()[0]->idTareaObservacion;
	}
}
?>