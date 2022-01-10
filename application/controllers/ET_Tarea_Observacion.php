<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Tarea_Observacion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Tarea_Observacion');
	}

	public function insertar()
	{
		$this->db->trans_start();

		$idTareaET=$this->input->post('idTareaET');
		$descripcionObservacion=$this->input->post('descripcionObservacion');

		$fechaActual=date('Y-m-d H:i:s');

		$this->Model_ET_Tarea_Observacion->insertar($idTareaET, $descripcionObservacion, '', $fechaActual, $fechaActual, 0);

		$ultimoIdETTareaObservacion=$this->Model_ET_Tarea_Observacion->ultimoId();

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Observación registrada correctamente.', 'fechaActual' => $fechaActual, 'ultimoIdETTareaObservacion' => $ultimoIdETTareaObservacion]);exit;
	}

	public function eliminar()
	{
		$this->db->trans_start();

		$idTareaObservacion=$this->input->post('idTareaObservacion');

		$this->Model_ET_Tarea_Observacion->eliminar($idTareaObservacion);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Observación eliminada correctamente.']);exit;
	}

	public function levantarObservacion()
	{
		$this->db->trans_start();

		$idTareaObservacion=$this->input->post('idTareaObservacion');
		$descripcionLevantamientoObservacion=$this->input->post('descripcionLevantamientoObservacion');

		$this->Model_ET_Tarea_Observacion->levantarObservacion($idTareaObservacion, $descripcionLevantamientoObservacion, date('Y-m-d H:i:s'), 1);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Observación levantada correctamente.']);exit;
	}

	public function eliminarLevantamientoObservacion()
	{
		$this->db->trans_start();

		$idTareaObservacion=$this->input->post('idTareaObservacion');

		$this->Model_ET_Tarea_Observacion->levantarObservacion($idTareaObservacion, '', date('Y-m-d H:i:s'), 0);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Levantamiento de observación eliminado correctamente.']);exit;
	}
}
?>