<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Cronograma_Componente extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Cronograma_Ejecucion');
		$this->load->model('Model_ET_Cronograma_Componente');
		$this->load->model('UsuarioProyecto_model');
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start();

				$idComponente=$this->input->post('idComponente');
				$numeroMes=$this->input->post('numeroMes');
				$anio=$this->input->post('anio');
				$monto=$this->input->post('monto');

				$etCronogramaTemp=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponenteAndNumeroMes($idComponente, $numeroMes, $anio);

				if($etCronogramaTemp==null)
				{
					$c_data['id_componente']=$idComponente;
					$c_data['numero_mes']=$numeroMes;
					$c_data['anio']=$anio;
					$c_data['precio']=$monto;
					$data=$this->Model_ET_Cronograma_Componente->insertar($c_data);
				}
				else
				{
					$u_data['precio']=$monto;
					$data=$this->Model_ET_Cronograma_Componente->editar($etCronogramaTemp->id_cronograma_componente, $u_data);
				}

				$this->db->trans_complete();

				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Monto programado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));

				echo json_encode($msg);exit;
			}
		}
	}
}
?>
