<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Cronograma_Ejecucion extends CI_Controller
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
		$this->load->model('Model_ET_Periodo_Ejecucion');
	}

	public function index()
	{
		$idExpedienteTecnico=isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$anioPlazoEjecucion=$this->Model_ET_Periodo_Ejecucion->listaAnioPlazoEjecucion($idExpedienteTecnico);
		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($expedienteTecnico->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/index');
			}
        }
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ETCronogramaEjecucion/index', ['idExpedienteTecnico' => $idExpedienteTecnico, 'anioPlazoEjecucion' => $anioPlazoEjecucion, 'descripcionET' => $expedienteTecnico->descripcion_modificatoria]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function cronograma()
	{
		$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$listaMes=$this->listaMeses();

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, $this->input->post('tipo'));
		
		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item, $this->input->post('anio'));
			}
		}

		$expedienteTecnico->childComponenteIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico, $this->input->post('tipo'));
		
		foreach($expedienteTecnico->childComponenteIndirecto as $key => $value)
		{
			$value->childCronograma=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $this->input->post('anio'));
		}

		$this->load->view('front/Ejecucion/ETCronogramaEjecucion/cronograma', ['expedienteTecnico' => $expedienteTecnico, 'listaMes'=>$listaMes, 'anio'=>$this->input->post('anio')]);
	}

	public function cronogramaPlazo()
	{
		$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$listaMesesPeriodo=$this->Model_ET_Periodo_Ejecucion->listaPlazoEjecucionAnio($idExpedienteTecnico,$this->input->post('anio'));
		$listaMes=$this->listaMeses();

		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, $this->input->post('tipo'));
		
			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
	
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacion($item, $this->input->post('anio'));
				}
			}
	
			$expedienteTecnico->childComponenteIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico, $this->input->post('tipo'));
			
			foreach($expedienteTecnico->childComponenteIndirecto as $key => $value)
			{
				$value->childCronograma=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $this->input->post('anio'));
			}
		}
		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			$expedienteTecnico->childComponenteInd=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($idExpedienteTecnico, $this->input->post('tipo'));
		
			foreach($expedienteTecnico->childComponenteInd as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
	
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacion($item, $this->input->post('anio'));
				}
			}
	
			$expedienteTecnico->childComponenteIndIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoIndirec($idExpedienteTecnico, $this->input->post('tipo'));
			
			foreach($expedienteTecnico->childComponenteIndIndirecto as $key => $value)
			{
				$value->childCronograma=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $this->input->post('anio'));
			}
		}

		$this->load->view('front/Ejecucion/ETCronogramaEjecucion/cronograma', ['expedienteTecnico' => $expedienteTecnico, 'listaMes'=>$listaMes, 'anio'=>$this->input->post('anio'), 'listaMesesPeriodo'=>$listaMesesPeriodo]);
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start();

				$idDetallePartida=$this->input->post('idDetallePartida');
				$numeroMes=$this->input->post('numeroMes');
				$anio=$this->input->post('anio');
				$cantidad=$this->input->post('cantidad');
				$precio=$this->input->post('precio');

				$etMesValorizacionTemp=$this->Model_ET_Cronograma_Ejecucion->ETCronogramaPorIdDetallePartidaAndNumeroMes($idDetallePartida, $numeroMes, $anio);

				if($etMesValorizacionTemp==null)
				{
					$c_data['id_detalle_partida']=$idDetallePartida;
					$c_data['numero_mes']=$numeroMes;
					$c_data['anio']=$anio;
					$c_data['cantidad']=$cantidad;
					$c_data['precio']=$precio;
					$data=$this->Model_ET_Cronograma_Ejecucion->insertar($c_data);
				}
				else
				{
					$u_data['cantidad']=$cantidad;
					$u_data['precio']=$precio;
					$data=$this->Model_ET_Cronograma_Ejecucion->editar($etMesValorizacionTemp->id_cronograma_valorizacion, $u_data);
				}

				$sumatoriaProgramado=$this->Model_ET_Cronograma_Ejecucion->sumCantidadPorIdDetallePartida($idDetallePartida);
				
				$detallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartida($idDetallePartida);

				$saldo=number_format($detallePartida->cantidad-$sumatoriaProgramado, 2, '.', ',');

				if($sumatoriaProgramado>$detallePartida->cantidad)
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'La cantidad calculada de la sumatoria total de meses no puede ser mayor al destinado en la partida.']);exit;
				}
				if($detallePartida->cantidad==$sumatoriaProgramado)
				{
					$this->db->trans_complete();

					echo json_encode(['proceso' => 'Completo', 'mensaje' => 'La partida fue programada correctamente en su totalidad','saldo'=>$saldo]);exit;
				}

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto','saldo'=>$saldo]);exit;
			}
		}
	}

	private function obtenerMetaAnidadaParaValorizacion($meta, $anio)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{

				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaParaValorizacion($value->id_partida);

				$value->childDetallePartida->childMesValorizacion=$this->Model_ET_Cronograma_Ejecucion->ETCronogramaPorIdDetallePartida($value->childDetallePartida->id_detalle_partida, $anio);

				$sumatoriaValorizacion=$this->Model_ET_Cronograma_Ejecucion->sumCantidadPorIdDetallePartida($value->childDetallePartida->id_detalle_partida);
				
				$value->saldo=$value->cantidad-$sumatoriaValorizacion;
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaParaValorizacion($value, $anio);
		}
	}

	private function listaMeses()
    {
        $array = array(
            'Enero'=>'01',
            'Febrero'=>'02',
            'Marzo'=>'03',
            'Abril'=>'04',
            'Mayo'=>'05',
            'Junio'=>'06',
            'Julio'=>'07',
            'Agosto'=>'08',
            'Setiembre'=>'09',
            'Octubre'=>'10',
            'Noviembre'=>'11',
            'Diciembre'=>'12'
        );
        return $array;
    }
}
?>
