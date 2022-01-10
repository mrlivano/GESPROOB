<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UF_ModuloEntregable extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_UF_Req_Personal_Estudio');
		$this->load->model('Model_ModuloFE');
		$this->load->model('Model_UFentregables');
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$id_est_inv=$this->input->post('id_est_inv');
				$id_modulo=$this->input->post('hdIdmodulo');
				$id_entregable=$this->input->post('hdidEntregable');
				$ValorEntregable=$this->input->post('ValorEntregable');

				for($i=0; $i<count($id_entregable); $i++)
		    	{
		    		$this->Model_UFentregables->insertarEntregable($id_est_inv, $id_modulo[$i], $id_entregable[$i],$ValorEntregable[$i]);
		    	}

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos Resgistrados del  entregables.', 'idPerReq' => '']);exit;
			}

			$listarModulo=$this->Model_ModuloFE->ListarModulo();
			$listarEntregable=$this->Model_UFentregables->LitarEntregable();

			$id_est_inv=$this->input->get('id_est_inv');
			$DetallEstudioInversion=$this->Model_UF_Req_Personal_Estudio->listaIndependienteEstudio($id_est_inv);

			return $this->load->view('front/Formulacion_Evaluacion/UfModuloEntregable/insertar',['DetallEstudioInversion' => $DetallEstudioInversion ,'listarModulo' => $listarModulo, 'listarEntregable' => $listarEntregable]);
		}
	}

	
}