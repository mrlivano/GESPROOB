<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manifiesto_Gasto extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Model_ET_Expediente_Tecnico');
        $this->load->model('Model_Dashboard_Reporte');
        $this->load->model('Model_ET_Presupuesto_Ejecucion');
        $this->load->model('Model_ET_Manifiesto_Gasto');
        $this->load->model('Model_ET_Presupuesto_Analitico');    
        $this->load->model('Model_ET_Programacion_Analitico');   
        $this->load->model('Model_ET_Detalle_Formatos');             
        $this->load->library('mydompdf');
	}

	public function insertar()
	{
		if($_POST)
		{	
            $data = 0;
            $idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
            $idManifiesto=$this->input->post('idManifiesto');
            $expedienteSiaf=$this->input->post('expedienteSiaf');
            $meta=$this->input->post('meta');
            $anio=$this->input->post('anio');

            $manifiesto = $this->Model_ET_Manifiesto_Gasto->getManifiestoGastoById($idManifiesto);

            if(count($manifiesto)==0)
            {
                $c_data['expediente_siaf']=$expedienteSiaf;
                $c_data['meta']=$meta;
                $c_data['anio']=$anio;
                $c_data['clase_documento']=$this->input->post('tipoDocumento');
                $c_data['nombre_proveedor']=$this->input->post('proveedor');
                $c_data['detalle_gasto']=$this->input->post('detalleGasto');
                $c_data['id_presupuesto_ej']=$this->input->post('idPresupuesto');
                $c_data['id_et']=$idExpedienteTecnico;
                $c_data['numero_documento']=$this->input->post('numeroDocumento');
                $c_data['numero_comprobante']=$this->input->post('numeroComprobante');
                $c_data['numero_clasificador']=$this->input->post('numeroClasificador');
                $c_data['mes']=$this->input->post('mes');
                $c_data['monto']=$this->input->post('monto');
                $c_data['sec_ejec']=$this->input->post('sec_ejec');
                $c_data['fuente_financ']=$this->input->post('fuenteFinanciamiento');
                $data=$this->Model_ET_Manifiesto_Gasto->insertar($c_data);
            }
            else
            {
                $u_data['clase_documento']=$this->input->post('tipoDocumento');
                $u_data['nombre_proveedor']=$this->input->post('proveedor');
                $u_data['detalle_gasto']=$this->input->post('detalleGasto');
                $u_data['id_presupuesto_ej']=$this->input->post('idPresupuesto');
                $u_data['numero_documento']=$this->input->post('numeroDocumento');
                $u_data['numero_comprobante']=$this->input->post('numeroComprobante');
                $u_data['numero_clasificador']=$this->input->post('numeroClasificador');
                $u_data['mes']=$this->input->post('mes');
                $u_data['monto']=$this->input->post('monto');
                $u_data['sec_ejec']=$this->input->post('sec_ejec');
                $u_data['fuente_financ']=$this->input->post('fuenteFinanciamiento');

                $data=$this->Model_ET_Manifiesto_Gasto->editar($u_data, $manifiesto[0]->id_manifiestoGasto);
            }

            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardardos correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;                     
        }
        else
        {
            $idExpedienteTecnico=$this->input->get('idExpedienteTecnico');
            $mes=$this->listaMeses();    
            $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
            $codigoUnico=$proyectoInversion->codigo_unico_pi;
            $metaPresupuestal=$this->Model_Dashboard_Reporte->ConsultaMetaProyecto($codigoUnico);
            $this->load->view('layout/Ejecucion/header');	
            $this->load->view('Front/Ejecucion/ManifiestoGasto/index', ['mes' => $mes, 'idExpedienteTecnico'=>$idExpedienteTecnico,'metaPresupuestal'=>$metaPresupuestal]);
            $this->load->view('layout/Ejecucion/footer');	
        }	
	}

    public function busquedaManifiesto()
    {
        $idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
        $metaPresupuestal=$this->input->post('metaPresupuestal');
        $fuenteFinanciamiento=$this->input->post('fuenteFinanciamiento');
        $mes=$this->input->post('mes');
        $objeto = explode("-", $metaPresupuestal);
        $sec_ejec=$objeto[0];
        $anio=$objeto[1];
        $correlativoMeta=$objeto[2];
        $listaExpDev=$this->Model_Dashboard_Reporte->ExpedienteDevengadoMeta($sec_ejec, $correlativoMeta, $anio, $mes, $fuenteFinanciamiento);
        $gastoTotalManifiesto = 0;
        foreach($listaExpDev as $key => $value)
        {
            $gastoTotalManifiesto += $value->total_documento;
            $value->ano_eje = $anio;
            $value->meta = $correlativoMeta;
            $value->sec_ejec = $sec_ejec;
            $value->mes = $mes;            
            $value->tipo_doc = 'PLANILLA';
            $tipoDocumento=$this->Model_Dashboard_Reporte->ConsultaTipoDocumento($value->expediente, $anio);
            $clasificador=$this->Model_Dashboard_Reporte->ConsultaClasificadorExpediente($value->expediente, $correlativoMeta, $anio);
            $value->num_clasificador=str_replace(" ","",$clasificador[0]->num_clasificador);
            $value->clasificador=trim($clasificador[0]->descripcion);            
            if(count($tipoDocumento)>0)
            {
                $value->nro_documento = $tipoDocumento[0]->num_doc;
                $pos = stripos($tipoDocumento[0]->num_doc, 'MEM');
                if($pos!==false)
                {
                    $value->tipo_doc = 'MEMO';
                }
            }
            $comprobante=$this->Model_Dashboard_Reporte->ConsultaComprobantePago($value->expediente, $anio);
            
            if(count($comprobante)>0)
            {
                $value->nro_comprobante = $comprobante[0]->num_doc;
            }

            $proveedor=$this->Model_Dashboard_Reporte->ConsultaNombreComprobante($value->expediente, $anio);
            $numerogiro = count($proveedor);

            if($numerogiro>0)
            {
                $value->nombre_proveedor = $proveedor[0]->nombre;
            }

            $OrdenSiga=$this->Model_Dashboard_Reporte->DatosOrdenSiga((int)$correlativoMeta, (int)$tipoDocumento[0]->num_doc, $anio, (int)$tipoDocumento[0]->expediente);

            if(count($OrdenSiga)!=0)
            {
                if($OrdenSiga[0]->TIPO_BIEN=='S')
                {
                    $value->tipo_doc = 'O/S';
                }
                if($OrdenSiga[0]->TIPO_BIEN=='B')
                {
                    $value->tipo_doc = 'O/C';
                } 

                $value->nro_orden=$OrdenSiga[0]->NRO_ORDEN;
                $value->nombre_proveedor=$OrdenSiga[0]->NOMBRE_PROV;
                $value->tipo_bien=$OrdenSiga[0]->TIPO_BIEN;
                $detalleGasto=$this->Model_Dashboard_Reporte->ConsultaDetalleOrden($OrdenSiga[0]->NRO_ORDEN, $OrdenSiga[0]->TIPO_BIEN, $OrdenSiga[0]->TIPO_PPTO, $OrdenSiga[0]->SEC_EJEC, $OrdenSiga[0]->ANO_EJE);
                $value->cantidadDetalle = count($detalleGasto);
                $value->childDetalleGasto = $detalleGasto;       
            }

            $manifiesto = $this->Model_ET_Manifiesto_Gasto->getManifiestoGasto((int)$value->expediente, $correlativoMeta, $anio, $idExpedienteTecnico);

            if(count($manifiesto)>0)
            {
                $value->id_manifiestoGasto=$manifiesto[0]->id_manifiestoGasto;
                $value->id_presupuesto=$manifiesto[0]->id_presupuesto_ej;
                $value->tipo_doc=$manifiesto[0]->clase_documento;
                $value->nombre_proveedor=$manifiesto[0]->nombre_proveedor;        
                $value->detalle_gasto=$manifiesto[0]->detalle_gasto;
            }
        }

        $PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

		foreach ($PresupuestoEjecucion as $key => $temporal) 
		{
            $presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($temporal->id_presupuesto_ej);            
            $temporal->numHijos=count($presupuesto);
			if(count($presupuesto)>0)
			{
				$temporal->childPresupuesto=$presupuesto;
			}
        }
        $this->load->view('Front/Ejecucion/ManifiestoGasto/tablaManifiestoGasto', ['listaExpDev' => $listaExpDev,'gastoTotalManifiesto'=>$gastoTotalManifiesto,'PresupuestoEjecucion'=>$PresupuestoEjecucion,'idExpedienteTecnico'=>$idExpedienteTecnico]);	
    }

    public function busquedaEjecucionPresupuestal()
    {
        if($_POST)
		{  
            $idExpedienteTecnico=$this->input->post('idExpedienteTecnico');     
            $objeto = explode("-", $this->input->post('metaPresupuestal'));  
            $fuenteFinanciamiento=$this->input->post('fuenteFinanciamiento');       
            $mes=$this->input->post('mes');    
            $sec_ejec=$objeto[0];        
            $anio=$objeto[1];
            $meta=$objeto[2];
            $clasificadorMeta=$this->Model_Dashboard_Reporte->ConsultaClasificadorMeta($meta, $anio);
            foreach($clasificadorMeta as $clasif)
            {                
                $clasif->num_clasificador=str_replace(" ","",$clasif->num_clasificador);             
            }
    
            $listaExpDev=$this->Model_Dashboard_Reporte->ExpedienteDevengadoMeta($sec_ejec, $meta, $anio, $mes, $fuenteFinanciamiento);    
            $gastoTotalManifiesto = 0;    
            foreach($listaExpDev as $key => $value)
            {
                $gastoTotalManifiesto += $value->total_documento;
                $tipoDocumento=$this->Model_Dashboard_Reporte->ConsultaTipoDocumento($value->expediente, $anio);
                $OrdenSiga=$this->Model_Dashboard_Reporte->DatosOrdenSiga((int)$meta, (int)$tipoDocumento[0]->num_doc, $anio, (int)$tipoDocumento[0]->expediente);
                if(count($OrdenSiga)!=0)
                {
                    $value->nro_orden=$OrdenSiga[0]->NRO_ORDEN;    
                    $value->tipo_bien=$OrdenSiga[0]->TIPO_BIEN;    
                    $detalleGasto=$this->Model_Dashboard_Reporte->ConsultaDetalleOrden($OrdenSiga[0]->NRO_ORDEN, $OrdenSiga[0]->TIPO_BIEN, $OrdenSiga[0]->TIPO_PPTO, $OrdenSiga[0]->SEC_EJEC, $OrdenSiga[0]->ANO_EJE);                       
                    $value->cantidadDetalle = count($detalleGasto);    
                    $value->childDetalleGasto = $detalleGasto;       
                }
    
                $manifiesto = $this->Model_ET_Manifiesto_Gasto->getManifiestoGasto((int)$value->expediente, $meta, $anio, $idExpedienteTecnico);    
                if(count($manifiesto)>0)
                {
                    $value->tipo_doc=$manifiesto[0]->clase_documento;    
                    $value->num_doc=$manifiesto[0]->numero_documento;    
                    $value->num_comprobante=$manifiesto[0]->numero_comprobante;   
                    $value->detalle_gasto=$manifiesto[0]->detalle_gasto;
                    $value->id_presupuesto=$manifiesto[0]->id_presupuesto_ej;   
                    $value->num_clasificador=$manifiesto[0]->numero_clasificador;                  
                }
            }              
            $this->load->view('Front/Ejecucion/EjecucionPresupuestal/tablaEjecucionPresupuestal', ['listaExpDev' => $listaExpDev,'gastoTotalManifiesto'=>$gastoTotalManifiesto,'idExpedienteTecnico'=>$idExpedienteTecnico, 'clasificadorMeta'=>$clasificadorMeta]);                
        }
        else
        {
            $idExpedienteTecnico=$this->input->get('idExpedienteTecnico');
            $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
            $metaPresupuestal=$this->Model_Dashboard_Reporte->ConsultaMetaProyecto($proyectoInversion->codigo_unico_pi);
            $mes=$this->listaMeses();        
            $this->load->view('layout/Ejecucion/header');	
            $this->load->view('Front/Ejecucion/EjecucionPresupuestal/index', ['mes' => $mes, 'idExpedienteTecnico'=>$idExpedienteTecnico,'metaPresupuestal'=>$metaPresupuestal ]);
            $this->load->view('layout/Ejecucion/footer');	
        }
    }

    public function reportePdf()
    { 
        $idExpedienteTecnico=$this->input->post('hdIdExpedienteTecnico');
        $metaPresupuestal=explode("-", $this->input->post('selectMetaPresupuestal'));
        $fuenteFinanciamiento=$this->input->post('selectFuenteFinanciamiento');  
        $mes=$this->input->post('selectMes');
        $sec_ejec=$metaPresupuestal[0];  
        $anio=$metaPresupuestal[1];  
        $correlativoMeta=$metaPresupuestal[2];        
        $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
        $listaExpDev=$this->Model_Dashboard_Reporte->ExpedienteDevengadoMeta($sec_ejec, $correlativoMeta, $anio, $mes, $fuenteFinanciamiento);
        $gastoTotalManifiesto=0;
        foreach($listaExpDev as $key => $value)
        {
            $gastoTotalManifiesto += $value->total_documento;
            $value->ano_eje = $anio;
            $value->meta = $correlativoMeta;
            $value->tipo_doc = 'PLANILLA';

            $tipoDocumento=$this->Model_Dashboard_Reporte->ConsultaTipoDocumento($value->expediente, $anio);
            if(count($tipoDocumento)>0)
            {
                $value->nro_documento = $tipoDocumento[0]->num_doc;
                $pos = stripos($tipoDocumento[0]->num_doc, 'MEM');
                if($pos!==false)
                {
                    $value->tipo_doc = 'MEMO';
                }
            }
            $comprobante=$this->Model_Dashboard_Reporte->ConsultaComprobantePago($value->expediente, $anio);            
            if(count($comprobante)>0)
            {
                $value->nro_comprobante = $comprobante[0]->num_doc;
            }
            $proveedor=$this->Model_Dashboard_Reporte->ConsultaNombreComprobante($value->expediente, $anio);
            $numerogiro = count($proveedor);
            if($numerogiro>0)
            {
                $value->nombre_proveedor = $proveedor[0]->nombre;
            }
            $OrdenSiga=$this->Model_Dashboard_Reporte->DatosOrdenSiga((int)$correlativoMeta, (int)$tipoDocumento[0]->num_doc, $anio, (int)$tipoDocumento[0]->expediente);
            if(count($OrdenSiga)!=0)
            {
                if($OrdenSiga[0]->TIPO_BIEN=='S')
                {
                    $value->tipo_doc = 'O/S';
                }
                if($OrdenSiga[0]->TIPO_BIEN=='B')
                {
                    $value->tipo_doc = 'O/C';
                } 
                $value->nro_orden=$OrdenSiga[0]->NRO_ORDEN;
                $value->nombre_proveedor=$OrdenSiga[0]->NOMBRE_PROV;
                $value->tipo_bien=$OrdenSiga[0]->TIPO_BIEN;
                $detalleGasto=$this->Model_Dashboard_Reporte->ConsultaDetalleOrden($OrdenSiga[0]->NRO_ORDEN, $OrdenSiga[0]->TIPO_BIEN, $OrdenSiga[0]->TIPO_PPTO, $OrdenSiga[0]->SEC_EJEC, $OrdenSiga[0]->ANO_EJE);
                $value->cantidadDetalle = count($detalleGasto);
                $value->childDetalleGasto = $detalleGasto;       
            }
            $manifiesto = $this->Model_ET_Manifiesto_Gasto->getManifiestoGasto((int)$value->expediente, $correlativoMeta, $anio, $idExpedienteTecnico);
            if(count($manifiesto)>0)
            {
                $value->id_presupuesto=$manifiesto[0]->id_presupuesto_ej;
                $value->tipo_doc=$manifiesto[0]->clase_documento;
                $value->nombre_proveedor=$manifiesto[0]->nombre_proveedor;        
                $value->detalle_gasto=$manifiesto[0]->detalle_gasto;
            }
        }

        $fechaReporte = $this->input->post('hdMes')." - ".$anio;
        $ultimoDia=$this->ultimoDia($anio, $mes);
        $correlativoMeta=(int)$correlativoMeta.'-'.$anio;
        $nombreFuenteFinanciamiento=$this->input->post('hdFuenteFinanciamiento');
        $html=$this->load->view('Front/Ejecucion/ManifiestoGasto/reporteManifiestoGasto', ['listaExpDev' => $listaExpDev,'gastoTotalManifiesto'=>$gastoTotalManifiesto, 'proyectoInversion'=>$proyectoInversion,'fechaReporte'=>$fechaReporte,'ultimoDia'=>$ultimoDia, 'correlativoMeta'=>$correlativoMeta, 'nombreFuenteFinanciamiento'=>$nombreFuenteFinanciamiento], true);       
		$this->mydompdf->set_paper('A4','landscape');
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
        $this->mydompdf->stream("reporteManifiestoGasto.pdf", array("Attachment" => false));       
    }

    function reporteEjecucionPdf()
    {
        $idExpedienteTecnico=$this->input->post('hdIdExpedienteTecnico');
        $metaPresupuestal=explode("-", $this->input->post('selectMetaPresupuestal'));
        $fuenteFinanciamiento=$this->input->post('selectFuenteFinanciamiento');  
        $mes=$this->input->post('selectMes');
        $sec_ejec=$metaPresupuestal[0];  
        $anio=$metaPresupuestal[1];  
        $meta=$metaPresupuestal[2];        
        $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
        $clasificadorMeta=$this->Model_Dashboard_Reporte->ConsultaClasificadorMeta($meta, $anio);
        foreach($clasificadorMeta as $clasif)
        {                
            $clasif->num_clasificador=str_replace(" ","",$clasif->num_clasificador);             
        }  

        $listaExpDev=$this->Model_Dashboard_Reporte->ExpedienteDevengadoMeta($sec_ejec, $meta, $anio, $mes, $fuenteFinanciamiento);
        $gastoTotalManifiesto = 0;
        foreach($listaExpDev as $key => $value)
        {
            $gastoTotalManifiesto += $value->total_documento;
            $tipoDocumento=$this->Model_Dashboard_Reporte->ConsultaTipoDocumento($value->expediente, $anio);
            $OrdenSiga=$this->Model_Dashboard_Reporte->DatosOrdenSiga((int)$meta, (int)$tipoDocumento[0]->num_doc, $anio, (int)$tipoDocumento[0]->expediente);
            if(count($OrdenSiga)!=0)
            {
                $value->nro_orden=$OrdenSiga[0]->NRO_ORDEN;    
                $value->tipo_bien=$OrdenSiga[0]->TIPO_BIEN;    
                $detalleGasto=$this->Model_Dashboard_Reporte->ConsultaDetalleOrden($OrdenSiga[0]->NRO_ORDEN, $OrdenSiga[0]->TIPO_BIEN, $OrdenSiga[0]->TIPO_PPTO, $OrdenSiga[0]->SEC_EJEC, $OrdenSiga[0]->ANO_EJE);                       
                $value->cantidadDetalle = count($detalleGasto);    
                $value->childDetalleGasto = $detalleGasto;       
            }

            $manifiesto = $this->Model_ET_Manifiesto_Gasto->getManifiestoGasto((int)$value->expediente, $meta, $anio, $idExpedienteTecnico);
            if(count($manifiesto)>0)
            {
                $value->tipo_doc=$manifiesto[0]->clase_documento;    
                $value->num_doc=$manifiesto[0]->numero_documento;    
                $value->num_comprobante=$manifiesto[0]->numero_comprobante;   
                $value->detalle_gasto=$manifiesto[0]->detalle_gasto;
                $value->id_presupuesto=$manifiesto[0]->id_presupuesto_ej;   
                $value->num_clasificador=$manifiesto[0]->numero_clasificador;                   
            }
        } 

        $fechaReporte = $this->input->post('hdMes')." - ".$anio;
        $ultimoDia=$this->ultimoDia($anio, $mes);
        $correlativoMeta=(int)$meta.'-'.$anio;
        $nombreFuenteFinanciamiento=$this->input->post('hdFuenteFinanciamiento');
        $html=$this->load->view('Front/Ejecucion/EjecucionPresupuestal/reporteEjecucionPresupuestal', ['listaExpDev' => $listaExpDev, 'gastoTotalManifiesto'=>$gastoTotalManifiesto, 'clasificadorMeta'=>$clasificadorMeta, 'ultimoDia'=>$ultimoDia, 'proyectoInversion'=>$proyectoInversion, 'fechaReporte'=>$fechaReporte, 'correlativoMeta'=>$correlativoMeta, 'nombreFuenteFinanciamiento'=>$nombreFuenteFinanciamiento], true);                          
		$this->mydompdf->set_paper('A4','landscape');
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
        $this->mydompdf->stream("reporteEjecucionPresupuestal.pdf", array("Attachment" => false));           
    }

    function programacionClasificador()
    {
        if($_POST)
        {
            $idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
            $idFuenteFinanciamiento=$this->input->post('idFuenteEt');
            $metaPresupuestal=explode("-", $this->input->post('metaPresupuestal'));
            $sec_ejec=$metaPresupuestal[0];
            $anio=$metaPresupuestal[1];
            $meta=$metaPresupuestal[2]; 
            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamientoMeta($sec_ejec, $anio, $meta, $idFuenteFinanciamiento);                        
            $PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion(); 
            foreach ($PresupuestoEjecucion as $key => $value) 
            {
                $Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
                if(count($Presupuesto)==0)
                {
                    $value->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$value->id_presupuesto_ej);
                    foreach ($value->ChilpresupuestoAnalitico as $temporal) 
                    {
                        $temporal->fuente_finan=$idFuenteFinanciamiento;
                        $temporal->sec_ejec=$sec_ejec;
                        $temporal->anio=$anio;   
                        $temporal->meta=$meta;
                        $temporal->monto='0.00';
                        $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporal->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                        if(count($prog)>0)
                        {
                            $temporal->monto=$prog[0]->monto;
                        }
                    }
                }
                if(count($Presupuesto)>0)
                {
                    $value->childPresupuesto=$Presupuesto;
                    foreach ($value->childPresupuesto as $key => $temp) 
                    {
                        $temp->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$temp->id_presupuesto_ej);
                        foreach ($temp->ChilpresupuestoAnalitico as $temporalChild) 
                        {
                            $temporalChild->fuente_finan=$idFuenteFinanciamiento;
                            $temporalChild->sec_ejec=$sec_ejec;
                            $temporalChild->anio=$anio;   
                            $temporalChild->meta=$meta;                                                         
                            $temporalChild->monto='0.00';                            
                            $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporalChild->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                            if(count($prog)>0)
                            {
                                $temporalChild->monto=$prog[0]->monto;
                            }
                        }
                    }
                }
                else
                {
                    $value->childPresupuesto=[];
                }
            }
            $this->load->view('Front/Ejecucion/ProgramacionClasificador/tablaProgramacion', ['idExpedienteTecnico'=>$idExpedienteTecnico, 'PresupuestoEjecucion'=>$PresupuestoEjecucion, 'fuenteFinanciamiento'=>$fuenteFinanciamiento]);
        }
        else
        {
            $idExpedienteTecnico=$this->input->get('idExpedienteTecnico');       
            $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
            $metaPresupuestal=$this->Model_Dashboard_Reporte->ConsultaMetaProyecto($proyectoInversion->codigo_unico_pi);
            $listaMeses=$this->listaMeses();
            $this->load->view('layout/Ejecucion/header');	
            $this->load->view('Front/Ejecucion/ProgramacionClasificador/index', ['idExpedienteTecnico'=>$idExpedienteTecnico, 'metaPresupuestal'=>$metaPresupuestal, 'listaMeses'=>$listaMeses]);
            $this->load->view('layout/Ejecucion/footer');            
        }
    }

    function insertarProgramacionAnalitico()
    {
        if($_POST)
        {
            $data = 0;
            $idAnalitico=$this->input->post('idAnalitico');
            $id_fuente_et=$this->input->post('fuente');
            $sec_ejec=$this->input->post('sec_ejec');
            $meta=$this->input->post('meta');        
            $anio=$this->input->post('anio');
            $monto=floatval(str_replace(",","",$this->input->post("monto")));
            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamientoMeta($sec_ejec, $anio, $meta, $id_fuente_et);                                              
            $montoTotalAcumulado=0;
            $montoTotal=$this->Model_ET_Programacion_Analitico->sumatoriaProgramacion($id_fuente_et, $meta, $anio, $sec_ejec);
            if(count($montoTotal)>0)
            {
                $montoTotalAcumulado=$montoTotal[0]->total_fuente;
            }
            $programacion=$this->Model_ET_Programacion_Analitico->listarProgramacion($idAnalitico, $id_fuente_et, $meta, $anio, $sec_ejec);      
            if(count($programacion)==0)
            {
                if(($montoTotalAcumulado+$monto)>$fuenteFinanciamiento[0]->pim)
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'Ha superado el monto que ha sido asignado a la fuente de financiamiento']);
                    echo json_encode($msg);exit; 
                }                
                $c_data['id_analitico']=$idAnalitico;
                $c_data['fuente_financ']=$id_fuente_et;
                $c_data['meta']=$meta;
                $c_data['anio']=$anio;
                $c_data['sec_ejec']=$sec_ejec;
                $c_data['monto']=$monto;
                $data=$this->Model_ET_Programacion_Analitico->insertar($c_data);
            }
            else
            {
                if(($montoTotalAcumulado-$programacion[0]->monto +$monto)>$fuenteFinanciamiento[0]->pim)
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'Ha superado el monto que ha sido asignado a la fuente de financiamiento']);
                    echo json_encode($msg);exit; 
                }                
                $u_data['monto']=$monto;
                $data=$this->Model_ET_Programacion_Analitico->editar($u_data, $programacion[0]->id_programacion);
            }
            $montoClasificador = number_format($monto, 2, '.', ',');
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente','monto'=>$montoClasificador]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit; 
        }
    }    

    function cuadroComparativo()
    {
        $idExpedienteTecnico=$this->input->post('idExpediente');            
        $metaPresupuestal=explode("-", $this->input->post('metaPresupuestal'));
        $sec_ejec=$metaPresupuestal[0];
        $anio=$metaPresupuestal[1];
        $meta=$metaPresupuestal[2]; 
        $idFuenteFinanciamiento=$this->input->post('idFuenteEt');    
        $mes=$this->input->post('mes');
        $listaMeses=$this->listaMeses();
        $PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion(); 
        $sumatoriaProgramado=0;
        $montoTotalFuente=0;
        if($idFuenteFinanciamiento=='TODOS')   
        {
            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta);                                                                  
            $gastoEjecutado=$this->Model_ET_Programacion_Analitico->gastoEjecutadoAcumulado($idExpedienteTecnico, $meta, $anio, $sec_ejec, $mes);
            $this->load->view('Front/Ejecucion/ProgramacionClasificador/tablaConsolidado', ['fuenteFinanciamiento'=>$fuenteFinanciamiento,'gastoEjecutado'=>$gastoEjecutado]);                                        
        }
        else
        {
            foreach ($PresupuestoEjecucion as $key => $value) 
            {
                $Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
                if(count($Presupuesto)==0)
                {
                    $value->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$value->id_presupuesto_ej);
                    foreach ($value->ChilpresupuestoAnalitico as $temporal) 
                    {
                        $temporal->monto='0.00';
                        $temporal->acumulado=0;     
                        $temporal->porcentajeAcumulado=0;                 
                        $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporal->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                        if(count($prog)>0)
                        {
                            $temporal->monto=$prog[0]->monto;
                            $sumatoriaProgramado+=$prog[0]->monto;                        
                        }
                        $programacionporMes=$this->Model_ET_Programacion_Analitico->getProgramacionByMes($idExpedienteTecnico, $meta, $anio, $sec_ejec, $value->id_presupuesto_ej, $temporal->num_clasificador, $mes, $idFuenteFinanciamiento);
                        $temporal->childProgramacion=$programacionporMes;
                        foreach($programacionporMes as $programacion)
                        {
                            $temporal->acumulado+=$programacion->montomensual;   
                            $montoTotalFuente+=$programacion->montomensual;                      
                        }
                        if($temporal->monto>0)
                        {
                            $temporal->porcentajeAcumulado=($temporal->acumulado*100)/$temporal->monto;
                        }
                        $temporal->saldo=$temporal->monto-$temporal->acumulado;
                        $temporal->porcentajeSaldo=100-$temporal->porcentajeAcumulado;                    
                    }
                }
                $value->childPresupuesto=[];
                if(count($Presupuesto)>0)
                {
                    $value->childPresupuesto=$Presupuesto;
                    foreach ($value->childPresupuesto as $key => $temp) 
                    {
                        $temp->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$temp->id_presupuesto_ej);
                        foreach ($temp->ChilpresupuestoAnalitico as $temporalChild) 
                        {                                                  
                            $temporalChild->monto='0.00';   
                            $temporalChild->acumulado=0;    
                            $temporalChild->porcentajeAcumulado=0;                           
                            $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporalChild->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                            if(count($prog)>0)
                            {
                                $temporalChild->monto=$prog[0]->monto;
                                $sumatoriaProgramado+=$prog[0]->monto;
                            }
                            $programacionporMes=$this->Model_ET_Programacion_Analitico->getProgramacionByMes($idExpedienteTecnico, $meta, $anio, $sec_ejec, $temp->id_presupuesto_ej, $temporalChild->num_clasificador, $mes, $idFuenteFinanciamiento);
                            $temporalChild->childProgramacion=$programacionporMes;
                            foreach($programacionporMes as $programacion)
                            {
                                $temporalChild->acumulado+=$programacion->montomensual; 
                                $montoTotalFuente+=$programacion->montomensual;                        
                            }
                            if($temporalChild->monto>0)
                            {
                                $temporalChild->porcentajeAcumulado= ($temporalChild->acumulado*100)/$temporalChild->monto;
                            }
                            $temporalChild->saldo=$temporalChild->monto-$temporalChild->acumulado;
                            $temporalChild->porcentajeSaldo=100-$temporalChild->porcentajeAcumulado;
                        }
                    }
                }
            }

            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamientoMeta($sec_ejec, $anio, $meta, $idFuenteFinanciamiento);                                              

            $this->load->view('Front/Ejecucion/ProgramacionClasificador/cuadroComparativo', ['listaMeses'=>$listaMeses,'PresupuestoEjecucion'=>$PresupuestoEjecucion,'sumatoriaProgramado'=>$sumatoriaProgramado,'montoTotalFuente'=>$montoTotalFuente,'fuenteFinanciamiento'=>$fuenteFinanciamiento]);    
        }
    }

    function reportePdfCuadro()
    {
        $idExpedienteTecnico=$this->input->post('hdIdExpediente');            
        $metaPresupuestal=explode("-", $this->input->post('selectMeta'));
        $idFuenteFinanciamiento=$this->input->post('selectFuenteFinanciamiento');    
        $mes=$this->input->post('selectMes');
        $sec_ejec=$metaPresupuestal[0];
        $anio=$metaPresupuestal[1];
        $meta=$metaPresupuestal[2];
        $listaMeses=$this->listaMeses();
        $fechaReporte=$this->input->post('hdMes').' - '.$anio;
        $correlativo=(int) $meta.'-'.$anio;
        if($idFuenteFinanciamiento=='TODOS')   
        {
            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta);                                                                  
            $gastoEjecutado=$this->Model_ET_Programacion_Analitico->gastoEjecutadoAcumulado($idExpedienteTecnico, $meta, $anio, $sec_ejec, $mes);
            $html=$this->load->view('Front/Ejecucion/ProgramacionClasificador/resumenpdf', ['fuenteFinanciamiento'=>$fuenteFinanciamiento,'fechaReporte'=>$fechaReporte,'gastoEjecutado'=>$gastoEjecutado],true);                        
            $this->mydompdf->set_paper('A4','landscape');
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("RESUMEN_FE06.pdf", array("Attachment" => false));                       
        }
        else
        {
            $PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion(); 
            $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
            $sumatoriaProgramado=0;
            $montoTotalFuente=0;
            foreach ($PresupuestoEjecucion as $key => $value) 
            {
                $Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
                if(count($Presupuesto==0))
                {
                    $value->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$value->id_presupuesto_ej);
                    foreach ($value->ChilpresupuestoAnalitico as $temporal) 
                    {
                        $temporal->monto='0.00';
                        $temporal->acumulado=0;     
                        $temporal->porcentajeAcumulado=0;                 
                        $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporal->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                        if(count($prog)>0)
                        {
                            $temporal->monto=$prog[0]->monto;
                            $sumatoriaProgramado+=$prog[0]->monto;                        
                        }
                        $programacionporMes=$this->Model_ET_Programacion_Analitico->getProgramacionByMes($idExpedienteTecnico, $meta, $anio, $sec_ejec, $value->id_presupuesto_ej, $temporal->num_clasificador, $mes, $idFuenteFinanciamiento);
                        $temporal->childProgramacion=$programacionporMes;
                        foreach($programacionporMes as $programacion)
                        {
                            $temporal->acumulado+=$programacion->montomensual;   
                            $montoTotalFuente+=$programacion->montomensual;                      
                        }
                        if($temporal->monto>0)
                        {
                            $temporal->porcentajeAcumulado=($temporal->acumulado*100)/$temporal->monto;
                        }
                        $temporal->saldo=$temporal->monto-$temporal->acumulado;
                        $temporal->porcentajeSaldo=100-$temporal->porcentajeAcumulado;                    
                    }
                }
                if(count($Presupuesto>0))
                {
                    $value->childPresupuesto=$Presupuesto;
                    foreach ($value->childPresupuesto as $key => $temp) 
                    {
                        $temp->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($idExpedienteTecnico,$temp->id_presupuesto_ej);
                        foreach ($temp->ChilpresupuestoAnalitico as $temporalChild) 
                        {                                                  
                            $temporalChild->monto='0.00';   
                            $temporalChild->acumulado=0;    
                            $temporalChild->porcentajeAcumulado=0;                           
                            $prog=$this->Model_ET_Programacion_Analitico->listarProgramacion($temporalChild->id_analitico, $idFuenteFinanciamiento, $meta, $anio, $sec_ejec);
                            if(count($prog)>0)
                            {
                                $temporalChild->monto=$prog[0]->monto;
                                $sumatoriaProgramado+=$prog[0]->monto;
                            }
                            $programacionporMes=$this->Model_ET_Programacion_Analitico->getProgramacionByMes($idExpedienteTecnico, $meta, $anio, $sec_ejec, $temp->id_presupuesto_ej, $temporalChild->num_clasificador, $mes, $idFuenteFinanciamiento);
                            $temporalChild->childProgramacion=$programacionporMes;
                            foreach($programacionporMes as $programacion)
                            {
                                $temporalChild->acumulado+=$programacion->montomensual; 
                                $montoTotalFuente+=$programacion->montomensual;                        
                            }
                            if($temporalChild->monto>0)
                            {
                                $temporalChild->porcentajeAcumulado= ($temporalChild->acumulado*100)/$temporalChild->monto;
                            }
                            $temporalChild->saldo=$temporalChild->monto-$temporalChild->acumulado;
                            $temporalChild->porcentajeSaldo=100-$temporalChild->porcentajeAcumulado;
                        }
                    }
                }
            }
            $fuenteFinanciamiento=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamientoMeta($sec_ejec, $anio, $meta, $idFuenteFinanciamiento);                                                                      
            $html=$this->load->view('Front/Ejecucion/ProgramacionClasificador/formatopdf', ['proyectoInversion'=>$proyectoInversion,'listaMeses'=>$listaMeses,'PresupuestoEjecucion'=>$PresupuestoEjecucion,'sumatoriaProgramado'=>$sumatoriaProgramado,'montoTotalFuente'=>$montoTotalFuente,'fuenteFinanciamiento'=>$fuenteFinanciamiento,'fechaReporte'=>$fechaReporte,'correlativo'=>$correlativo],true);                        
            $this->mydompdf->set_paper('A4','landscape');
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("FormatoFE-06.pdf", array("Attachment" => false));
        }                  

    }

    function listaFuenteFinanciamiento()
    {
        $metaPresupuestal=explode("-", $this->input->post('metaPresupuestal'));
        $sec_ejec=$metaPresupuestal[0];
        $anio=$metaPresupuestal[1];
        $meta=$metaPresupuestal[2]; 
        $data=$this->Model_Dashboard_Reporte->ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta);
        echo json_encode($data);
        exit;
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

    private function ultimoDia($anio, $mes)
    {
        $dia = $anio."-".$mes."-01";
        $fecha = new DateTime($dia);
        $fecha->modify('last day of this month');
        $ultimoDia= $fecha->format('d/m/Y');
        return $ultimoDia;
    }
}