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

				$id_pie_presupuesto=$this->input->post('id_pie_presupuesto');	
				$descripcion=$this->input->post('descripcion');
				$variable=$this->input->post('variable');
				$macro=$this->input->post('macro');
				$id_presupuesto_ej=$this->input->post('id_presupuesto_ej');
				$id_et=$this->input->post('id_et');
				$modalidad=$this->input->post('modalidad');
				$orden=$this->input->post('orden');
				$monto=$this->input->post('monto');

			$etPiePresupuesto=$this->Model_ET_Pie_Presupuesto->buscar($id_pie_presupuesto);

			if($etPiePresupuesto==null)
			{
				$c_data['descripcion']=$descripcion;
				$c_data['variable']=$variable;
				$c_data['macro']=$macro;
				$c_data['id_presupuesto_ej']=$id_presupuesto_ej==0?NULL:$id_presupuesto_ej;
				$c_data['id_et']=$id_et;
				// obtener valor de la pestaña modalidad
				$c_data['modalidad_ejecucion']=$modalidad;
				$c_data['orden']=$orden;
				$c_data['monto']=$monto;

				$id_pie_presupuesto=$this->Model_ET_Pie_Presupuesto->insertar($c_data);
			}
			else
			{
				$u_data['descripcion']=$descripcion;
				$u_data['variable']=$variable;
				$u_data['macro']=$macro;
				$u_data['id_presupuesto_ej']=$id_presupuesto_ej==0?NULL:$id_presupuesto_ej;
				$u_data['id_et']=$id_et;
				$u_data['modalidad_ejecucion']=$modalidad;
				$u_data['orden']=$orden;
				$u_data['monto']=$monto;
				$data=$this->Model_ET_Pie_Presupuesto->editar($etPiePresupuesto->id_pie_presupuesto, $u_data);
			}	

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Pie de Presupuesto registrado correctamente.', 'id_pie_presupuesto' => $id_pie_presupuesto]);exit;
		}
		$id_ExpedienteTecnico = $this->input->get('idExpedienteTecnico');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));
		$presupuestoEjecucion=(object)[];
		$piePresupuesto=(object)[];
		
		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
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
			$presupuestoEjecucion->directa=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucionCostoIndirecto();
			$piePresupuesto->directa=$this->Model_ET_Pie_Presupuesto->PiePresupuestoPorIdET($id_ExpedienteTecnico);
		}

		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
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

			$presupuestoEjecucion->indirecta=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucionAdmIndCostoIndirecto();
			$piePresupuesto->indirecta=$this->Model_ET_Pie_Presupuesto->PiePresupuestoPorIdETAdmInd($id_ExpedienteTecnico);
		}

		$this->load->view('front/Ejecucion/ETComponente/registroPie.php', ['expedienteTecnico'=>$expedienteTecnico,'PresupuestoEjecucion'=>$presupuestoEjecucion,'PiePresupuesto'=>$piePresupuesto]);
	}

	function eliminar()
	{
			$msg = array();
			$data = $this->Model_ET_Pie_Presupuesto->eliminar($this->input->post('id_pie_presupuesto'));
			$msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'El registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
			echo json_encode($msg);exit;
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