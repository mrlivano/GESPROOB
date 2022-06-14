<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_EspecificacionTecnica extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->library('mydompdf');
	}

	public function Insertar()
	{
		if($_POST)
		{

		}

		$idExpedienteTecnico=$this->input->get('idExpedienteTecnico');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidada($item);
			}
		}		
		$this->load->view('front/Ejecucion/EspecificacionTecnica/index',['expedienteTecnico'=>$expedienteTecnico]);
	}

	public function Guardar()
	{
		if($_POST)
		{	
			$u_data['especificacion_tecnica'] = $this->input->post('txtEspecificacionTecnica');
			$data = $this->Model_ET_Detalle_Partida->update($this->input->post('hdIdDetallePartida'),$u_data);							
			$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));					
			echo json_encode($msg);exit;
		}

		$idExpedienteTecnico=$this->input->get('idExpediente');
		$idDetallePartida=$this->input->get('id_DetallePartida');
		$DetallePartida=$this->Model_ET_Detalle_Partida->getDetallePartida($idDetallePartida);
		$this->load->view('front/Ejecucion/EspecificacionTecnica/insertar',['DetallePartida'=>$DetallePartida]);
	}

	public function AgregarGeneralidad()
	{
		if($_POST)
		{	
			$u_data['generalidad_especificacion_tecnica'] = $this->input->post('txtGeneralidad');

			$data = $this->Model_ET_Expediente_Tecnico->update($u_data, $this->input->post('hdIdExpediente'));	

			$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));					
			
			echo json_encode($msg);exit;
		}

		$idExpedienteTecnico=$this->input->get('idExpediente');

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/EspecificacionTecnica/agregarGeneralidad',['expedienteTecnico'=>$expedienteTecnico]);
	}

	public function verPorDescripcion()
	{
		$data=$this->Model_ET_Detalle_Partida->getPartidaPorDescripcion($this->input->post('valueSearch'), $this->input->post('idPartida'));
		echo json_encode($data);exit;
	}

	public function FormatoEspecificacionTecnica()
	{
		$idExpedienteTecnico=$this->input->get('id_et');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
		
		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaEspecificacion($item);
			}
		}

		$html= $this->load->view('front/Ejecucion/EspecificacionTecnica/formatoEspecificacionTecnica',['expedienteTecnico'=>$expedienteTecnico], true);				
		$this->mydompdf->set_option('enable_remote', TRUE);
		$this->mydompdf->set_option('enable_css_float', TRUE);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));

	}

	public function FormatoEspecificacionTecnicaPorComponente()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('idExpediente');	
			$childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');
			$this->load->view('front/Ejecucion/EspecificacionTecnica/listaComponente',['childComponente'=>$childComponente, 'idExpedienteTecnico'=>$idExpedienteTecnico]);			
		}
		else
		{
			$idComponente=$this->input->get('query');
			$componente=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);
			$componente->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($componente->id_componente);
			foreach($componente->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaEspecificacion($item);
			}
	
			$html= $this->load->view('front/Ejecucion/EspecificacionTecnica/formatoEspecificacionPorComponente',['componente'=>$componente], true);				
			$this->mydompdf->set_option('enable_remote', TRUE);
			$this->mydompdf->set_option('enable_css_float', TRUE);
			$this->mydompdf->load_html($html);
			$this->mydompdf->render();
			$this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));
		}
	}

	private function obtenerMetaAnidada($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidada($value);
		}
	}

	private function obtenerMetaAnidadaEspecificacion($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->EspecificacionPartidaPorMeta($meta->id_meta);

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaEspecificacion($value);
		}
	}
}
