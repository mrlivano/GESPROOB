<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Meta_Analitico extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Meta_Analitico');
		$this->load->model('Model_ET_Presupuesto_Analitico');
		$this->load->model('Model_ET_Analisis_Unitario');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
	}

	public function insertar()
	{
		if($_POST)
		{
			$msg = array();

			$c_data['id_analitico']=$this->input->post('idAnalitico');
			$c_data['id_meta']=$this->input->post('idMeta');

			$idAnalitico=$this->input->post('idAnalitico');

			if(count($this->Model_ET_Meta_Analitico->ETClasificadorPorMeta($this->input->post('idMeta')))>0)
			{
				$this->db->trans_rollback();
				$msg=(['proceso' => 'Error', 'mensaje' => 'Ya se ha asociado a un Clasificador de Gasto a esta Meta.']);
				echo json_encode($msg);exit;
			}			

			$idAnalisis = $this->Model_ET_Meta_Analitico->insertar($c_data);

			$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($this->input->post('idMeta'));

			$this->updateMetaAnidadaCostoIndirecto($meta,$idAnalitico);

			$this->db->trans_complete();
			
			$msg = ($idAnalisis > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idAnalisis' => $idAnalisis,'idAnalitico'=>$idAnalitico]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

			echo json_encode($msg);exit;
		
		}

		$idMeta=$this->input->get('idMeta');
		
		$idET = $this->input->get('idET');
		
		$listaETPresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoPorIdETCostoIndirecto($idET);
		
		$listaAnaliticoMeta=$this->Model_ET_Meta_Analitico->ETClasificadorPorMeta($idMeta);			
		
		$this->load->view('Front/Ejecucion/ETMetaAnalitico/insertar', ['idMeta'=>$idMeta,'listaETPresupuestoAnalitico' => $listaETPresupuestoAnalitico,'listaAnaliticoMeta'=>$listaAnaliticoMeta]);			
	}

	public function eliminar()
	{
		$this->db->trans_start();

		$this->Model_ET_Meta_Analitico->eliminar($this->input->post('idAnalisis'));

		$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($this->input->post('idMeta'));

		$this->deleteMetaAnidadaCostoIndirecto($meta);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Registro eliminado correctamente.']);exit;
	
	}

	private function updateMetaAnidadaCostoIndirecto($meta,$analitico)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $item)
			{
				$c_data['id_analitico']=$analitico;

				$c_data['id_detalle_partida']=$item->id_detalle_partida;

				$this->Model_ET_Analisis_Unitario->insertar($c_data);
			}
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->updateMetaAnidadaCostoIndirecto($value,$analitico);
		}
	}

	private function deleteMetaAnidadaCostoIndirecto($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $item)
			{
				$this->Model_ET_Analisis_Unitario->eliminarAuPorMeta($item->id_detalle_partida);
			}
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->deleteMetaAnidadaCostoIndirecto($value);
		}
	}
	
}