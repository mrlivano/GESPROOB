<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProyectoInversion extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('Model_Dashboard_Reporte');
        $this->load->model('NaturalezaInversion_Model');
        $this->load->model('NivelGobierno_Model');
        $this->load->model('Model_UnidadE');
        $this->load->model('Model_Funcion');
        $this->load->model('Model_DivisionFuncional');
        $this->load->model('Model_GrupoFuncional');
        $this->load->model('Model_Gerencia');
        $this->load->model('Model_SubGerencia');
        $this->load->model('Model_Oficina');
        $this->load->model('TipologiaInversion_Model');
        $this->load->model('Model_ProgramaPresupuestal');
        $this->load->model('bancoproyectos_modal');
        $this->load->model('Model_RubroE');         
        $this->load->model('Model_UnidadF');    
        $this->load->model('TipoNoPip_Model');    
        $this->load->model('Model_NoPip');   
        $this->load->model('Model_OficinaR'); 
    
    //$this->load->library('mydompdf');
    
        $this->load->helper('FormatNumber_helper');
    
    
  }
public function ReporteAvanceFinanciero()
    {
     $gerenciaFULL='TOTAL';
     $costo_totalFULL=0;
     $PIM_Acumulado_TotalFULL=0;
     $Certificado_TotalFULL=0;
     $Avance_PIM_Certificado_TotalFULL=0;
     $Devengado_TotalFULL=0;
     $Avance_PIM_Devengado_TotalFULL=0;
     $Seguimiento_TotalFULL=0;
     $Por_Gastar_TotalFULL=0;
     $dataArray=array();
     $dataArray2=array();
     $dataArray3=array();
     $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
     $sec_ejec = isset($_GET['sec_ejec']) ? $_GET['sec_ejec'] : null;
     $tipo_proyecto = isset($_GET['tipo_proyecto']) ? $_GET['tipo_proyecto'] : null;

        $result_ue = [];
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $unidad_ejec='000747';
        if($tipoUsuario==9)
        {
            $lista_ue = $this->db->query("select sec_ejec,cast( cast(sec_ejec as int)  as varchar(100)) as codigo_ue , cast( cast(sec_ejec as int)  as varchar(100)) + ' - ' + nombre unidad_ejec from DBSIAF.dbo.entidad_estado order by sec_ejec");
            if($lista_ue->num_rows()>0)
            $result_ue = $lista_ue->result();
        }
        else
        {
            $lista_ue = $this->db->query("select sec_ejec,cast( cast(sec_ejec as int)  as varchar(100)) as codigo_ue , cast( cast(sec_ejec as int)  as varchar(100)) + ' - ' + nombre unidad_ejec from DBSIAF.dbo.entidad_estado where sec_ejec like '%".$this->session->userdata('codigoUE')."%'");
            if($lista_ue->num_rows()>0)
            {
                $result_ue = $lista_ue->result();
                $unidad_ejec=$result_ue[0]->sec_ejec;
            }
        }

        if(is_null($anio))
            $anio = date("Y");
        if(is_null($sec_ejec ))
            $sec_ejec = $unidad_ejec;
        if(is_null($tipo_proyecto))
            $tipo_proyecto = '1';

        $Ger=$this->db->query("select id_oficina, denom_oficina from oficinaR where id_ue='1'");
        $cantTotalProy=0;
        $cuenta =0; 
        $avanCertTotal=0;
        $avanDevenTotal=0;
        $cantidadProyectosSinOfi = 0;

        foreach ($Ger->result() as $key => $value) {
          
          $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvancePorOficina($value->id_oficina,$anio, $sec_ejec, $tipo_proyecto);
         if ($data!=null) {
          $gerencia=$value->denom_oficina;

          foreach ($data as $key1 => $value1)
          {
              $modificacion=$this->Model_Dashboard_Reporte->NotaModificatoriaDet($anio,$value1->sec_ejec,$value1->sec_func);
              $value1->modificacion = $modificacion->monto_a - $modificacion->monto_de;
          }

          $cantidadProyectos = 0;
          foreach ($data as $key2 => $value2)
          {
              if($value2->devengado!='.00' || $value2->devengado!='')
              {
                  $cantidadProyectos++;
                  $cantTotalProy++;
              }
          }

          $result = [];
          $lista_tipos = $this->db->query("select distinct tipo_proyecto from DBSIAF.dbo.act_proy_nombre where ano_eje = '$anio'");
          if ($lista_tipos->num_rows()> 0)
            $result = $lista_tipos->result();
          
          $costo_total=0;
          $PIM_Acumulado_Total=0;
          $Certificado_Total=0;
          $Avance_PIM_Certificado_Total=0;
          $Devengado_Total=0;
          $Avance_PIM_Devengado_Total=0;
          $Seguimiento_Total=0;
          $Por_Gastar_Total=0;
          
          foreach ($data as $key3 => $value3)
          {
              if($value3->devengado!='.00' || $value3->devengado!='' )
              {
                  
                  $costo_total+=$value3->costo_actual;
                  $PIM_Acumulado_Total+=($value3->modificacion+$value3->pim_acumulado);//$value->pim_acumulado;
                  $Certificado_Total+=$value3->monto_certificado;
                  $Avance_PIM_Certificado_Total+=$value3->avance_pim_cert/$cantidadProyectos;
                  $avanCertTotal+=$value3->avance_pim_cert;
                  $Devengado_Total+=$value3->devengado;
                  $Avance_PIM_Devengado_Total+=$value3->avance_pim_deven/$cantidadProyectos;
                  $avanDevenTotal+=$value3->avance_pim_deven;
                  $Seguimiento_Total+=$value3->para_seguimiento;
                  $Por_Gastar_Total+=$value3->saldo_por_gastar;
              }
          }
              
                
              
               $dataArray2['gerencia']= $gerencia;
               $dataArray2['cantidadProyectos']=$cantidadProyectos;
               $dataArray2['costo_total'] =$costo_total;
               $dataArray2['PIM_Acumulado_Total'] = $PIM_Acumulado_Total;
               $dataArray2['Certificado_Total'] = $Certificado_Total;
               $dataArray2['Avance_PIM_Certificado_Total']= $Avance_PIM_Certificado_Total;
               $dataArray2['Devengado_Total']= $Devengado_Total;
               $dataArray2['Avance_PIM_Devengado_Total']= $Avance_PIM_Devengado_Total;
               $dataArray2['Seguimiento_Total']= $Seguimiento_Total;
               $dataArray2['Por_Gastar_Total']= $Por_Gastar_Total;
              
              array_push($dataArray, $dataArray2);
               $costo_totalFULL=$costo_totalFULL+$costo_total;
               $PIM_Acumulado_TotalFULL=$PIM_Acumulado_TotalFULL+$PIM_Acumulado_Total;
               $Certificado_TotalFULL=$Certificado_TotalFULL+$Certificado_Total;
               $Avance_PIM_Certificado_TotalFULL=$Avance_PIM_Certificado_TotalFULL+$Avance_PIM_Certificado_Total;
               $Devengado_TotalFULL=$Devengado_TotalFULL+$Devengado_Total;
               $Avance_PIM_Devengado_TotalFULL=$Avance_PIM_Devengado_TotalFULL+$Avance_PIM_Devengado_Total;
               $Seguimiento_TotalFULL=$Seguimiento_TotalFULL+$Seguimiento_Total;
               $Por_Gastar_TotalFULL=$Por_Gastar_TotalFULL+$Por_Gastar_Total;
               $cuenta++;
                }
            }
                $dataSinOfi=$this->Model_Dashboard_Reporte->avanceSinOficina($anio, $sec_ejec, $tipo_proyecto);
                 if ($dataSinOfi!=null) {
                  $gerencia=$value->denom_oficina;

                  foreach ($dataSinOfi as $key4 => $value4)
                  {
                      $modificacionSinOfi=$this->Model_Dashboard_Reporte->NotaModificatoriaDet($anio,$value4->sec_ejec,$value4->sec_func);
                      $value4->modificacion = $modificacionSinOfi->monto_a - $modificacionSinOfi->monto_de;
                  }

                  
                  foreach ($dataSinOfi as $key5 => $value5)
                  {
                      if($value5->devengado!='.00' || $value5->devengado!='')
                      {
                          $cantidadProyectosSinOfi++;
                      }
                  }

                  $resultSinOfi = [];
                  $lista_tipos = $this->db->query("select distinct tipo_proyecto from DBSIAF.dbo.act_proy_nombre where ano_eje = '$anio'");
                  if ($lista_tipos->num_rows()> 0)
                    $result = $lista_tipos->result();                  
                    $costo_totalNO=0;
                    $PIM_Acumulado_TotalNO=0;
                    $Certificado_TotalNO=0;
                    $Avance_PIM_Certificado_TotalNO=0;
                    $Devengado_TotalNO=0;
                    $Avance_PIM_Devengado_TotalNO=0;
                    $Seguimiento_TotalNO=0;
                    $Por_Gastar_TotalNO=0;
                  
                  foreach ($dataSinOfi as $key6 => $value6)
                  {
                      if($value6->devengado!='.00' || $value6->devengado!='' )
                      {
                          
                          $costo_totalNO+=$value6->costo_actual;
                          $PIM_Acumulado_TotalNO+=($value6->modificacion+$value6->pim_acumulado);//$value->pim_acumulado;
                          $Certificado_TotalNO+=$value6->monto_certificado;
                          $Avance_PIM_Certificado_TotalNO+=$value6->avance_pim_cert/$cantidadProyectosSinOfi;
                          $Devengado_TotalNO+=$value6->devengado;
                          $Avance_PIM_Devengado_TotalNO+=$value6->avance_pim_deven/$cantidadProyectosSinOfi;                        
                          $Seguimiento_TotalNO+=$value6->para_seguimiento;
                          $Por_Gastar_TotalNO+=$value6->saldo_por_gastar;
                      }
                      $dataArray3['sinOficina']='SIN ASIGNAR GERENCIA(OFICINA)';
                      $dataArray3['cantidadProyectosNO']=$cantidadProyectosSinOfi;
                      $dataArray3['costo_totalNO']=$costo_totalNO;
                      $dataArray3['PIM_Acumulado_TotalNO']=$PIM_Acumulado_TotalNO;
                      $dataArray3['Certificado_TotalNO']=$Certificado_TotalNO;
                      $dataArray3['Avance_PIM_Certificado_TotalNO']=$Avance_PIM_Certificado_TotalNO;                      
                      $dataArray3['Devengado_TotalNO']=$Devengado_TotalNO;
                      $dataArray3['Avance_PIM_Devengado_TotalNO']=$Avance_PIM_Devengado_TotalNO;                      
                      $dataArray3['Seguimiento_TotalNO']=$Seguimiento_TotalNO;
                      $dataArray3['Por_Gastar_TotalNO']=$Por_Gastar_TotalNO;
                  }
                  if($cuenta!=0){
               $dataArray2['gerencia']= $gerenciaFULL;
               $dataArray2['cantidadProyectos']=$cantTotalProy+$cantidadProyectosSinOfi;
               $dataArray2['costo_total'] =$costo_totalFULL+$costo_totalNO;
               $dataArray2['PIM_Acumulado_Total'] = $PIM_Acumulado_TotalFULL+$PIM_Acumulado_TotalNO;
               $dataArray2['Certificado_Total'] = $Certificado_TotalFULL+$Certificado_TotalNO;
               $dataArray2['Avance_PIM_Certificado_Total']= $avanCertTotal/($cantTotalProy+$cantidadProyectosSinOfi);
               $dataArray2['Devengado_Total']= $Devengado_TotalFULL+$Devengado_TotalNO;
               $dataArray2['Avance_PIM_Devengado_Total']= $avanDevenTotal/($cantTotalProy+$cantidadProyectosSinOfi);
               $dataArray2['Seguimiento_Total']= $Seguimiento_TotalFULL+$Seguimiento_TotalNO;
               $dataArray2['Por_Gastar_Total']= $Por_Gastar_TotalFULL+$Por_Gastar_TotalNO;
              
              }
            }

        $listaUnidadEjecutora = $this->Model_UnidadE->getUnidadEjecutoraOpciones();
        $listaInsumoNivel1 = $this->Model_OficinaR->listaOficinaNivel1(1);
            foreach ($listaInsumoNivel1 as $key => $value) 
            {
                $value->hasChild = ($value->n==0 ? false : true);
            }
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/ProyectoInversion/AvanceFinancieroPorOficina',['Consolidado' => $data,'anio' =>$anio, 'unidadEjecutora'=>$sec_ejec,'tipoProyecto'=>$tipo_proyecto,'dataArray'=>$dataArray,'datatotal'=>$dataArray2,'sinOficina'=>$dataArray3,'lista_tipos' => $result, 'lista_ue' => $result_ue,'listaUnidadEjecutora'=>$listaUnidadEjecutora,'listaNivel1'=>$listaInsumoNivel1]);
        $this->load->view('layout/Reportes/footer');
    
        
    }
  }