<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronogramaValorizacion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_CronogramaValorizacion');
	}

	public function index()
    {
      	$opcion="R";
      	$CronogramaValorizaciones=$this->Model_CronogramaValorizacion->CronogramaValorizacion_Listar($opcion);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('Front/Ejecucion/CronogramaValorizacion/index',['CronogramaValorizaciones'=>$CronogramaValorizaciones]);
        $this->load->view('layout/Ejecucion/footer');
    }
	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start();
			$option="C";
			$txtCronogramaValorizacion=$this->input->post('txtCronogramaValorizacion');
			if(count($this->Model_CronogramaValorizacion->ValidarCronogramaValorizacion($txtCronogramaValorizacion))>0)
            {
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Este dato fue registrado con anterioridado.']);exit;
            }
			$this->Model_CronogramaValorizacion->insertar($option,$txtCronogramaValorizacion);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos registrados correctamente.']);exit;
		}
		$this->load->view('Front/Ejecucion/CronogramaValorizacion/insertar');
	}
	public function editar()
	{
		if($this->input->post('hdIdCronogramaValorizacion'))
		{
			$this->db->trans_start();
			$option="U";
			$hdIdCronogramaValorizacion=$this->input->POST('hdIdCronogramaValorizacion');
			$txtCronogramaValorizacion=$this->input->POST('txtCronogramaValorizacion');
			if(count($this->Model_CronogramaValorizacion->ValidarDescripcionEtapaEditar($hdIdCronogramaValorizacion,$txtCronogramaValorizacion))>0)
            {
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Este tipo de gasto ya fue registrado con anterioridad .']);exit;
            }
			$CronogramaValoracion=$this->Model_CronogramaValorizacion->editar($option,$hdIdCronogramaValorizacion,$txtCronogramaValorizacion);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos Editados Correctamente.']);exit;

		}
		$id_valorizacion=$this->input->GET('id_valorizacion');
		$CronogramaValoracion=$this->Model_CronogramaValorizacion->NombreCronogranmaValoracion($id_valorizacion);
	    $this->load->view('Front/Ejecucion/CronogramaValorizacion/editar',['CronogramaValoracion'=>$CronogramaValoracion]);
	}

    function Eliminar(){

        if ($this->input->is_ajax_request())
        {
            $id_cronog = $this->input->post("id_cronogramavalorizacion");
            $this->Model_CronogramaValorizacion->EliminarCronograma($id_cronog);
            echo "1";

        } else {
            show_404();
        }

    }

}
