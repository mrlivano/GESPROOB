<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Analisis_Unitario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Recurso');
		$this->load->model('Model_ET_Presupuesto_Analitico');
		$this->load->model('Model_Unidad_Medida');
		$this->load->model('Model_ET_Etapa_Ejecucion');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Analisis_Unitario');
		$this->load->model('Model_ET_Detalle_Analisis_Unitario');
	}

	public function insertar()
	{
		if($_POST)
		{
			$msg = array();

			$c_data['id_analitico']=$this->input->post('idAnalitico');
			$c_data['id_recurso']=$this->input->post('idRecurso');
			$c_data['id_detalle_partida']=$this->input->post('idDetallePartida');
			$idET = $this->input->post('idET');
			$idAnalitico = $this->input->post('idAnalitico');

			if($this->input->post('idPresupuestoEjecucion')==2)
			{
				if($this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetallePartidaAndIdRecurso($this->input->post('idDetallePartida'), $this->input->post('idRecurso'))!=null)
				{
					$this->db->trans_rollback();
					$msg=(['proceso' => 'Error', 'mensaje' => 'No se puede agregar dos veces el mismo recurso para el análisis unitario.']);
					echo json_encode($msg);exit;
				}
			}
			else
			{
				if(count($this->Model_ET_Analisis_Unitario->ETClasificadorPorIdDetallePartida($this->input->post('idDetallePartida')))>0)
				{
					$this->db->trans_rollback();
					$msg=(['proceso' => 'Error', 'mensaje' => 'Ya se ha asociado a un Clasificador de Gasto.']);
					echo json_encode($msg);exit;
				}
				$c_data['id_recurso']=NULL;
			}

			$idAnalisis = $this->Model_ET_Analisis_Unitario->insertar($c_data);

			$partidaCompleta=$this->partidaEstaCompleta($this->input->post('idDetallePartida'));

			$this->db->trans_complete();
			
			$msg = ($idAnalisis > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idAnalisis' => $idAnalisis, 'idAnalitico' => $idAnalitico, 'partidaCompleta' => $partidaCompleta,'id_Et' => $idET]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

			echo json_encode($msg);exit;
		
		}

		$idPartida=$this->input->get('idPartida');
		$idET = $this->input->get('idET');
		$idPresupuesto = $this->input->get('idPresupuesto');
		$id_etapa_et = $this->input->get('id_etapa_et');
		$aprobado = $this->input->get('aprobado');

		// if($idPresupuesto==2)
		// {
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

			$etEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucionPorDescEtaoaET('Elaboración de expediente técnico');
			$etDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaAndIdEtapaET($idPartida, $etEtapaEjecucion->id_etapa_et);
			$listaETAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetallePartida($etDetallePartida->id_detalle_partida);

			foreach($listaETAnalisisUnitario as $key => $value)
			{
				$value->childETDetalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisUnitarioPorIdAnalisis($value->id_analisis);
			}

			$listaETRecurso=$this->Model_ET_Recurso->RecursoListar('R');
			$listaETPresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoPorIdET($idET);

			$this->load->view('Front/Ejecucion/ETAnalisisUnitario/insertar', ['etDetallePartida' => $etDetallePartida, 'listaUnidadMedida' => $listaUnidadMedida, 'listaETAnalisisUnitario' => $listaETAnalisisUnitario, 'listaETRecurso' => $listaETRecurso, 'listaETPresupuestoAnalitico' => $listaETPresupuestoAnalitico, 'idPartida' => $idPartida,'idExpediente' => $idET, 'idPresupuesto'=>$idPresupuesto, 'aprobado'=>$aprobado, 'id_etapa_et'=>$id_etapa_et]);		
		// }
		// else
		// {
		// 	$etEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucionPorDescEtaoaET('Elaboración de expediente técnico');
		// 	$listaETPresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoPorIdET($idET);
		// 	$etDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaAndIdEtapaET($idPartida, $etEtapaEjecucion->id_etapa_et);
		// 	$listaETAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ETClasificadorPorIdDetallePartida($etDetallePartida->id_detalle_partida);			
		// 	$this->load->view('Front/Ejecucion/ETAnalisisUnitario/insertarClasificadorIndirecto', ['etDetallePartida' => $etDetallePartida,'listaETPresupuestoAnalitico' => $listaETPresupuestoAnalitico,'listaETAnalisisUnitario' => $listaETAnalisisUnitario, 'idPartida' => $idPartida,'idExpediente' => $idET, 'idPresupuesto'=>$idPresupuesto]);		
		// }
	}
	public function insertarCostoUnitario()
	{
		
		$idPartida=$this->input->get('idPartida');

			$resultado=$this->Model_ET_Analisis_Unitario->insertarCostoUnitario($idPartida);			
			$this->load->view('Front/Ejecucion/ETAnalisisUnitario/insertarCostoUnitario', ['resultado'=>$resultado,'idPartida'=>$idPartida]);		
	}

	public function eliminar()
	{
		$this->db->trans_start();

		$idAnalisis=$this->input->post('idAnalisis');
		$idDetallePartida=$this->input->post('idDetallePartida');

		$this->Model_ET_Analisis_Unitario->eliminar($idAnalisis);

		$partidaCompleta=$this->partidaEstaCompleta($idDetallePartida);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Análisis unitario eliminado correctamente.', 'partidaCompleta' => $partidaCompleta]);exit;
	}

	public function actualizarAnalitico()
	{
		$idAnalisis=$this->input->post('idAnalisis');
		$idAnalitico=$this->input->post('idAnalitico');
		$idDetallePartida=$this->input->post('idDetallePartida');

		$idAnalitico=($idAnalitico=='' || $idAnalitico==null ? 'NULL' : $idAnalitico);

		$this->Model_ET_Analisis_Unitario->actualizarAnalitico($idAnalisis, $idAnalitico);

		$partidaCompleta=$this->partidaEstaCompleta($idDetallePartida);

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Analítico guardado correctamente.', 'partidaCompleta' => $partidaCompleta]);exit;
	}

	private function partidaEstaCompleta($idDetallePartida)
	{
		$partidaCompleta=true;

		$listaETAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ETClasificadorPorIdDetallePartida($idDetallePartida);

		foreach($listaETAnalisisUnitario as $key => $value)
		{
			if($value->id_analitico==null)
			{
				$partidaCompleta=false;

				break;
			}
		}

		if(count($listaETAnalisisUnitario)==0)
		{
			$partidaCompleta=false;
		}

		return $partidaCompleta;
	}

	public function cargarNivel()
	{
		$codigoInsumo=$this->input->post('codigoInsumo');
		$nivel=$this->input->post('nivel');
		$data=$this->Model_Unidad_Medida->listaInsumoporNivel($codigoInsumo, $nivel);

		foreach($data as $key => $value)
		{
			$value->hasChild=(count($this->Model_Unidad_Medida->listaInsumoporNivel($value->CodInsumo, ($value->Nivel+1)))==0 ? false : true);
		}
		echo json_encode($data);exit;
	}
}