<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrincipalReportes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Dashboard_Reporte');
        $this->load->model('Model_Personal');
        $this->load->helper('FormatNumber_helper');
        $this->load->model('Model_Estado_Pedido');
        $this->load->model('Model_ProyectoInversion');
    }

    public function PrincipalReportes()
    {
        $this->load->view('layout/Reportes/header');
        $this->load->view('Reportes');
        $this->load->view('layout/Reportes/footer');

    }

    public function GetAprobadosEstudio()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->GetAprobadosEstudio();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function NaturalezaInversionMontos()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->NaturalezaInversionMontos();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function CantidadPipFuenteFinancimiento()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->CantidadPipFuenteFinancimiento();
            echo json_encode($datos);
        } else
        show_404();
    }
    public function MontoPipFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->MontoPipFuenteFinanciamiento();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function CantidadPipModalidad()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->CantidadPipModalidad();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function MontoPipModalidad()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->MontoPipModalidad();

            foreach ($datos as $key => $value)
            {
                $value->Monto = a_number_format($value->Monto, 2, '.',",",0);
            }

            echo json_encode($datos);
        } else
        show_404();
    }
    public function CantidadPipRubro()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Dashboard_Reporte->CantidadPipRubro();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function CantidadPipProvincia()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Model_Dashboard_Reporte->CantidadPipProvincia();
            foreach ($datos as $key => $Itemp)
            {
               $numpip[$key]=$Itemp->Cantidadpip;
            }
            echo json_encode($numpip);
        }
        else
        show_404();
    }

    public function ReporteEjecucionFinanciera()
    {
        if ($this->input->is_ajax_request())
        {
            $CodigoUnico=$this->input->get('codigounico');
            $datos=$this->Model_Dashboard_Reporte->ReporteCorrelativoMeta($CodigoUnico);
            if(count($datos)>0)
            {
                $var1=[];
                $anio[]=$datos[0]->ano_eje-1;
                $pim[]=0;
                $devengado[]=0;

                foreach ($datos as $key => $Itemp)
                {
                    $sumatoria = 0;

                    if(in_array($Itemp->ano_eje, $anio))
                    {
                        $clave = array_search($Itemp->ano_eje, $anio);
                        $pim[$clave]+=$Itemp->pim_acumulado;
                        $devengado[$clave]+=$Itemp->devengado;
                    }
                    else
                    {
                        $anio[]=$Itemp->ano_eje;
                        $pim[]=$Itemp->pim_acumulado;
                        $devengado[]=$Itemp->devengado;
                    }
                }

                $sumatoria=0;

                foreach ($devengado as $key => $value)
                {
                    $sumatoria+=$value;
                    $acumulado[]=$sumatoria;
                }

                $var1[]=$anio;
                $var1[]=$pim;
                $var1[]=$devengado;
                $var1[]=$acumulado;

                echo json_encode($var1);exit;
            }
            else
            {
                echo json_encode(['mensaje'=>'No hay datos']);exit;
            }           
        }
        else
        {
            show_404();
        }
    }

    public function GrafEstInfFinanciera()
    {
        if ($this->input->is_ajax_request())
        {
            $CodigoUnico=$this->input->get('codigounico');
            $datos=$this->Model_Dashboard_Reporte->ReporteCorrelativoMeta($CodigoUnico);
            $var1=[];
            $anio=[];
            $pim=[];
            $devengado=[];
            $comprometido=[];
            $certificado=[];
            $girado=[];
            $pagado=[];
            foreach ($datos as $key => $Itemp)
            {
                if(in_array($Itemp->ano_eje, $anio))
                {
                    $clave = array_search($Itemp->ano_eje, $anio);
                    $pim[$clave]+=$Itemp->pim_acumulado;
                    $devengado[$clave]+=$Itemp->devengado;
                    $comprometido[$clave]+=$Itemp->compromiso;
                    $certificado[$clave]+=$Itemp->monto_certificado;
                    $girado[$clave]+=$Itemp->girado;
                    $pagado[$clave]+=$Itemp->pagado;
                }
                else
                {
                    $anio[]=$Itemp->ano_eje;
                    $pim[]=$Itemp->pim_acumulado;
                    $devengado[]=$Itemp->devengado;
                    $comprometido[]=$Itemp->compromiso;
                    $certificado[]=$Itemp->monto_certificado;
                    $girado[]=$Itemp->girado;
                    $pagado[]=$Itemp->pagado;
                }
            }

            $var1[]=$anio;
            $var1[]=$pim;
            $var1[]=$certificado;
            $var1[]=$comprometido;
            $var1[]=$devengado;
            $var1[]=$girado;
            $var1[]=$pagado;
            echo json_encode($var1);
            exit;
        }
        else
        {
            show_404();
        }
    }

    public function GrafAvanceFinanciero()
    {
        if ($this->input->is_ajax_request())
        {
            $CodigoUnico=$this->input->get('codigounico');
            $datos = $this->Model_Dashboard_Reporte->ReporteCorrelativoMeta($CodigoUnico);
            if(count($datos)>0)
            {
                $var1=[];
                $anio[]=$datos[0]->ano_eje-1;
                $certificado[]=0;
                $compromiso[]=0;
                $devengado[]=0;
                $girado[]=0;
                $pagado[]=0;

                foreach ($datos as $key => $Itemp)
                {
                    if(in_array($Itemp->ano_eje, $anio))
                    {
                        $clave = array_search($Itemp->ano_eje, $anio);

                        $certificado[$clave]+=$Itemp->monto_certificado;
                        $compromiso[$clave]+=$Itemp->compromiso;
                        $devengado[$clave]+=$Itemp->devengado;
                        $girado[$clave]+=$Itemp->girado;
                        $pagado[$clave]+=$Itemp->pagado;
                    }
                    else
                    {
                        $anio[]=$Itemp->ano_eje;
                        $certificado[]=$Itemp->monto_certificado;
                        $compromiso[]=$Itemp->compromiso;
                        $devengado[]=$Itemp->devengado;
                        $girado[]=$Itemp->girado;
                        $pagado[]=$Itemp->pagado;
                    }
                }

                $var1[]=$anio;
                $var1[]=$certificado;
                $var1[]=$compromiso;
                $var1[]=$devengado;
                $var1[]=$girado;
                $var1[]=$pagado;
                echo json_encode($var1);
            }
            else
            {
                echo json_encode(['mensaje'=>'No hay datos']);exit;
            }  
        }
        else
        {
            show_404();
        }
    }

    public function FuncionNumeroPip()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Model_Dashboard_Reporte->FuncionNumeroPip();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    function BuscadorPipPorCodigoReporte()
    {
        $CodigoUnico=$this->input->get('codigounico');
        $BuscarPipCodigoReporte=$this->Model_Dashboard_Reporte->ReporteDevengadoPiaPimPorPip($CodigoUnico); 
        echo  json_encode($BuscarPipCodigoReporte);
    }

    function  DatosParaEstadisticaAnualProyecto()
    {
        $codigounico=$this->input->POST('codigounico');
        $data=$this->Model_Dashboard_Reporte->ReporteDevengadoPiaPimPorPip($codigounico);
        $data->costo_actual = a_number_format($data->costo_actual, 2, '.',",",3);
        $data->costo_expediente = a_number_format($data->costo_expediente, 2, '.',",",3);
        $data->costo_viabilidad = a_number_format($data->costo_viabilidad, 2, '.',",",3);
        $data->ejecucion_ano_anterior = a_number_format($data->ejecucion_ano_anterior, 2, '.',",",3);
        echo  json_encode($data);
        exit;
    }

    function DatosEjecucionPresupuestal()
    {
        $codigounico=$this->input->POST('codigounico');
        $datos=$this->Model_Dashboard_Reporte->ReporteEjecucionPresupuestal($codigounico);
        foreach ($datos as $key => $data)
        {
            $data->costo_actual = a_number_format($data->costo_actual, 2, '.',",",3);
            $data->costo_expediente = a_number_format($data->costo_expediente, 2, '.',",",3);
            $data->costo_viabilidad = a_number_format($data->costo_viabilidad, 2, '.',",",3);
            $data->ejecucion_ano_anterior = a_number_format($data->ejecucion_ano_anterior, 2, '.',",",3);
        }
        echo  json_encode($datos);
    }

    function DatosCorrelativoMeta()
    {
        $codigounico=$this->input->POST('codigounico');
        $datos=$this->Model_Dashboard_Reporte->ReporteCorrelativoMeta($codigounico);
        foreach ($datos as $key => $data)
        {
           
            $data->avance=0;
            if($data->pim_acumulado>0 && $data->devengado>0)
            {
                $data->avance=($data->pim_acumulado/$data->devengado)*100;
            }

            $data->saldo_certificado = number_format($data->pim_acumulado-$data->monto_certificado, 2, '.', ',');
            $data->saldo_devengado = number_format($data->pim_acumulado-$data->devengado, 2, '.', ',');
            $data->pia = number_format($data->pia, 2, '.', ',');
            $data->pim = number_format($data->pim, 2, '.', ',');
            $data->pim_acumulado = number_format($data->pim_acumulado, 2, '.', ',');
            $data->monto_certificado = number_format($data->monto_certificado, 2, '.', ','); 
            $data->monto_comprometido_anual = number_format($data->monto_comprometido_anual, 2, '.', ','); 
            $data->monto_precertificado = number_format($data->monto_precertificado, 2, '.', ',');
            $data->compromiso = number_format($data->compromiso, 2, '.', ',');
            $data->devengado = number_format($data->devengado, 2, '.', ','); 
            $data->girado = number_format($data->girado, 2, '.', ','); 
            $data->pagado = number_format($data->pagado, 2, '.', ',');
            $data->avance_financiero = number_format($data->avance_financiero, 2, '.', ',');              
        }
        echo  json_encode($datos);
		
    }

    function AvanceEjecucionFinanciera()
    {
        $codigounico=$this->input->get('codigounico');
        $datos=$this->Model_Dashboard_Reporte->ReporteCorrelativoMeta($codigounico);
        foreach ($datos as $key => $data)
        {
            $data->pia = a_number_format($data->pia, 2, '.',",",3);
            $data->pim = a_number_format($data->pim, 2, '.',",",3);
            $data->pim_acumulado = a_number_format($data->pim_acumulado, 2, '.',",",3);
            $data->ejecucion = a_number_format($data->ejecucion, 2, '.',",",3);
            $data->compromiso = a_number_format($data->compromiso, 2, '.',",",3);
            $data->devengado = a_number_format($data->devengado, 2, '.',",",3);
            $data->girado = a_number_format($data->girado, 2, '.',",",3);
            $data->pagado = a_number_format($data->pagado, 2, '.',",",3);
            $data->monto_certificado = a_number_format($data->monto_certificado, 2, '.',",",3);
            $data->monto_comprometido_anual = a_number_format($data->monto_comprometido_anual, 2, '.',",",3);
            $data->monto_precertificado = a_number_format($data->monto_precertificado, 2, '.',",",3);
        }
        echo  json_encode($datos);
    }

    function  ReporteDevengadoPiaPimPorPipGraficos()
    {
        $codigounico=$this->input->GET('codigounico');
        $data=$this->Model_Dashboard_Reporte->ReporteDevengadoPiaPimPorPipGraficos($codigounico);
        echo  json_encode($data);
    }

    function DetalleMensualizado()
    {
        $correlativoMeta=$this->input->GET('meta');
        $anioMeta=$this->input->GET('anio');
        $sec_ejec=$this->input->GET('sec_ejec');
        $compromiso = 0;
        $devengado = 0;              
        $girado = 0;
        $pagado = 0;
        $listaDetalleMensualizado=$this->Model_Dashboard_Reporte->DetalleMensualizadoMeta($correlativoMeta,$anioMeta,$sec_ejec);








/*
        foreach ($listaDetalleMensualizado as $key => $data)
        {
        $compromiso = 0;
        $devengado = 0;              
        $girado = 0;
        $pagado = 0;
            $listaExpediente=$this->Model_Dashboard_Reporte->ExpedienteMensualizado($anioMeta, $sec_ejec, $correlativoMeta,$data->mes_eje);
            foreach ($listaExpediente as $value) 
            {
                switch ($value->fase) 
                {
                    case 'C': $compromiso = $value->monto; break;
                    case 'D': $devengado = $value->monto; break;                
                    case 'G': $girado = $value->monto; break;
                    case 'P': $pagado = $value->monto; break;
                }
            }
            $data->compromiso = $compromiso;
            $data->devengado = $devengado; 
            $data->girado = $girado; 
            $data->pagado = $pagado;             
        }
*/
        //$listaDetalleMensualizadoEst=$this->Model_Dashboard_Reporte->DetalleMensualizadoMetaEst($correlativoMeta,$anioMeta,$sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/detalle',['listaDetalleMensualizado'=>$listaDetalleMensualizado,'correlativoMeta'=>$correlativoMeta,'anioMeta'=>$anioMeta,'sec_ejec'=>$sec_ejec]);
    }

    function DetalleMensualizadoFuenteFinan()
    {
        $correlativoMeta=$this->input->GET('meta');
        $anioMeta=$this->input->GET('anio');
        $sec_ejec=$this->input->GET('sec_ejec');
        $listaDetalleMensualizadoFuenteFinan=$this->Model_Dashboard_Reporte->DetalleMensualizadoMetaFuente($correlativoMeta,$anioMeta,$sec_ejec);
        $listaDetalleMensualizadoFuenteFinanDatosG=$this->Model_Dashboard_Reporte->DetalleMensualizadoMetaFuenteDatosG($correlativoMeta,$anioMeta, $sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/DetalleMensualizadoFuenteFinan',['listaDetalleMensualizadoFuenteFinan'=>$listaDetalleMensualizadoFuenteFinan,'listaDetalleMensualizadoFuenteFinanDatosG'=>$listaDetalleMensualizadoFuenteFinanDatosG,'correlativoMeta'=>$correlativoMeta,'anioMeta'=>$anioMeta]);
    }

    function DetalleAnalitico()
    {
        $anio=$this->input->GET('anio');
        $codigounico=$this->input->GET('codigounico');
        $listaDetalleAnaliticoAvancFin=$this->Model_Dashboard_Reporte->ReporteDetalleAnaliticoFinanciero($anio,$codigounico);
        $this->load->view('front/Reporte/ProyectoInversion/detalleAnalitico',['listaDetalleAnaliticoAvancFin'=> $listaDetalleAnaliticoAvancFin]);
    }

    function DetalleClasificador()
    {
        ini_set('xdebug.var_display_max_depth', 100);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 1024);

        $anio=$this->input->GET('anio');
        $codigounico=$this->input->GET('codigounico');

        $listaDetalleClasificador=$this->Model_Dashboard_Reporte->ReporteDetalleClasificador($anio,$codigounico);

        $temp=[];

        $primerCodigoTemp=null;

        foreach($listaDetalleClasificador as $key0 => $value0)
        {
            if($primerCodigoTemp==$value0->cod_tt)
            {
                continue;
            }

            $primerCodigoTemp=$value0->cod_tt;

            $temp[$key0]=new stdClass();

            $temp[$key0]->cod_tt=$value0->cod_tt;
            $temp[$key0]->tipo_transaccion=$value0->tipo_transaccion;

            $temp[$key0]->child=[];

            $segundoCodigoTemp=null;

            foreach($listaDetalleClasificador as $key1 => $value1)
            {
                if($segundoCodigoTemp==$value1->generica || $temp[$key0]->cod_tt!=substr($value1->generica, 0, strlen($temp[$key0]->cod_tt)))
                {
                    continue;
                }

                $segundoCodigoTemp=$value1->generica;

                $temp[$key0]->child[$key1]=new stdClass();

                $temp[$key0]->child[$key1]->generica=$value1->generica;
                $temp[$key0]->child[$key1]->desc_generica=$value1->desc_generica;

                $temp[$key0]->child[$key1]->child=[];

                $tercerCodigoTemp=null;

                foreach($listaDetalleClasificador as $key2 => $value2)
                {
                    if($tercerCodigoTemp==$value2->sub_generica || $temp[$key0]->child[$key1]->generica!=substr($value2->sub_generica, 0, strlen($temp[$key0]->child[$key1]->generica)))
                    {
                        continue;
                    }

                    $tercerCodigoTemp=$value2->sub_generica;

                    $temp[$key0]->child[$key1]->child[$key2]=new stdClass();

                    $temp[$key0]->child[$key1]->child[$key2]->sub_generica=$value2->sub_generica;
                    $temp[$key0]->child[$key1]->child[$key2]->desc_sub_generica=$value2->desc_sub_generica;

                    $temp[$key0]->child[$key1]->child[$key2]->child=[];

                    $cuartoCodigoTemp=null;

                    foreach($listaDetalleClasificador as $key3 => $value3)
                    {
                        if($cuartoCodigoTemp==$value3->sub_generica_det || $temp[$key0]->child[$key1]->child[$key2]->sub_generica!=substr($value3->sub_generica_det, 0, strlen($temp[$key0]->child[$key1]->child[$key2]->sub_generica)))
                        {
                            continue;
                        }

                        $cuartoCodigoTemp=$value3->sub_generica_det;

                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]=new stdClass();

                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->sub_generica_det=$value3->sub_generica_det;
                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->des_sub_generica_det=$value3->des_sub_generica_det;

                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child=[];

                        $quintoCodigoTemp=null;

                        foreach($listaDetalleClasificador as $key4 => $value4)
                        {
                            if($quintoCodigoTemp==$value4->especifica || $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->sub_generica_det!=substr($value4->especifica, 0, strlen($temp[$key0]->child[$key1]->child[$key2]->child[$key3]->sub_generica_det)))
                            {
                                continue;
                            }

                            $quintoCodigoTemp=$value4->especifica;

                            $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]=new stdClass();

                            $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->especifica=$value4->especifica;
                            $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->desc_especifica=$value4->desc_especifica;

                            $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child=[];

                            $sextoCodigoTemp=null;


                            foreach($listaDetalleClasificador as $key5 => $value5)
                            {
                                $arrayMensual = [];

                                if($sextoCodigoTemp==$value5->especifica_det || $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->especifica!=substr($value5->especifica_det, 0, strlen($temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->especifica)))
                                {
                                    continue;
                                }

                                $sextoCodigoTemp=$value5->especifica_det;

                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]=new stdClass();

                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->devengado=0;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->compromiso=0;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->girado=0;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->pagado=0;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->rendido=0;

                                $gastoPorClasificador=$this->Model_Dashboard_Reporte->GastoPorClasificador($anio,$value5->sec_ejec, $codigounico);
                                $RendidoPorClasificador=$this->Model_Dashboard_Reporte->RendidoPorClasificador($anio,$value5->sec_ejec, $codigounico);
                                
                                foreach ($gastoPorClasificador as $temporal) 
                                {
                                    if($temporal->id_clasificador==$value5->id_clasificador)
                                    {
                                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->compromiso=$temporal->compromiso;
                                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->devengado=$temporal->devengado;                                        
                                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->girado=$temporal->girado;
                                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->pagado=$temporal->pagado;
                                    }
                                }

                                foreach ($RendidoPorClasificador as $rendido) 
                                {
                                    if($rendido->id_clasificador==$value5->id_clasificador)
                                    {
                                        $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->rendido=$rendido->rendido;
                                    }
                                }

                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->especifica_det=$value5->especifica_det;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->desc_especifica_det=$value5->desc_especifica_det;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->ene=$value5->ene;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->feb=$value5->feb;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->mar=$value5->mar;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->abr=$value5->abr;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->may=$value5->may;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->jun=$value5->jun;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->jul=$value5->jul;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->ago=$value5->ago;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->sep=$value5->sep;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->oct=$value5->oct;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->nov=$value5->nov;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->dic=$value5->dic;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->comprometido_anual=$value5->comprometido_anual;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->certificado=$value5->certificado;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->ejecucion=$value5->ejecucion;
                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->anulacion=$value5->anulacion;

                                $arrayMensual[]=$value5->ene;
                                $arrayMensual[]=$value5->feb;
                                $arrayMensual[]=$value5->mar;
                                $arrayMensual[]=$value5->abr;
                                $arrayMensual[]=$value5->may;
                                $arrayMensual[]=$value5->jun;
                                $arrayMensual[]=$value5->jul;
                                $arrayMensual[]=$value5->ago;
                                $arrayMensual[]=$value5->sep;
                                $arrayMensual[]=$value5->oct;
                                $arrayMensual[]=$value5->nov;
                                $arrayMensual[]=$value5->dic;

                                $sumatoriaAcumuladaAnual = [];

                                foreach ($arrayMensual as $key => $value)
                                {
                                    if(!isset($sumatoriaAcumuladaAnual[$key]))
                                    {
                                        $sumatoriaAcumuladaAnual[]=0;
                                    }
                                    $sumatoriaAcumuladaAnual[$key]+=($value+($key>0 ?  $sumatoriaAcumuladaAnual[$key-1]  : 0));
                                }

                                $temp[$key0]->child[$key1]->child[$key2]->child[$key3]->child[$key4]->child[$key5]->sumatoriaAcumuladaAnual=$sumatoriaAcumuladaAnual;

                            }
                        }
                    }
                }
            }
        }

        $this->load->view('front/Reporte/ProyectoInversion/detalleClasificador',['listaDetalleClasificador'=>$listaDetalleClasificador,'temp'=>$temp]);
    }
    
    public function GrafDetalleMensualizado()
    {

        if ($this->input->is_ajax_request()) {
            $correlativoMeta=$this->input->GET('meta');
            $anioMeta=$this->input->GET('anio');
            $sec_ejec=$this->input->GET('sec_ejec');

            $datos=$this->Model_Dashboard_Reporte->DetalleMensualizadoMeta($correlativoMeta,$anioMeta,$sec_ejec);

            $a_ejecucion = 0;
            $a_compromiso = 0;
            $a_certificado = 0;
            $a_devengado = 0;
            $a_girado = 0;
            $a_pagado= 0;

            $var1=[];
            foreach ($datos as $key => $Itemp)
            {
                if($Itemp->mes_eje=="01")
                    {$nombre[]="Ene";}
                if($Itemp->mes_eje=="02")
                    {$nombre[]="Feb";}
                if($Itemp->mes_eje=="03")
                    {$nombre[]="Mar";}
                if($Itemp->mes_eje=="04")
                    {$nombre[]="Abr";}
                if($Itemp->mes_eje=="05")
                    {$nombre[]="May";}
                if($Itemp->mes_eje=="06")
                    {$nombre[]="Jun";}
                if($Itemp->mes_eje=="07")
                    {$nombre[]="Jul";}
                if($Itemp->mes_eje=="08")
                    {$nombre[]="Ago";}
                if($Itemp->mes_eje=="09")
                    {$nombre[]="Set";}
                if($Itemp->mes_eje=="10")
                    {$nombre[]="Oct";}
                if($Itemp->mes_eje=="11")
                    {$nombre[]="Nov";}
                if($Itemp->mes_eje=="12")
                    {$nombre[]="Dic";}



                $a_ejecucion += $Itemp->ejecucion;
                $ejecucion[]= a_number_format($a_ejecucion, 2, '.',",",0);

                $a_compromiso += $Itemp->compromiso;
                $compromiso[]= a_number_format($a_compromiso, 2, '.',",",0);

                 $a_certificado += $Itemp->certificado;
                $certificado[]= a_number_format($a_certificado, 2, '.',",",0);

                $a_devengado += $Itemp->devengado;
                $devengado[]= a_number_format($a_devengado, 2, '.',",",0);

                $a_girado+= $Itemp->girado;
                $girado[]=a_number_format($a_girado, 2, '.',",",0);

                $a_pagado += $Itemp->pagado;
                $pagado[]=a_number_format($a_pagado, 2, '.',",",0);
            }

            $var1[]=$nombre;
            $var1[]=$ejecucion;
            $var1[]=$compromiso;
            $var1[]=$certificado;
            $var1[]=$devengado;
            $var1[]=$girado;
            $var1[]=$pagado;

            echo json_encode($var1);
        } else
        show_404();
    }

    function ConsolidadoAvanceFisicoFinan()
    {
        $anio=$this->input->POST('anio');
        $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvanceFisicoFinan($anio);

        $this->load->view('front/Reporte/ProyectoInversion/seguimientoCertificado');

    }
     function detalladoMensualizadoConceptoClasificador()
    {
        $correlativoMeta=$this->input->GET('meta');
        $anioMeta=$this->input->GET('anio');
        $sec_ejec=$this->input->GET('sec_ejec');
        $listaPorOrden=$this->Model_Dashboard_Reporte->DetallePorOrden($correlativoMeta,$anioMeta,$sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/DetalleConcepto',['listaPorOrden'=>$listaPorOrden,'meta'=>$correlativoMeta, 'anio'=>$anioMeta,'sec_ejec'=>$sec_ejec ]);
    }

    function detallePedidoCompraMeta()
    {
        $correlativoMeta=$this->input->GET('meta');
        $anioMeta=$this->input->GET('anio');
        $sec_ejec=$this->input->GET('sec_ejec');

        $listaDetallePorPedidoCompraMeta=$this->Model_Dashboard_Reporte->DetallePedidoCompraMeta($correlativoMeta, $anioMeta, $sec_ejec);

        $nombre_usuario = $this->session->userdata('nombreUsuario');
        $tipo_usuario = $this->session->userdata('cod_usuario_tipo');

        $this->load->view('front/Reporte/ProyectoInversion/detallePedidoCompraMeta',['tipo_usuario' => $tipo_usuario, 'listaDetallePorPedidoCompraMeta'=>$listaDetallePorPedidoCompraMeta,'meta'=>$correlativoMeta,'annio'=>$anioMeta,'uecod'=>$sec_ejec]);
    }

    function detallePorCadaPedido()
    {
        $nropedido=$this->input->GET('nropedido');
        $anio=$this->input->GET('anio');
        $tipopedido=$this->input->GET('tipopedido');
        $tipobien=$this->input->GET('tipobien');
        $sec_ejec=$this->input->GET('sec_ejec');

        $listadetalleporcadapedido=$this->Model_Dashboard_Reporte->DetallePorCadaPedido($nropedido,$anio,$tipopedido,$tipobien,$sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/detallePorCadaPedido',['listadetalleporcadapedido'=>$listadetalleporcadapedido]);
    }

    function estadoPedido()
    {
        $nropedido=$this->input->GET('nropedido');
        $anio=$this->input->GET('anio');
        $tipopedido=$this->input->GET('tipopedido');
        $tipobien=$this->input->GET('tipobien');
        $sec_ejec=$this->input->GET('sec_ejec');

        $getPersonal =  $this->Model_Personal->verTodo();
        $listadetalleporcadapedido=$this->Model_Dashboard_Reporte->DetallePorCadaPedido($nropedido,$anio,$tipopedido,$tipobien,$sec_ejec);

        $orderStatus = $this->Model_Estado_Pedido->getOrderStatus($listadetalleporcadapedido[0]->NRO_PEDIDO);

        $historialPedidoEstado=$this->Model_Estado_Pedido->historialPedidoEstado($nropedido);

        $this->load->view('front/Reporte/ProyectoInversion/estadoPedido',['nropedido' => $nropedido,'historialPedidoEstado'=> $historialPedidoEstado, 'orderStatus' => $orderStatus,'getPersonal' => $getPersonal, 'listadetalleporcadapedido'=>$listadetalleporcadapedido]);
    }

    function estadoPedidoShow()
    {
        $nropedido=$this->input->GET('nropedido');
        $anio=$this->input->GET('anio');
        $tipopedido=$this->input->GET('tipopedido');
        $tipobien=$this->input->GET('tipobien');
        $sec_ejec=$this->input->GET('sec_ejec');

        $getPersonal =  $this->Model_Personal->verTodo();
        $listadetalleporcadapedido=$this->Model_Dashboard_Reporte->DetallePorCadaPedido($nropedido,$anio,$tipopedido,$tipobien,$sec_ejec);

        $orderStatus = $this->Model_Estado_Pedido->getOrderStatus($listadetalleporcadapedido[0]->NRO_PEDIDO);
        $historialPedidoEstado=$this->Model_Estado_Pedido->historialPedidoEstado($nropedido);

        $this->load->view('front/Reporte/ProyectoInversion/estadoPedidoShow',['nropedido' => $nropedido,'historialPedidoEstado'=> $historialPedidoEstado, 'orderStatus' => $orderStatus,'getPersonal' => $getPersonal, 'listadetalleporcadapedido'=>$listadetalleporcadapedido]);
    }

    function listaExpedientes()
    {
        $anio=$this->input->GET('anio');
        $codigounico=$this->input->GET('codigounico');
        $sec_ejec=$this->input->GET('sec_ejec');

        $listaExpediente=$this->Model_Dashboard_Reporte->listaExpedientes($anio,$codigounico,$sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/listaExpediente',['listaExpediente'=>$listaExpediente]);
    }

    function detalleOrdenExpSiaf()
    {
        if($_GET)
        {
            $anio=$this->input->GET('anio');
            $expsiaf=$this->input->GET('expsiaf');
            $sec_ejec=(int)$this->input->GET('sec_ejec');
            $datoExpediente=$this->Model_Dashboard_Reporte->DetalleConsultaExpedSiaf($anio,$expsiaf,$sec_ejec);
            $expedienteSecuencia=$this->Model_Dashboard_Reporte->Consulta_Expediente_Secuencia($anio,$expsiaf,$sec_ejec);
            $this->load->view('front/Reporte/ProyectoInversion/detalleOrdenExpSiaf.php',['datoExpediente'=>$datoExpediente, 'expedienteSecuencia'=>$expedienteSecuencia, 'anio_up'=>$anio, 'exp_up'=>$expsiaf, 'actualizador'=>true]);
        }

    }

    function detalleOrdenExpSiafUe()
    {
        $anio=$this->input->GET('anio');
        $expsiaf=$this->input->GET('expsiaf');
        $sec_ejec=$this->input->GET('sec_ejec');

        $listaExpSiaf=$this->Model_Dashboard_Reporte->DetalleOrdenExpedSiafUE($anio,$expsiaf,$sec_ejec);
        $this->load->view('front/Reporte/ProyectoInversion/detalleOrdenExpSiaf.php',['listadetalleOrdenExpSiaf'=>$listaExpSiaf, 'anio_up'=>$anio, 'exp_up'=>$expsiaf, 'actualizador'=>false]);
    }

    function detallePorCadaNumOrden()
    {
        $anio=$this->input->GET('anio');
        $tipobien=$this->input->GET('tipobien');
        $numorden=$this->input->GET('numorden');
        $tipoppto=$this->input->GET('tipoppto');
        $sec_ejec=$this->input->GET('sec_ejec');
        $listaDetallePorCadaOrden=$this->Model_Dashboard_Reporte->DetallePorCadaNumOrden($anio, $tipobien, $numorden, $tipoppto, $sec_ejec);

        $this->load->view('front/Reporte/ProyectoInversion/detallePorCadaOrden.php',['listaDetallePorCadaOrden'=>$listaDetallePorCadaOrden]);
    }

    function especificacionOrden()
    {
        $anio=$this->input->GET('anio');
        $tipobien=$this->input->GET('tipobien');
        $numorden=$this->input->GET('numorden');
        $sec_ejec=$this->input->GET('sec_ejec');

        $EspecificacionOrden=$this->Model_Dashboard_Reporte->EspecificacionOrden($anio,$tipobien,$numorden, $sec_ejec);

        $this->load->view('front/Reporte/ProyectoInversion/EspecificacionOrden.php',['EspecificacionOrden'=>$EspecificacionOrden]);
    }

    public function _load_layout($template)
    {
        $this->load->view('layout/Reportes/header');
        $this->load->view($template);
        $this->load->view('layout/Reportes/footer');
    }

    function conformidadPedido()
    {
        $nro_orden=$this->input->GET('nro_orden');
        $conformidad_orden = $this->Model_ProyectoInversion->getConformidadOrden($nro_orden);
        $this->load->view('front/Reporte/ProyectoInversion/conformidadPedido',['nro_orden' => $nro_orden, 'conformidad_orden' => $conformidad_orden]);
    }

    function ordenServicio()
    {
        $nro_orden=$this->input->GET('nro_orden');
        $conformidad_orden = $this->Model_ProyectoInversion->getOrdenServicio($nro_orden);
        $this->load->view('front/Reporte/ProyectoInversion/ordenServicio',['nro_orden' => $nro_orden, 'conformidad_orden' => $conformidad_orden]);
    }
    
    function RestoreDB(){
        if ($this->input->is_ajax_request()) {
            //$anio_meta=$this->input->post('anio_meta');
            //$sec_ejec=$this->input->post('sec_ejec');
            $data = $this->Model_ProyectoInversion->RestoreDB();
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    //DATA S10

}
