<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Pie_Presupuesto extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Presupuesto_Ejecucion');
		$this->load->model('Model_ET_Pie_Presupuesto');
	}


	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start();

			if(count($this->Model_ET_Componente->ETComponentePorIdETAndDescripcion($this->input->post('idET'), $this->input->post('idPresupuestoEjecucion'), $this->input->post('idPresupuestoEjecucion')))>0)
			{
				$this->db->trans_rollback();

				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede agregar dos veces el mismo componente.']);exit;
			}

			$c_data['id_et']=$this->input->post('idET');
			$c_data['descripcion']=$this->input->post('descripcionComponente');
			$c_data['id_presupuesto_ej']=$this->input->post('idPresupuestoEjecucion');
			$c_data['estado']="EXPEDIENTETECNICO";
			$c_data['tipo_ejecucion']=$this->input->post('tipoEjecucion');

			$ultimoIdComponente=$this->Model_ET_Componente->insertarComponente($c_data);

			$this->updateNumerationComponentPresupuestoEjecucion($this->input->post('idET'),$this->input->post('idPresupuestoEjecucion'),'EXPEDIENTETECNICO');	

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Componente registrado correctamente.', 'idComponente' => $ultimoIdComponente]);exit;
		}
		$id_ExpedienteTecnico = $this->input->get('idExpedienteTecnico');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));
		
		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($id_ExpedienteTecnico, 'EXPEDIENTETECNICO');

			$costoDirectoTotal=0;
			foreach ($expedienteTecnico->childComponente as $key => $value)
				{
				$costoComponente=0;
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
					$costoComponente+=$item->costoMeta;
				}
				$costoDirectoTotal+=$costoComponente;
				$value->costoComponente=$costoComponente;
			}
			$expedienteTecnico->costoDirecto=$costoDirectoTotal;

		}

		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			$expedienteTecnico->childComponenteIndirecta=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($id_ExpedienteTecnico, 'EXPEDIENTETECNICO');

			$costoDirectoTotalIndirecta=0;
			foreach ($expedienteTecnico->childComponenteIndirecta as $key => $value)
				{
				$costoComponente=0;
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
					$costoComponente+=$item->costoMeta;
				}
				$costoDirectoTotalIndirecta+=$costoComponente;
				$value->costoComponente=$costoComponente;
			}
			$expedienteTecnico->costoDirectoIndirecta=$costoDirectoTotalIndirecta;
		}
		$presupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucionCostoIndirecto();
		$piePresupuesto=$this->Model_ET_Pie_Presupuesto->PiePresupuestoPorIdET($id_ExpedienteTecnico);

		$this->load->view('front/Ejecucion/ETComponente/registroPie.php', ['expedienteTecnico'=>$expedienteTecnico,'PresupuestoEjecucion'=>$presupuestoEjecucion,'PiePresupuesto'=>$piePresupuesto]);
	}

	private function obtenerAnidadaCostoIndirecto($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		$sumatoria=0;

		if(count($temp)==0)
		{
			$data = $this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($data as $key => $value)
			{
				$sumatoria+=$value->parcial;
			}

			return $sumatoria;

		}
		else
		{
			$data = $this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($data as $key => $value)
			{
				$sumatoria+=$value->parcial;
			}

		}

		$costoPorMeta=$sumatoria;

		foreach($meta->childMeta as $key => $value)
		{

			$costoPorMeta+=$this->obtenerAnidadaCostoIndirecto($value);

		}

		return $costoPorMeta;
	}
	
}