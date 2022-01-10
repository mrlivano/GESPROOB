<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Archivo_Obs extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idObservacionTarea, $nombreArchivo, $fechaCarga, $extArchivo)
	{
		$this->db->query("exec sp_Gestionar_ETArchivoObs_c @opcion='insertar', @idObservacionTarea=$idObservacionTarea, @nombreArchivo='$nombreArchivo', @fechaCarga='$fechaCarga', @extArchivo='$extArchivo'");

		return true;
	}

	public function ultimoETArchivoObs()
	{
		$data=$this->db->query("select * from ET_ARCHIVO_OBS where id_archivo_obs=(select max(id_archivo_obs) from ET_ARCHIVO_OBS)");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	public function ETArchivoObsPorIdObservacionTarea($idObservacionTarea)
	{
		$data=$this->db->query("select * from ET_ARCHIVO_OBS where id_observacion_tarea=$idObservacionTarea");

		return $data->result();
	}

	public function ETArchivoObs($idETArchivoObs)
	{
		$data=$this->db->query("select * from ET_ARCHIVO_OBS where id_archivo_obs=$idETArchivoObs");

		return count($data->result())==0 ? null : $data->result()[0];
	}
}