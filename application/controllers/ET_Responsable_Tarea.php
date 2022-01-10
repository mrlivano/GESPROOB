<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Responsable_Tarea extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Model_ET_Responsable_Tarea");
	}

	public function asignar()
	{
		$this->db->trans_start();

		$idPersona=$this->input->post('idPersona');
		$idTareaET=$this->input->post('idTareaET');

		$this->Model_ET_Responsable_Tarea->eliminarPorIdTareaET($idTareaET);

		if($idPersona!='')
		{
			$this->Model_ET_Responsable_Tarea->insertar($idPersona, $idTareaET, date('Y-m-d H:i:s'));
		}

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Responsable asignado correctamente.']);exit;
	}
}