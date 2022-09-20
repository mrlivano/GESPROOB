<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_RelacionInsumo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_ET_Expediente_Tecnico");
		$this->load->model("Model_ET_Recurso");
		$this->load->model("Model_ET_Recurso_Insumo");
		$this->load->model("Model_ET_Insumo_Valorizacion");
		$this->load->model("UsuarioProyecto_model");
		$this->load->helper('FormatNumber_helper');
		$this->load->library('mydompdf');
	}

	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start();
			$flag=0;
			$idRelacionInsumo=$this->input->post('idRelacionInsumo');
			$numeroMes=$this->input->post('numeroMes');
			$cantidad=$this->input->post('cantidad');
			$precio=$this->input->post('precio');
			$etMesValorizacionTemp=$this->Model_ET_Insumo_Valorizacion->ETMesValorizacionPorIdDetallePartidaAndNumeroMes($idRelacionInsumo, $numeroMes);
			if(count($etMesValorizacionTemp)==0)
			{
				$c_data['id_relacion_insumo']=$idRelacionInsumo;
				$c_data['numero_mes']=$numeroMes;
				$c_data['cantidad']=$cantidad;
				$c_data['parcial']=$precio;				
				$flag=$this->Model_ET_Insumo_Valorizacion->insertar($c_data);
			}
			else
			{
				$u_data['cantidad']=$cantidad;
				$u_data['parcial']=$precio;	
				$flag=$this->Model_ET_Insumo_Valorizacion->editar($u_data, $etMesValorizacionTemp[0]->id_insumo_valorizacion);
			}

			$estado=0;
			$sumatoriaValorizacion=$this->Model_ET_Insumo_Valorizacion->sumatoriaValorizacionRecurso($idRelacionInsumo);
			$saldo=$sumatoriaValorizacion[0]->cantidad-$sumatoriaValorizacion[0]->sumatoria;
			if($saldo==0)
			{
				$estado=1;
			}

			$this->db->trans_complete();
			$msg = ($flag!=0 ? (['proceso' => 'Correcto','mensaje'=>'Registro guardado correctamente','estado'=>$estado,'saldo'=>$saldo]) : (['proceso' => 'Error','mensaje'=>'Ha ocurrido un error inesperado']));			
			echo json_encode($msg);
			exit;
		}

		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$idRecurso = isset($_GET['id_recurso']) ? $_GET['id_recurso'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
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
      if($expedienteTecnico->aprobado==1)
      {
      	$this->session->set_flashdata('error', 'Este expediente Tecnico ya esta en fase de Ejecución');
				redirect('Expediente_Tecnico/index');
			}
		
		$listarecurso=$this->Model_ET_Recurso->Recurso($idRecurso);			
		$costoDirectoExpediente=0;
		foreach($listarecurso as $key => $recurso)
		{
			// $insumo=$this->Model_ET_Recurso_Insumo->listaInsumoPorRecurso($recurso->id_recurso,$idExpedienteTecnico);
			$insumo=$this->Model_ET_Recurso_Insumo->listaInsumoPorRecursoMeta($recurso->id_recurso,$idExpedienteTecnico);		
			$sumatoria=0;
			foreach($insumo as $key => $value)
			{
				$value->modalidad = $this->Model_ET_Recurso_Insumo->listaInsumoTipoEjecucion($value->id_meta)[0]->tipo_ejecucion;
				$value->childInsumoValorizacion=$this->Model_ET_Insumo_Valorizacion->ETValorizacionPorRelacionInsumo($value->id_relacion_insumo);
				$sumatoriaValorizacion=0;
				foreach($value->childInsumoValorizacion as $key => $child)
				{
					$sumatoriaValorizacion+=$child->cantidad;
				}
				$value->estado=($sumatoriaValorizacion>=$value->cantidad ? 1:0);
				$value->saldo=$value->cantidad-$sumatoriaValorizacion;
				if($value->cantidad!=0)
				{
					$value->precio_unitario=$value->parcial/$value->cantidad;
				}
				else
				{
					$value->precio_unitario=0;
				}				
				$sumatoria+=$value->parcial;				
			}

			$costoDirectoExpediente+=$sumatoria;
			$recurso->childInsumo=$insumo;
			$recurso->costoTotalRecurso=$sumatoria;
		}	

		$expedienteTecnico->costoDirecto=$costoDirectoExpediente;

		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/Reporte/ValorizacionRecursoInsumo', ['expedienteTecnico' => $expedienteTecnico, 'recurso'=> $listarecurso]);
		$this->load->view('layout/Ejecucion/footer');
	}

	function ReportePdfCronogramaRequerimiento()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$idRecurso = isset($_GET['id_recurso']) ? $_GET['id_recurso'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$listarecurso=$this->Model_ET_Recurso->Recurso($idRecurso);
		$nombreReporte=$listarecurso[0]->desc_recurso;
		switch ($idRecurso) 
		{
			case 1:
				$numeroReporte='16';
				break;
			case 2:
				$numeroReporte='18';
				break;
			case 3:
				$numeroReporte='17';
				break;
		}

		foreach($listarecurso as $key => $recurso)
		{
			$sumatoria=0;
			$insumo=$this->Model_ET_Recurso_Insumo->listaInsumoPorRecurso($recurso->id_recurso,$idExpedienteTecnico);
			foreach($insumo as $key => $value)
			{
				$value->childMesValorizacion=$this->Model_ET_Insumo_Valorizacion->ETValorizacionPorRelacionInsumo($value->id_relacion_insumo);
				$sumatoria+=$value->parcial;
				if($value->cantidad>0)
				{
					$value->precioUnitario=$value->parcial/$value->cantidad;
				}
				else
				{
					$value->precioUnitario=0;
				}
			}
			$recurso->childInsumo=$insumo;			
			$recurso->costoTotalRecurso=$sumatoria;
		}
		$html= $this->load->view('front/Ejecucion/Reporte/CronogramaRequerimiento',['expedienteTecnico'=>$expedienteTecnico,'recurso'=>$listarecurso, 'numeroReporte'=>$numeroReporte, 'nombreReporte'=>$nombreReporte],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper('letter', 'landscape');
		$this->mydompdf->render();
		$this->mydompdf->stream("CronogramaRequerimiento.pdf", array("Attachment" => false));
	}
}