<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Per_Req extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Especialidad');
		$this->load->model('Model_ET_Per_Req');
		$this->load->model('Model_ET_Expediente_Tecnico');
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
				$idET=$this->input->post('idET');

				$this->Model_ET_Per_Req->insertar('NULL', $idEspecialidad, $idET, 'NULL', 0);

				$etPerReqTemp=$this->Model_ET_Per_Req->ultimoETPerReq();

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.', 'idPerReq' => $etPerReqTemp->id_per_req]);exit;
			}

			$idET=$this->input->get('idExpedienteTecnico');

			$ETAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idET);

			$aprobado=($ETAprobado[0]->aprobado==1 ? 1 : 0);

			$listaEspecialidad=$this->Model_Especialidad->ListarEspecialidad();
			$listaETPerReq=$this->Model_ET_Per_Req->ETPerReqPorIdET($idET);
			$listaPersona=$this->Model_Personal->verTodo();

			return $this->load->view('front/Ejecucion/ETPerReq/insertar', ['listaEspecialidad' => $listaEspecialidad, 'idET' => $idET, 'listaETPerReq' => $listaETPerReq, 'listaPersona' => $listaPersona,'aprobado'=>$aprobado]);
		}
	}

	public function eliminar()
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
	}

	public function asignarPersonal()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');
				$idPersona=$this->input->post('idPersona');
				$idET=$this->input->post('idET');

				if($idPersona!='' && $this->Model_ET_Per_Req->existePersonaPorET(($idPersona=="" ? 'NULL' : $idPersona), $idET))
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede asignar a la misma persona a dos cargos diferentes en el mismo expediente técnico.']);exit;
				}

				$this->Model_ET_Per_Req->asignarPersonal($idPerReq, ($idPersona=="" ? 'NULL' : $idPersona), date('Y-m-d H:m:s'));

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Personal asignado correctamente.']);exit;
			}
		}
	}

	public function asignarQuitarCraet()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');
				$craet=$this->input->post('craet');

				$this->Model_ET_Per_Req->asignarQuitarCraet($idPerReq, $craet);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos guardados correctamente.']);exit;
			}
		}
	}
}