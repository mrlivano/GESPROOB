<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Detalle_Formato extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_Dashboard_Reporte');
		$this->load->model('FuenteFinanciamiento_Model');
		$this->load->model('Model_ET_Detalle_Formatos');
		$this->load->model('Model_ET_Periodo_Ejecucion');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Cronograma_Ejecucion');
		$this->load->model('Model_ET_Cronograma_Componente');		
		$this->load->model('Model_DetSegOrden');
		$this->load->model('Model_ET_Fotografia_Formato');
		$this->load->helper('FormatNumber_helper');	
		$this->load->library('mydompdf');
	}

	public function InformeMensual()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
			$metaPresupuestal=explode("-", $this->input->post('metaPresupuestal'));
			$mes=$this->input->post('mes');
			$sec_ejec=$metaPresupuestal[0];
            $anio=$metaPresupuestal[1];
			$meta=$metaPresupuestal[2];
			$proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
			$fuenteFinanciamieto=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta); 
			$montoasignado=0;
			foreach($fuenteFinanciamieto as $key => $fuente)
			{
				$montoasignado+=$fuente->pim;
			}            
			$fechaReporte=$this->input->post('hdMes').' - '.$anio;
			$plazoPogramado=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Programado');
			$ampliacionPlazo=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Ampliacion');	
			$arrayPartidaEjecutada=[];
			$childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayPartidaEjecutada);
				}
			}
			$arrayAdicional=[];
			$childComponenteAdicional=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($childComponenteAdicional as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayAdicional);
				}
			}
			$detalleFormato=$this->Model_ET_Detalle_Formatos->getDetalleBy($idExpedienteTecnico, $anio, $meta, $sec_ejec, $mes);
			$detalleGeneral=$this->Model_ET_Detalle_Formatos->getDetalleByAnio($idExpedienteTecnico, $anio, $meta, $sec_ejec);
			$childManoObra='';
			$sumatoriaManodeObra='';
			if(count($detalleFormato)>0)
			{
				$childManoObra=$this->Model_ET_Detalle_Formatos->getManoObra($detalleFormato[0]->id_detalle);
				$sumatoriaManodeObra=$this->Model_ET_Detalle_Formatos->sumatoriaManodeObra($detalleFormato[0]->id_detalle);
			}

			$presupuestoProgramado=0;
			$presupuestoAnterior=0;
			$presupuestoActual=0;
			$ejecutadoAnterior=0;
			$ejecutadoActual=0;
			$adicionalProgramado=0;
			$adicionalAnterior=0;
			$adicionalActual=0;
			$costoIndirectoProgramado=0;
			$costoIndirectoAnterior=0;
			$costoIndirectoActual=0;
			$financieroAnterior=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('anterior', $meta, $sec_ejec, $anio, $mes);
			$financieroActual=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('actual', $meta, $sec_ejec, $anio, $mes);			
			$componenteTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->avanceFisicoProgramado($item, $anio, (int)$mes, $presupuestoProgramado, $presupuestoAnterior, $presupuestoActual);
					$this->avanceFisicoEjecutado($item, $anio, (int)$mes, $ejecutadoAnterior, $ejecutadoActual);
				}
			}

			$adicionalTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($adicionalTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->adicionalProgramado($item, $anio, $adicionalProgramado);
					$this->adicionalEjecutado($item, $anio, (int)$mes, $adicionalAnterior, $adicionalActual);
				}
			}			
			$componenteIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteIndirecto as $key => $value)
			{
				$programacion=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $anio);
				foreach ($programacion as $index => $item)
				{
					$costoIndirectoProgramado+=$item->precio;
					if($item->numero_mes<$mes)
					{
						$costoIndirectoAnterior+=$item->precio;
					}
					if($item->numero_mes==$mes)
					{
						$costoIndirectoActual+=$item->precio;
					}
				}
			}

			$this->load->view('Front/Ejecucion/InformeMensual/fichaInforme', ['idExpedienteTecnico'=>$idExpedienteTecnico,'metaPresupuestal'=>$this->input->post('metaPresupuestal'),'mes'=>$mes,'proyectoInversion'=>$proyectoInversion,'fuenteFinanciamieto'=>$fuenteFinanciamieto,'montoasignado'=>$montoasignado,'plazoPogramado'=>$plazoPogramado,'ampliacionPlazo'=>$ampliacionPlazo,'arrayPartidaEjecutada'=>$arrayPartidaEjecutada,'arrayAdicional'=>$arrayAdicional,'detalleFormato'=>$detalleFormato,'childManoObra'=>$childManoObra,'sumatoriaManodeObra'=>$sumatoriaManodeObra,'fechaReporte'=>$fechaReporte,'presupuestoProgramado'=>$presupuestoProgramado,'presupuestoAnterior'=>$presupuestoAnterior,'presupuestoActual'=>$presupuestoActual,
			'ejecutadoAnterior'=>$ejecutadoAnterior,'ejecutadoActual'=>$ejecutadoActual,'adicionalProgramado'=>$adicionalProgramado,'adicionalAnterior'=>$adicionalAnterior,'adicionalActual'=>$adicionalActual,'costoIndirectoProgramado'=>$costoIndirectoProgramado,'costoIndirectoAnterior'=>$costoIndirectoAnterior, 'costoIndirectoActual'=>$costoIndirectoActual,'financieroAnterior'=>$financieroAnterior,
			'financieroActual'=>$financieroActual,'detalleGeneral'=>$detalleGeneral]);        
		}	
	}

	public function ReporteFE01()
	{
		if($_POST)
		{

			$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
			$metaPresupuestal=explode("-", $this->input->post('metaPresupuestal'));
			$mes=$this->input->post('mes');
			$sec_ejec=$metaPresupuestal[0];
      $anio=$metaPresupuestal[1];
			$meta=$metaPresupuestal[2];
			$proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
			$fuenteFinanciamieto=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta); 
			$montoasignado=0;
			foreach($fuenteFinanciamieto as $key => $fuente)
			{
				$montoasignado+=$fuente->pim;
			}    
			$fechaReporte=$this->input->post('hdMes').' - '.$anio;  
			$plazoPogramado=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Programado');
			$ampliacionPlazo=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Ampliacion');	
			$arrayPartidaEjecutada=[];
			$childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayPartidaEjecutada);
				}
			}
			$arrayAdicional=[];
			$childComponenteAdicional=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($childComponenteAdicional as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayAdicional);
				}
			}
			$detalleFormato=$this->Model_ET_Detalle_Formatos->getDetalleBy($idExpedienteTecnico, $anio, $meta, $sec_ejec, $mes);
			foreach($detalleFormato as $detalle)
			{
				$detalle->childFotografia=$this->Model_ET_Fotografia_Formato->listaFotografia($detalle->id_detalle);
			}
			$childManoObra='';
			$sumatoriaManodeObra='';
			if(count($detalleFormato)>0)
			{
				$childManoObra=$this->Model_ET_Detalle_Formatos->getManoObra($detalleFormato[0]->id_detalle);
				$sumatoriaManodeObra=$this->Model_ET_Detalle_Formatos->sumatoriaManodeObra($detalleFormato[0]->id_detalle);
			}

			$presupuestoProgramado=0;
			$presupuestoAnterior=0;
			$presupuestoActual=0;
			$ejecutadoAnterior=0;
			$ejecutadoActual=0;
			$adicionalProgramado=0;
			$adicionalAnterior=0;
			$adicionalActual=0;
			$costoIndirectoProgramado=0;
			$costoIndirectoAnterior=0;
			$costoIndirectoActual=0;
			$financieroAnterior=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('anterior', $meta, $sec_ejec, $anio, $mes);
			$financieroActual=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('actual', $meta, $sec_ejec, $anio, $mes);			
			$componenteTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->avanceFisicoProgramado($item, $anio, (int)$mes, $presupuestoProgramado, $presupuestoAnterior, $presupuestoActual);
					$this->avanceFisicoEjecutado($item, $anio, (int)$mes, $ejecutadoAnterior, $ejecutadoActual);
				}
			}

			$adicionalTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($adicionalTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->adicionalProgramado($item, $anio, $adicionalProgramado);
					$this->adicionalEjecutado($item, $anio, (int)$mes, $adicionalAnterior, $adicionalActual);
				}
			}			
			$componenteIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteIndirecto as $key => $value)
			{
				$programacion=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $anio);
				foreach ($programacion as $index => $item)
				{
					$costoIndirectoProgramado+=$item->precio;
					if($item->numero_mes<$mes)
					{
						$costoIndirectoAnterior+=$item->precio;
					}
					if($item->numero_mes==$mes)
					{
						$costoIndirectoActual+=$item->precio;
					}
				}
			}

			$html=$this->load->view('Front/Ejecucion/InformeMensual/reporteFE01', ['proyectoInversion'=>$proyectoInversion,'fuenteFinanciamieto'=>$fuenteFinanciamieto,'montoasignado'=>$montoasignado,'plazoPogramado'=>$plazoPogramado,'ampliacionPlazo'=>$ampliacionPlazo,'arrayPartidaEjecutada'=>$arrayPartidaEjecutada,'arrayAdicional'=>$arrayAdicional,'detalleFormato'=>$detalleFormato,'childManoObra'=>$childManoObra,'sumatoriaManodeObra'=>$sumatoriaManodeObra,'fechaReporte'=>$fechaReporte,'presupuestoProgramado'=>$presupuestoProgramado,'presupuestoAnterior'=>$presupuestoAnterior,'presupuestoActual'=>$presupuestoActual,
			'ejecutadoAnterior'=>$ejecutadoAnterior,'ejecutadoActual'=>$ejecutadoActual,'adicionalProgramado'=>$adicionalProgramado,'adicionalAnterior'=>$adicionalAnterior,'adicionalActual'=>$adicionalActual,'costoIndirectoProgramado'=>$costoIndirectoProgramado,'costoIndirectoAnterior'=>$costoIndirectoAnterior, 'costoIndirectoActual'=>$costoIndirectoActual,'financieroAnterior'=>$financieroAnterior,
			'financieroActual'=>$financieroActual], true);
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("FormatoFE-02.pdf", array("Attachment" => false));      
		}	
	}

	public function reportePdf()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('hdIdExpedienteTecnico');
			$metaPresupuestal=explode("-", $this->input->post('hdMetaPresupuestal'));
			$mes=$this->input->post('hdMes');
			$sec_ejec=$metaPresupuestal[0];
            $anio=$metaPresupuestal[1];
			$meta=$metaPresupuestal[2];
			$proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
			$fuenteFinanciamieto=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta); 
			$montoasignado=0;
			foreach($fuenteFinanciamieto as $key => $fuente)
			{
				$montoasignado+=$fuente->pim;
			}            
			$fechaReporte=$this->input->post('hdFechaReporte');
			$plazoPogramado=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Programado');
			$ampliacionPlazo=$this->Model_ET_Periodo_Ejecucion->plazoPorDescripcion($idExpedienteTecnico,'Ampliacion');	
			$arrayPartidaEjecutada=[];
			$childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayPartidaEjecutada);
				}
			}
			$arrayAdicional=[];
			$childComponenteAdicional=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($childComponenteAdicional as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidada($item, $anio, $mes, $arrayAdicional);
				}
			}
			$detalleFormato=$this->Model_ET_Detalle_Formatos->getDetalleBy($idExpedienteTecnico, $anio, $meta, $sec_ejec, $mes);
			foreach($detalleFormato as $detalle)
			{
				$detalle->childFotografia=$this->Model_ET_Fotografia_Formato->listaFotografia($detalle->id_detalle);
			}
			$childManoObra='';
			$sumatoriaManodeObra='';
			if(count($detalleFormato)>0)
			{
				$childManoObra=$this->Model_ET_Detalle_Formatos->getManoObra($detalleFormato[0]->id_detalle);
				$sumatoriaManodeObra=$this->Model_ET_Detalle_Formatos->sumatoriaManodeObra($detalleFormato[0]->id_detalle);
			}

			$presupuestoProgramado=0;
			$presupuestoAnterior=0;
			$presupuestoActual=0;
			$ejecutadoAnterior=0;
			$ejecutadoActual=0;
			$adicionalProgramado=0;
			$adicionalAnterior=0;
			$adicionalActual=0;
			$costoIndirectoProgramado=0;
			$costoIndirectoAnterior=0;
			$costoIndirectoActual=0;
			$financieroAnterior=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('anterior', $meta, $sec_ejec, $anio, $mes);
			$financieroActual=$this->Model_Dashboard_Reporte->ConsultaDevengadoMes('actual', $meta, $sec_ejec, $anio, $mes);			
			$componenteTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->avanceFisicoProgramado($item, $anio, (int)$mes, $presupuestoProgramado, $presupuestoAnterior, $presupuestoActual);
					$this->avanceFisicoEjecutado($item, $anio, (int)$mes, $ejecutadoAnterior, $ejecutadoActual);
				}
			}

			$adicionalTemp=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'ADICIONAL');			
			foreach ($adicionalTemp as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach ($value->childMeta as $index => $item)
				{
					$this->adicionalProgramado($item, $anio, $adicionalProgramado);
					$this->adicionalEjecutado($item, $anio, (int)$mes, $adicionalAnterior, $adicionalActual);
				}
			}			
			$componenteIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');			
			foreach ($componenteIndirecto as $key => $value)
			{
				$programacion=$this->Model_ET_Cronograma_Componente->ETCronogramaPorIdComponente($value->id_componente, $anio);
				foreach ($programacion as $index => $item)
				{
					$costoIndirectoProgramado+=$item->precio;
					if($item->numero_mes<$mes)
					{
						$costoIndirectoAnterior+=$item->precio;
					}
					if($item->numero_mes==$mes)
					{
						$costoIndirectoActual+=$item->precio;
					}
				}
			}

			// $html=$this->load->view('Front/Ejecucion/ProgramacionClasificador/formatopdf', ['proyectoInversion'=>$proyectoInversion,'listaMeses'=>$listaMeses,'PresupuestoEjecucion'=>$PresupuestoEjecucion,'sumatoriaProgramado'=>$sumatoriaProgramado,'montoTotalFuente'=>$montoTotalFuente,'fuenteFinanciamiento'=>$fuenteFinanciamiento,'fechaReporte'=>$fechaReporte,'correlativo'=>$correlativo],true);                        
            // $this->mydompdf->set_paper('A4','landscape');
            // $this->mydompdf->load_html($html);
            // $this->mydompdf->render();
            // $this->mydompdf->stream("FormatoFE-06.pdf", array("Attachment" => false));

			$html=$this->load->view('Front/Ejecucion/InformeMensual/reporte', ['proyectoInversion'=>$proyectoInversion,'fuenteFinanciamieto'=>$fuenteFinanciamieto,'montoasignado'=>$montoasignado,'plazoPogramado'=>$plazoPogramado,'ampliacionPlazo'=>$ampliacionPlazo,'arrayPartidaEjecutada'=>$arrayPartidaEjecutada,'arrayAdicional'=>$arrayAdicional,'detalleFormato'=>$detalleFormato,'childManoObra'=>$childManoObra,'sumatoriaManodeObra'=>$sumatoriaManodeObra,'fechaReporte'=>$fechaReporte,'presupuestoProgramado'=>$presupuestoProgramado,'presupuestoAnterior'=>$presupuestoAnterior,'presupuestoActual'=>$presupuestoActual,
			'ejecutadoAnterior'=>$ejecutadoAnterior,'ejecutadoActual'=>$ejecutadoActual,'adicionalProgramado'=>$adicionalProgramado,'adicionalAnterior'=>$adicionalAnterior,'adicionalActual'=>$adicionalActual,'costoIndirectoProgramado'=>$costoIndirectoProgramado,'costoIndirectoAnterior'=>$costoIndirectoAnterior, 'costoIndirectoActual'=>$costoIndirectoActual,'financieroAnterior'=>$financieroAnterior,
			'financieroActual'=>$financieroActual], true);
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("FormatoFE-02.pdf", array("Attachment" => false));
		}
	}

	public function guardarDetalleFormato()
	{
		if($_POST)
		{
			$this->db->trans_start();
			$idExpedienteTecnico=$this->input->post('hdIdExpedienteTecnico');
			$metaPresupuestal=explode("-", $this->input->post('hdMetaPresupuestal'));
			$mes=$this->input->post('hdMes');
			$sec_ejec=$metaPresupuestal[0];
            $anio=$metaPresupuestal[1];
			$meta=$metaPresupuestal[2];
			$detalleFormato=$this->Model_ET_Detalle_Formatos->getDetalleBy($idExpedienteTecnico, $anio, $meta, $sec_ejec, $mes);
			if(count($detalleFormato)==0)
			{
				$c_data['id_et']=$idExpedienteTecnico;
				$c_data['meta']=$meta;
				$c_data['anio']=$anio;
				$c_data['sec_ejec']=$sec_ejec;
				$c_data['mes']=$mes;
				$c_data['plazo_ejecucion_real']=$this->input->post('txtPlazoEjecReal');
				$c_data['descripcion_partidas_ejecutadas']=$this->input->post('txtPartidasEjecutadas');
				$c_data['descripcion_adicionales']=$this->input->post('txtAdicionales');
				$c_data['presupuesto_prog_mo']=$this->input->post('txtProgramado');
				$c_data['presupuesto_prog_anterior']=$this->input->post('txtProgramadoAnterior');
				$c_data['presupuesto_prog_actual']=$this->input->post('txtProgramadoActual');
				$c_data['presupuesto_ejec_mo']=$this->input->post('txtEjecutado');
				$c_data['presupuesto_ejec_anterior']=$this->input->post('txtEjecutadoAnterior');
				$c_data['presupuesto_ejec_actual']=$this->input->post('txtEjecutadoActual');
				$c_data['descripcion_observaciones']=$this->input->post('txtObservaciones');
				$c_data['descripcion_ocurrencias']=$this->input->post('txtOcurrencias');
				$c_data['del_folio']=$this->input->post('txtDelFolio');
				$c_data['al_folio']=$this->input->post('txtAlFolio');
				$c_data['region']=$this->input->post('txtRegion');
				$c_data['provincia']=$this->input->post('txtProvincia');
				$c_data['distrito']=$this->input->post('txtDistrito');
				$c_data['direccion']=$this->input->post('txtDireccion');
				$c_data['residente ']=$this->input->post('txtResidente');
				$c_data['supervisor ']=$this->input->post('txtSupervisor');
				$c_data['asistente_administrativo ']=$this->input->post('txtAsistenteAdministrativo');
				$data=$this->Model_ET_Detalle_Formatos->insertar($c_data);
				for($i=1; $i<=5; $i++)
				{
					$cmo_data['id_detalle']=$data;
					$cmo_data['nro_semana']=$i;
					$cmo_data['de_fecha']=($this->input->post('txtDeSemana'.$i)=='' ? null : $this->input->post('txtDeSemana'.$i));
					$cmo_data['a_fecha']=($this->input->post('txtASemana'.$i)=='' ? null : $this->input->post('txtASemana'.$i));
					$cmo_data['jornal_peon']=($this->input->post('txtJornalPeon'.$i)=='' ? null : $this->input->post('txtJornalPeon'.$i));
					$cmo_data['jornal_oficial']=($this->input->post('txtJornalOficial'.$i)=='' ? null : $this->input->post('txtJornalOficial'.$i));
					$cmo_data['jornal_operario']=($this->input->post('txtJornalOperario'.$i)=='' ? null : $this->input->post('txtJornalOperario'.$i));
					$cmo_data['monto_peon']=($this->input->post('txtMontoPeon'.$i)=='' ? null : $this->input->post('txtMontoPeon'.$i));
					$cmo_data['monto_oficial']=($this->input->post('txtMontoOficial'.$i)=='' ? null : $this->input->post('txtMontoOficial'.$i));
					$cmo_data['monto_operario']=($this->input->post('txtMontoOperario'.$i)=='' ? null : $this->input->post('txtMontoOperario'.$i));	
					$manoObra=$this->Model_ET_Detalle_Formatos->insertarManoObra($cmo_data);	
				}
			}
			else
			{
				$u_data['plazo_ejecucion_real']=$this->input->post('txtPlazoEjecReal');
				$u_data['descripcion_partidas_ejecutadas']=$this->input->post('txtPartidasEjecutadas');
				$u_data['descripcion_adicionales']=$this->input->post('txtAdicionales');
				$u_data['presupuesto_prog_mo']=$this->input->post('txtProgramado');
				$u_data['presupuesto_prog_anterior']=$this->input->post('txtProgramadoAnterior');
				$u_data['presupuesto_prog_actual']=$this->input->post('txtProgramadoActual');
				$u_data['presupuesto_ejec_mo']=$this->input->post('txtEjecutado');
				$u_data['presupuesto_ejec_anterior']=$this->input->post('txtEjecutadoAnterior');
				$u_data['presupuesto_ejec_actual']=$this->input->post('txtEjecutadoActual');
				$u_data['descripcion_observaciones']=$this->input->post('txtObservaciones');
				$u_data['descripcion_ocurrencias']=$this->input->post('txtOcurrencias');
				$u_data['del_folio']=$this->input->post('txtDelFolio');
				$u_data['al_folio']=$this->input->post('txtAlFolio');
				$u_data['region']=$this->input->post('txtRegion');
				$u_data['provincia']=$this->input->post('txtProvincia');
				$u_data['distrito']=$this->input->post('txtDistrito');
				$u_data['direccion']=$this->input->post('txtDireccion');				
				$u_data['residente ']=$this->input->post('txtResidente');
				$u_data['supervisor ']=$this->input->post('txtSupervisor');
				$u_data['asistente_administrativo ']=$this->input->post('txtAsistenteAdministrativo');
				$data=$this->Model_ET_Detalle_Formatos->editar($detalleFormato[0]->id_detalle, $u_data);
				for($i=1; $i<=5; $i++)
				{
					$umo_data['de_fecha']=($this->input->post('txtDeSemana'.$i)=='' ? null : $this->input->post('txtDeSemana'.$i));
					$umo_data['a_fecha']=($this->input->post('txtASemana'.$i)=='' ? null : $this->input->post('txtASemana'.$i));
					$umo_data['jornal_peon']=($this->input->post('txtJornalPeon'.$i)=='' ? null : $this->input->post('txtJornalPeon'.$i));
					$umo_data['jornal_oficial']=($this->input->post('txtJornalOficial'.$i)=='' ? null : $this->input->post('txtJornalOficial'.$i));
					$umo_data['jornal_operario']=($this->input->post('txtJornalOperario'.$i)=='' ? null : $this->input->post('txtJornalOperario'.$i));
					$umo_data['monto_peon']=($this->input->post('txtMontoPeon'.$i)=='' ? null : $this->input->post('txtMontoPeon'.$i));
					$umo_data['monto_oficial']=($this->input->post('txtMontoOficial'.$i)=='' ? null : $this->input->post('txtMontoOficial'.$i));
					$umo_data['monto_operario']=($this->input->post('txtMontoOperario'.$i)=='' ? null : $this->input->post('txtMontoOperario'.$i));		
					$manoObra=$this->Model_ET_Detalle_Formatos->editarManoObra($detalleFormato[0]->id_detalle,$i,$umo_data);	
				}
			}
			$this->db->trans_complete();

			$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
			echo json_encode($msg);exit;

		}
	}

	public function guardarFotografia()
	{
		if($_POST)
		{
			$this->db->trans_start();
			$msg = array();
			$idDetalleFormato=$this->input->post('idDetalleFormato');
			$nombreArchivo = $_FILES['fileFotografia']['name'];
			$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);			
			$c_data['id_detalle']=$idDetalleFormato;
			$c_data['descripcion']=$this->input->post('txtDescripcion');
			$c_data['extension']='.'.$extension;	

			$data=$this->Model_ET_Fotografia_Formato->insertar($c_data);

			$config['upload_path'] = './uploads/InformeMensual/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $data;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('fileFotografia'))
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
				echo json_encode($msg);exit;
			}		

			$this->db->trans_complete();

			$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
			echo json_encode($msg);exit;
		}

		$idDetalleFormato=$this->input->get('idDetalleFormato');

		$listaFotografia=$this->Model_ET_Fotografia_Formato->listaFotografia($idDetalleFormato);
		
		$this->load->view('Front/Ejecucion/InformeMensual/fotografia', ['idDetalleFormato'=>$idDetalleFormato, 'listaFotografia'=>$listaFotografia]); 
	}

	public function eliminarFotografia()
	{
		if($_POST)
		{
			$idFotografia=$this->input->post('codigo');
			$extension=$this->input->post('extension');
			$data=$this->Model_ET_Fotografia_Formato->eliminar($idFotografia);
			if (file_exists("uploads/InformeMensual/".$idFotografia.$extension))
			{
				unlink("uploads/InformeMensual/".$idFotografia.$extension);
			}
			$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
			echo json_encode($msg);exit;
		}
	}

	private function obtenerMetaAnidada($meta, $anio, $mes, &$arrayPartidaEjecutada)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);
		$meta->childMeta=$temp;
		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $partida)
			{
				$partidaEjecutada=$this->Model_ET_Detalle_Partida->partidasEjecutada($partida->id_detalle_partida, $anio, $mes);
				if(count($partidaEjecutada)>0)
				{
					if($partidaEjecutada[0]->cantidad!='')
					{
						$partida->metradoEjecutado=$partidaEjecutada[0]->cantidad;
						$arrayPartidaEjecutada[]=$partida;
					}					
				}
			}
		}
		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidada($value, $anio, $mes, $arrayPartidaEjecutada);
		}
	}

	private function avanceFisicoProgramado($meta, $anio, $mes, &$presupuestoProgramado, &$presupuestoAnterior, &$presupuestoActual)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);
		$meta->childMeta=$temp;
		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $partida)
			{
				$partidaProgramada=$this->Model_ET_Cronograma_Ejecucion->ETCronogramaPorIdDetallePartida($partida->id_detalle_partida, $anio);

				foreach($partidaProgramada as $programacion)
				{
					$presupuestoProgramado+=$programacion->precio;
					if($programacion->numero_mes<$mes)
					{
						$presupuestoAnterior+=$programacion->precio;
					}
					if($programacion->numero_mes==$mes)
					{
						$presupuestoActual+=$programacion->precio;
					}					
				}
			}
		}
		foreach($meta->childMeta as $key => $value)
		{
			$this->avanceFisicoProgramado($value, $anio, $mes, $presupuestoProgramado, $presupuestoAnterior, $presupuestoActual);
		}
	}

	private function avanceFisicoEjecutado($meta, $anio, $mes, &$ejecutadoAnterior, &$ejecutadoActual)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);
		$meta->childMeta=$temp;
		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $partida)
			{
				$partidaEjecutada=$this->Model_DetSegOrden->partidaEjecutada($partida->id_detalle_partida, $anio);

				foreach($partidaEjecutada as $ejecucion)
				{
					if($ejecucion->mes<$mes)
					{
						$ejecutadoAnterior+=$ejecucion->precio;
					}
					if($ejecucion->mes==$mes)
					{
						$ejecutadoActual+=$ejecucion->precio;
					}					
				}
			}
		}
		foreach($meta->childMeta as $key => $value)
		{
			$this->avanceFisicoEjecutado($value, $anio, $mes, $ejecutadoAnterior, $ejecutadoActual);
		}
	}

	private function adicionalProgramado($meta, $anio, &$adicionalProgramado)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);
		$meta->childMeta=$temp;
		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $partida)
			{
				$partidaProgramada=$this->Model_ET_Cronograma_Ejecucion->ETCronogramaPorIdDetallePartida($partida->id_detalle_partida, $anio);

				foreach($partidaProgramada as $programacion)
				{
					$adicionalProgramado+=$programacion->precio;				
				}
			}
		}
		foreach($meta->childMeta as $key => $value)
		{
			$this->adicionalProgramado($value, $anio, $adicionalProgramado);
		}
	}

	private function adicionalEjecutado($meta, $anio, $mes, &$adicionalAnterior, &$adicionalActual)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);
		$meta->childMeta=$temp;
		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $partida)
			{
				$partidaEjecutada=$this->Model_DetSegOrden->partidaEjecutada($partida->id_detalle_partida, $anio);

				foreach($partidaEjecutada as $ejecucion)
				{
					if($ejecucion->mes<$mes)
					{
						$adicionalAnterior+=$ejecucion->precio;
					}
					if($ejecucion->mes==$mes)
					{
						$adicionalActual+=$ejecucion->precio;
					}					
				}
			}
		}
		foreach($meta->childMeta as $key => $value)
		{
			$this->adicionalEjecutado($value, $anio, $mes, $adicionalAnterior, $adicionalActual);
		}
	}

}