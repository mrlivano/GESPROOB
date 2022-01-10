<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Tarea_Gantt extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idExpedienteTecnico, $tareaDiasLaborables)
	{
		$this->db->query("exec sp_Gestionar_ETTareaGantt_c @opcion='insertar', @idExpedienteTecnico=$idExpedienteTecnico, @tareaDiasLaborables=$tareaDiasLaborables");

		return true;
	}

	public function ETTareaGanttPorIdET($idExpedienteTecnico)
	{
		$data=$this->db->query("select * from ET_TAREA_GANTT where id_et=$idExpedienteTecnico");

		return $data->result();
	}
}
?>