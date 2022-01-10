<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Detalle_Partida extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_Unidad_Medida');
		$this->load->model('Model_ET_Etapa_Ejecucion');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
	}

	public function insertar()
	{
		$listaETEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucion_Listar('R');
		$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
		$etExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));

		$etExpedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorIdET($etExpedienteTecnico->id_et);

		$etEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucionPorDescEtaoaET('Elaboración de expediente técnico');

		foreach($etExpedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidada($item, $etEtapaEjecucion->id_etapa_et);
			}
		}

		$this->load->view('Front/Ejecucion/ETDetallePartida/insertar', ['listaETEtapaEjecucion' => $listaETEtapaEjecucion, 'listaUnidadMedida' => $listaUnidadMedida, 'etExpedienteTecnico' => $etExpedienteTecnico]);
	}

	private function obtenerMetaAnidada($meta, $idEtapaET)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{
				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaAndIdEtapaET($value->id_partida, $idEtapaET);
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidada($value, $idEtapaET);
		}
	}
}