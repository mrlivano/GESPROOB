<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Etapa_Ejecucion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Etapa_Ejecucion');
	}

	public function index()
    {
        $Opcion="R";
        $ETEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucion_Listar($Opcion);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('Front/Ejecucion/ETEtapaEjecucion/index',['ETEtapaEjecucion'=>$ETEtapaEjecucion]);
        $this->load->view('layout/Ejecucion/footer');
    }
	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start();
			$opcion="C";
			$txtDescripcionEtapa=$this->input->post('txtDescripcionEtapa');
			if(count($this->Model_ET_Etapa_Ejecucion->ValidarDescripcionEtapa($txtDescripcionEtapa))>0)
            {
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Datos Duplicados .']);exit;
            }
			$this->Model_ET_Etapa_Ejecucion->insertar($opcion,$txtDescripcionEtapa);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit;
		}
		$this->load->view('Front/Ejecucion/ETEtapaEjecucion/insertar');
	}
	public function editar()
	{
		if($this->input->post('hdIdEtapaFE'))
		{
			$this->db->trans_start();
			$opcion="U";
			$hdIdEtapaFE=$this->input->post('hdIdEtapaFE');
			$txtDescripcionEtapa=$this->input->post('txtDescripcionEtapa');
			if(count($this->Model_ET_Etapa_Ejecucion->ValidarDescripcionEtapaEditar($hdIdEtapaFE,$txtDescripcionEtapa))>0)
            {
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Este tipo de gasto ya fue registrado con anterioridad .']);exit;
            }
			$this->Model_ET_Etapa_Ejecucion->editar($opcion,$hdIdEtapaFE,$txtDescripcionEtapa);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos Editados Correctamente.']);exit;
		}

		$id_etapa_et=$this->input->Get('id_etapa_et');
		$nombreEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->nombreEtapaEjecucion($id_etapa_et);
	    $this->load->view('Front/Ejecucion/ETEtapaEjecucion/editar',['nombreEtapaEjecucion'=>$nombreEtapaEjecucion]);
	}
	function eliminar()
	{
			if ($this->input->is_ajax_request())
			{
					$id=$this->input->post('id_etapa_et');
					$this->Model_ET_Etapa_Ejecucion->eliminar($id);
			}
	}
}
