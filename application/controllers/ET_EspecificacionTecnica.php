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
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($this->input->post("hdIdExpedienteTecnico"));
			$tipo=$this->input->post("tipo");

			var_dump($expedienteTecnico);
			$this->db->trans_start();

			if (file_exists("uploads/EspecificacionesTecnicas/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_especificacion_tecnica))
			{
				unlink("uploads/EspecificacionesTecnicas/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_especificacion_tecnica);
			}
			if ($tipo==1) {
			$config['file_name'] = $this->input->post('hdIdExpedienteTecnico')."a";
			}
			elseif($tipo==2){
			$config['file_name'] = $this->input->post('hdIdExpedienteTecnico')."b";

			}
			$config['upload_path'] = './uploads/EspecificacionesTecnicas/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('fileEspecificacionesTecnicas'))
			{
				$c_data['url_especificacion_tecnica']= $this->upload->data('file_ext');
				$data = $this->Model_ET_Expediente_Tecnico->PeriodoEjecucion($this->input->post('hdIdExpedienteTecnico'),$c_data);
				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Especificacion Tecnica guardada correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			}
			else
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
			}
			$this->db->trans_complete();
			echo json_encode($msg);exit;
		}

		$idExpedienteTecnico=$this->input->get('idExpedienteTecnico');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item);
				}
			}	
		}
		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			$expedienteTecnico->childComponenteInd=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
			foreach($expedienteTecnico->childComponenteInd as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item);
				}
			}	
		}
		$et_documentos_f04 = $this->Model_ET_Expediente_Tecnico->getETDocumento($idExpedienteTecnico,3);
	
		$this->load->view('front/Ejecucion/EspecificacionTecnica/index',['expedienteTecnico'=>$expedienteTecnico,'et_documentos_f04'=>$et_documentos_f04]);
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

		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
		
			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaEspecificacion($item);
				}
			}
		}

		if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			$expedienteTecnico->childComponenteInd=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($expedienteTecnico->id_et, 'EXPEDIENTETECNICO');
		
			foreach($expedienteTecnico->childComponenteInd as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaEspecificacion($item);
				}
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
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
			if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
				$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');
			}

			if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
				$expedienteTecnico->childComponenteInd=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');
			}
		
			$this->load->view('front/Ejecucion/EspecificacionTecnica/listaComponente',['expedienteTecnico'=>$expedienteTecnico, 'idExpedienteTecnico'=>$idExpedienteTecnico]);			
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
	public function FormatoEspecificacionTecnicaPorComponenteB()
	{
		$idExpedienteTecnico=$this->input->post('idExpediente');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
		
		$this->load->view('front/Ejecucion/EspecificacionTecnica/formatoEspecificacionPorComponenteB',['expedienteTecnico'=>$expedienteTecnico]);
	
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
