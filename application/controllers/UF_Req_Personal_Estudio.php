<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UF_Req_Personal_Estudio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Especialidad');
		$this->load->model('Model_UF_Req_Personal_Estudio');
		$this->load->model('Model_Personal');
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idEspecialidad=$this->input->post('idEspecialidad');
				$id_est_inv=$this->input->post('id_est_inv');

				$this->Model_UF_Req_Personal_Estudio->insertar($id_est_inv, 'NULL', $idEspecialidad,'NULL', 0);


				$etPerReqTemp=$this->Model_UF_Req_Personal_Estudio->ultimoETPerReqFormulador();

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos registrados correctamente.e', 'idPerReq' => $etPerReqTemp->id_req_per]);exit;
			}

			$id_est_inv=$this->input->get('id_est_inv');

			$listaEspecialidad=$this->Model_Especialidad->ListarEspecialidad();
			$listaETPerReqEstudio=$this->Model_UF_Req_Personal_Estudio->ETPerReqPorIdETFormulacion($id_est_inv);
			$listaPersona=$this->Model_Personal->verTodo();

		
			return $this->load->view('front/Formulacion_Evaluacion/ufRequerimientoPersonalEstudio/insertar', ['listaEspecialidad' => $listaEspecialidad, 'id_est_inv' => $id_est_inv, 'listaETPerReqEstudio' => $listaETPerReqEstudio, 'listaPersona' => $listaPersona]);
		}
	}

	/*public function eliminar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');

				$this->Model_ET_Per_Req->eliminar($idPerReq);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos eliminados correctamente.']);exit;
			}
		}
	}*/

	public function asignarPersonal()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');
				$idPersona=$this->input->post('idPersona');
				$id_est_inv=$this->input->post('id_est_inv');

				if($idPersona!='' && $this->Model_UF_Req_Personal_Estudio->existePersonaPorET(($idPersona=="" ? 'NULL' : $idPersona), $id_est_inv))
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede asignar a la misma persona a dos cargos diferentes en el la misma formulacion.']);exit;
				}

				$this->Model_UF_Req_Personal_Estudio->asignarPersonal($idPerReq, ($idPersona=="" ? 'NULL' : $idPersona), date('Y-m-d H:m:s'));

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Personal asignado correctamente.']);exit;
			}
		}
	}

	public function asignarQuitarFormulador()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');
				$formulador=$this->input->post('formulador');

				$this->Model_UF_Req_Personal_Estudio->asignarQuitarFormulador($idPerReq,$formulador);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => "correcto"]);exit;
			}
		}
	}
}