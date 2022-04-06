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
        $this->load->model('Model_ET_Expediente_Tecnico');
        
		
		//$this->load->library('mydompdf');
		
        $this->load->helper('FormatNumber_helper');
		
		
	}

    function GetProyectoInversion()
  	{
  		if ($this->input->is_ajax_request())
  		{
  		$datos=$this->Model_ProyectoInversion->ProyectoInversion();
  		echo json_encode($datos);
  		}
  		else
  		{
  			show_404();
  		}
  	}

    function GetProyectoInversionUltimo()
    {
        if ($this->input->is_ajax_request())
        {
            $datos=$this->Model_ProyectoInversion->GetProyectoInversionUltimo();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    function BuscarProyectoInversion()
    {
        if ($this->input->is_ajax_request())
        {
            $Id_ProyectoInver = $this->input->post("Id_ProyectoInver");
            $datos=$this->Model_ProyectoInversion->BuscarProyectoInversion($Id_ProyectoInver);
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    public function index()
    {
        $this->_load_layout('Front/Pmi/frmMProyectoInversion');
    }

    public function ReporteBuscadorPorPip($codigo='')
    {
	    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $this->load->view('layout/Reportes/header');
	    $this->load->view('front/Reporte/ProyectoInversion/index',["codigo" => $codigo]);
	    $this->load->view('layout/Reportes/footer');
    }

    public function ReporteImportadorPorPip($codigo='')
    {
	    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $this->load->view('layout/Reportes/header');
	    $this->load->view('front/Reporte/ProyectoInversion/cargarS10',["codigo" => $codigo]);
	    $this->load->view('layout/Reportes/footer');
    }

	
	public function ReportePipPedidos()
	{
		$anno_r = $_GET['annos'];
		$ue_r = $_GET['ue'];
		$meta_r = $_GET['meta'];
		$mes_r = $_GET['mes'];
		
		

		$listareporte=$this->Model_ProyectoInversion->ReportePIPPedidosMes($anno_r,$ue_r ,$meta_r, $mes_r );

         $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePipPedidos',["listareporte" => $listareporte, "titulo" =>"REPORTE PEDIDOS", "anno"=>$anno_r, "meta"=>$meta_r, "mes"=> $mes_r]);
		//$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePipPedidos',["listareporte" => $listareporte, "titulo" =>"REPORTE PEDIDOS", "anno"=>$anno_r, "meta"=>$meta_r, "mes"=> $mes_r],true);
		//$this->mydompdf->load_html($html);
		//$this->mydompdf->set_paper("A4", "portrait");
		//$this->mydompdf->render();
		//$this->mydompdf->stream("FormatoFF-01.pdf", array("Attachment" => false));

	}

		
	public function ReportePipOrdenesGeneral() //REPORTE DE ORDENES
	{
		$anno_r = $_GET['annos'];
		$ue_r = $_GET['ue'];
		$meta_r = $_GET['meta'];
		$mes_r = $_GET['mes'];
		
		

		// $listareporte=$this->Model_ProyectoInversion->ReportePIPPedidosMes($anno_r,$ue_r ,$meta_r, $mes_r );
		  $listaPorOrden=$this->Model_Dashboard_Reporte->DetallePorOrdenMES($meta_r,$anno_r,$ue_r,$mes_r);
		  
         $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePipOrdenes',["listareporte" => $listaPorOrden, "titulo" =>"REPORTE ORDENES", "anno"=>$anno_r, "meta"=>$meta_r, "mes"=> $mes_r]);
		 
		 	 
			 


		 
		//$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePipPedidos',["listareporte" => $listareporte, "titulo" =>"REPORTE PEDIDOS", "anno"=>$anno_r, "meta"=>$meta_r, "mes"=> $mes_r],true);
		//$this->mydompdf->load_html($html);
		//$this->mydompdf->set_paper("A4", "portrait");
		//$this->mydompdf->render();
		//$this->mydompdf->stream("FormatoFF-01.pdf", array("Attachment" => false));

	}

	
	
	
	
    public function ReporteBuscadorPorAnio()
    {
		$anio = isset($_GET['anio']) ? $_GET['anio'] : null;
		$sec_ejec = isset($_GET['sec_ejec']) ? $_GET['sec_ejec'] : null;
        $tipo_proyecto = isset($_GET['tipo_proyecto']) ? $_GET['tipo_proyecto'] : null;

        $result_ue = [];
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $unidad_ejec='001549';
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

        $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvanceFisicoFinan($anio, $sec_ejec, $tipo_proyecto);

        $cantidadProyectos = 0;
        foreach ($data as $key => $value)
        {
            if($value->devengado!='.00' || $value->devengado!='')
            {
                $cantidadProyectos++;
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

        foreach ($data as $key => $value)
        {
            if($value->devengado!='.00' || $value->devengado!='' )
            {
                $costo_total+=$value->costo_actual;
                $PIM_Acumulado_Total+=($value->modificacion+$value->pim_acumulado);//$value->pim_acumulado;
                $Certificado_Total+=$value->monto_certificado;
                $Avance_PIM_Certificado_Total+=$value->avance_pim_cert/$cantidadProyectos;
                $Devengado_Total+=$value->devengado;
                $Avance_PIM_Devengado_Total+=$value->avance_pim_deven/$cantidadProyectos;
                $Seguimiento_Total+=$value->para_seguimiento;
                $Por_Gastar_Total+=$value->saldo_por_gastar;
            }
        }

        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/ProyectoInversion/seguimientoCertificado',['Consolidado' => $data,'anio' =>$anio, 'unidadEjecutora'=>$sec_ejec,'tipoProyecto'=>$tipo_proyecto,'costo_total'=>$costo_total,'PIM_Acumulado_Total'=>$PIM_Acumulado_Total,'Certificado_Total'=>$Certificado_Total,'Avance_PIM_Certificado_Total'=>$Avance_PIM_Certificado_Total,'Devengado_Total'=>$Devengado_Total,'Avance_PIM_Devengado_Total'=>$Avance_PIM_Devengado_Total,'Seguimiento_Total'=>$Seguimiento_Total,'Por_Gastar_Total'=>$Por_Gastar_Total,'lista_tipos' => $result, 'lista_ue' => $result_ue]);
        $this->load->view('layout/Reportes/footer');
    }

	public function addConformidad()
    {
        if ($this->input->is_ajax_request())
  		{
          $msg = array();
          $nombreArchivo = trim(addslashes($_FILES['conformidadFile']['name']));

          $path_parts = pathinfo($nombreArchivo);

					if($nombreArchivo != '' || $nombreArchivo != null) {
						$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $path_parts['extension'] );
						$c_data['pathfile'] = $nombreArchivo;
						$c_data['nro_orden']= $this->input->post("nro_orden");
					}

					$ultimoId = $this->Model_ProyectoInversion->insertConformidad($c_data);

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
							$config['upload_path'] = './uploads/ConformidadOrden/';
              $config['allowed_types'] = '*';
              //$config['max_width']     = 1024;
        			//$config['max_height']    = 768;
        			$config['file_name'] = $nombreArchivo;
        			$config['max_size'] = '20048';
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('conformidadFile'))
              {
								$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                $this->load->view('front/json/json_view',['datos' => $msg]);
                return;
              }
            }

    				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
    				$this->load->view('front/json/json_view', ['datos' => $msg]);
  		}
  		else
  		{
  				show_404();
  		}
    }

		public function updateConformidad()
    {
      if ($this->input->is_ajax_request())
  		{
          $msg = array();
          $nombreArchivo = trim(addslashes($_FILES['conformidadFile']['name']));

          $path_parts = pathinfo($nombreArchivo);

					if($nombreArchivo != '' || $nombreArchivo != null) {
						$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $path_parts['extension'] );
						$pathfile = $nombreArchivo;
						$nro_orden = $this->input->post("nro_orden");
					}

					$ultimoId = $this->Model_ProyectoInversion->updateConformidad($pathfile, $nro_orden);

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
							$config['upload_path'] = './uploads/ConformidadOrden/';
              $config['allowed_types'] = '*';
              //$config['max_width']     = 1024;
        			//$config['max_height']    = 768;
        			$config['file_name'] = $nombreArchivo;
        			$config['max_size'] = '20048';
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('conformidadFile'))
              {
								$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                $this->load->view('front/json/json_view',['datos' => $msg]);
                return;
              }
            }

    				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
    				$this->load->view('front/json/json_view', ['datos' => $msg]);
  		}
  		else
  		{
  				show_404();
  		}
    }

		public function addOrdenServicio()
    {
      if ($this->input->is_ajax_request())
  		{
          $msg = array();
          $nombreArchivo = trim(addslashes($_FILES['conformidadFile']['name']));

          $path_parts = pathinfo($nombreArchivo);

					if($nombreArchivo != '' || $nombreArchivo != null) {
						$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $path_parts['extension'] );
						$c_data['pathfile'] = $nombreArchivo;
						$c_data['nro_orden']= $this->input->post("nro_orden");
					}

					$ultimoId = $this->Model_ProyectoInversion->insertOrdenServicio($c_data);

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
							$config['upload_path'] = './uploads/ConformidadOrden/';
              $config['allowed_types'] = '*';
              //$config['max_width']     = 1024;
        			//$config['max_height']    = 768;
        			$config['file_name'] = $nombreArchivo;
        			$config['max_size'] = '20048';
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('conformidadFile'))
              {
								$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                $this->load->view('front/json/json_view',['datos' => $msg]);
                return;
              }
            }

    				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
    				$this->load->view('front/json/json_view', ['datos' => $msg]);
  		}
  		else
  		{
  				show_404();
  		}
    }

		public function updateOrdenServicio()
    {
      if ($this->input->is_ajax_request())
  		{
          $msg = array();
          $nombreArchivo = trim(addslashes($_FILES['conformidadFile']['name']));

          $path_parts = pathinfo($nombreArchivo);

					if($nombreArchivo != '' || $nombreArchivo != null) {
						$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $path_parts['extension'] );
						$pathfile = $nombreArchivo;
						$nro_orden = $this->input->post("nro_orden");
					}

					$ultimoId = $this->Model_ProyectoInversion->updateOrdenServicio($pathfile, $nro_orden);

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
							$config['upload_path'] = './uploads/OrdenServicio/';
              $config['allowed_types'] = '*';
              //$config['max_width']     = 1024;
        			//$config['max_height']    = 768;
        			$config['file_name'] = $nombreArchivo;
        			$config['max_size'] = '20048';
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('conformidadFile'))
              {
								$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                $this->load->view('front/json/json_view',['datos' => $msg]);
                return;
              }
            }

    				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
    				$this->load->view('front/json/json_view', ['datos' => $msg]);
  		}
  		else
  		{
  				show_404();
  		}
    }

    function _load_layout($template)
    {
      $this->load->view('layout/PMI/header');
      $this->load->view($template);
      $this->load->view('layout/PMI/footer');
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();
            $numPip = count($this->Model_ProyectoInversion->ProyectoPorCodigoUnicoDiferente($this->input->post('txtCodigoUnico'),$this->input->post('hdIdPI')));
            if($numPip > 0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Este proyecto ya ha sido registrado con anterioridad']);
                echo json_encode($msg);exit;
            }
            $u_data['id_ue']=$this->input->post('selectUnidadEjecutora');
            $u_data['id_naturaleza_inv']=$this->input->post('selectNaturaleza');
            $u_data['id_tipologia_inv']=$this->input->post('selectTipologiaInversion');
            $u_data['id_tipo_inversion']=1;
            $u_data['id_grupo_funcional']=$this->input->post('selectGrupoFuncional');
            $u_data['id_oficina']=$this->input->post('selectOficina');
            $u_data['id_nivel_gob']=$this->input->post('selectNivelGobierno');
            $u_data['id_programa_pres']=$this->input->post('selectPrograma');
            $u_data['codigo_unico_pi']=$this->input->post('txtCodigoUnico');
            $u_data['nombre_pi']=$this->input->post('txtProyecto');
            $u_data['costo_pi']=floatval(str_replace(",","",$this->input->post("txtCostoInversion")));
            $u_data['num_beneficiarios']=$this->input->post('txtNumBeneficiarios');
            $u_data['fecha_viabilidad_pi']=$this->input->post('txtFechaViabilidad');
            $u_data['id_uf']=$this->input->post('selectUnidadFormuladora');
            $u_data['estado_pi']=$this->input->post('selectEstado');
            $data=$this->Model_ProyectoInversion->editar($this->security->xss_clean($u_data), $this->input->post('hdIdPI'));
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        $accion='editar';
        $idProyecto = $this->input->get('codigo');
        $proyectoInversion = $this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);
        $naturaleza=$this->NaturalezaInversion_Model->ListaNaturalezaInversion();
        $nivelGobiero=$this->NivelGobierno_Model->ListaNivelGobierno();
        $unidadEjecutora=$this->Model_UnidadE->ListaUnidadEjecutora();
        $tipologia=$this->TipologiaInversion_Model->ListaTipologiaInversion();
        $programa=$this->Model_ProgramaPresupuestal->ListaProgramaPresupuestal();
        $unidadFormuladora=$this->Model_UnidadF->ListaUnidadFormuladora();
        $funcion=$this->Model_Funcion->GetListaFuncion();
        $divisionfuncional=$this->Model_DivisionFuncional->DivisionFuncionalPorFuncion($proyectoInversion[0]->id_funcion);        
        $grupofuncional=$this->Model_GrupoFuncional->GrupoFuncionalPorDivisionFuncional($proyectoInversion[0]->id_div_funcional);
        $gerencia=$this->Model_Gerencia->GetListaGerencia();
        $subgerencia=$this->Model_SubGerencia->SubGerenciaPorGerencia($proyectoInversion[0]->id_gerencia);
        $oficina=$this->Model_Oficina->OficinaPorSubGerencia($proyectoInversion[0]->id_subgerencia);
        $this->load->view('front/Pmi/ProyectoInversion/insertar', ['accion'=>$accion,'proyectoInversion' => $proyectoInversion,'naturaleza'=>$naturaleza,'nivelGobiero'=>$nivelGobiero,'unidadEjecutora'=>$unidadEjecutora,'funcion'=>$funcion,'divisionfuncional'=>$divisionfuncional,'grupofuncional'=>$grupofuncional,'tipologia'=>$tipologia,'programa'=>$programa,'unidadFormuladora'=>$unidadFormuladora,'gerencia'=>$gerencia,'subgerencia'=>$subgerencia,'oficina'=>$oficina]);
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $numPip = count($this->Model_ProyectoInversion->ProyectoPorCodigoUnico($this->input->post('txtCodigoUnico')));
            if($numPip > 0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Este proyecto ya ha sido registrado con anterioridad']);
                echo json_encode($msg);exit;
            }
            $u_data['id_ue']=$this->input->post('selectUnidadEjecutora');
            $u_data['id_naturaleza_inv']=$this->input->post('selectNaturaleza');
            $u_data['id_tipologia_inv']=$this->input->post('selectTipologiaInversion');
            $u_data['id_tipo_inversion']=1;
            $u_data['id_grupo_funcional']=$this->input->post('selectGrupoFuncional');
            //$u_data['id_oficina']=$this->input->post('selectOficina');
            $u_data['id_nivel_gob']=$this->input->post('selectNivelGobierno');
            $u_data['id_programa_pres']=$this->input->post('selectPrograma');
            $u_data['codigo_unico_pi']=$this->input->post('txtCodigoUnico');
            $u_data['nombre_pi']=$this->input->post('txtProyecto');
            $u_data['costo_pi']=floatval(str_replace(",","",$this->input->post("txtCostoInversion")));
            $u_data['num_beneficiarios']=$this->input->post('txtNumBeneficiarios');
            $u_data['fecha_viabilidad_pi']=$this->input->post('txtFechaViabilidad');
            $u_data['id_uf']=$this->input->post('selectUnidadFormuladora');
            $u_data['estado_pi']=$this->input->post('selectEstado');
            $data=$this->Model_ProyectoInversion->Insert_pi_pip($this->security->xss_clean($u_data));
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        $accion='insertar';
        $naturaleza=$this->NaturalezaInversion_Model->ListaNaturalezaInversion();
        $nivelGobiero=$this->NivelGobierno_Model->ListaNivelGobierno();
        $unidadEjecutora=$this->Model_UnidadE->ListaUnidadEjecutora();
        $tipologia=$this->TipologiaInversion_Model->ListaTipologiaInversion();
        $programa=$this->Model_ProgramaPresupuestal->ListaProgramaPresupuestal();
        $unidadFormuladora=$this->Model_UnidadF->ListaUnidadFormuladora();
        $funcion=$this->Model_Funcion->GetListaFuncion();
        //$gerencia=$this->Model_Gerencia->GetListaGerencia();
        $this->load->view('front/Pmi/ProyectoInversion/insertar', ['accion'=>$accion,'naturaleza'=>$naturaleza,'nivelGobiero'=>$nivelGobiero,'unidadEjecutora'=>$unidadEjecutora,'funcion'=>$funcion,'tipologia'=>$tipologia,'programa'=>$programa,'unidadFormuladora'=>$unidadFormuladora]);
    }

    function inversionOARR()
    {
        if($_POST)
        {
            $this->db->trans_start();
            $msg = array();
            $numPip = count($this->Model_ProyectoInversion->ProyectoPorCodigoUnico($this->input->post('txtCodigoUnico')));
            if($numPip > 0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Este proyecto ya ha sido registrado con anterioridad']);
                echo json_encode($msg);exit;
            }
            $u_data['id_ue']=$this->input->post('selectUnidadEjecutora');            
            $u_data['id_tipo_inversion']=2;
            $u_data['id_grupo_funcional']=$this->input->post('selectGrupoFuncional');
            $u_data['id_nivel_gob']=$this->input->post('selectNivelGobierno');
            $u_data['codigo_unico_pi']=$this->input->post('txtCodigoUnico');
            $u_data['nombre_pi']=$this->input->post('txtProyecto');
            $u_data['costo_pi']=floatval(str_replace(",","",$this->input->post("txtCostoInversion")));
            $u_data['id_uf']=$this->input->post('selectUnidadFormuladora');
            $u_data['estado_pi']=$this->input->post('selectEstado');
            $data=$this->Model_ProyectoInversion->Insert_pi_pip($this->security->xss_clean($u_data));
            if($data>0)
            {
                $t_data['id_tipo_nopip']=$this->input->post('selectNaturaleza');
                $t_data['id_pi']=$data;
                $data=$this->Model_NoPip->insertar($this->security->xss_clean($t_data));
            }
            $this->db->trans_complete();
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        $accion='inversionOARR';
        $naturaleza=$this->TipoNoPip_Model->get_tipo_no_pip();
        $nivelGobiero=$this->NivelGobierno_Model->ListaNivelGobierno();
        $unidadEjecutora=$this->Model_UnidadE->ListaUnidadEjecutora();
        $unidadFormuladora=$this->Model_UnidadF->ListaUnidadFormuladora();
        $funcion=$this->Model_Funcion->GetListaFuncion();
        $this->load->view('front/Pmi/ProyectoInversion/insertarnopip', ['accion'=>$accion,'naturaleza'=>$naturaleza,'nivelGobiero'=>$nivelGobiero,'unidadEjecutora'=>$unidadEjecutora,'funcion'=>$funcion,'unidadFormuladora'=>$unidadFormuladora]);
    }

    function inversionOARReditar()
    {
        if($_POST)
        {
            $msg = array();
            $numPip = count($this->Model_ProyectoInversion->ProyectoPorCodigoUnicoDiferente($this->input->post('txtCodigoUnico'),$this->input->post('hdIdPI')));
            if($numPip > 0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Este proyecto ya ha sido registrado con anterioridad']);
                echo json_encode($msg);exit;
            }
            $u_data['id_ue']=$this->input->post('selectUnidadEjecutora');
            $u_data['id_grupo_funcional']=$this->input->post('selectGrupoFuncional');
            $u_data['id_nivel_gob']=$this->input->post('selectNivelGobierno');
            $u_data['codigo_unico_pi']=$this->input->post('txtCodigoUnico');
            $u_data['nombre_pi']=$this->input->post('txtProyecto');
            $u_data['costo_pi']=floatval(str_replace(",","",$this->input->post("txtCostoInversion")));
            $u_data['id_uf']=$this->input->post('selectUnidadFormuladora');
            $u_data['estado_pi']=$this->input->post('selectEstado');
            $data=$this->Model_ProyectoInversion->editar($this->security->xss_clean($u_data), $this->input->post('hdIdPI'));
            $t_data['id_tipo_nopip']=$this->input->post('selectNaturaleza');
            $this->Model_NoPip->editar($this->security->xss_clean($t_data), $this->input->post('hdIdNopip'));
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        $accion='inversionOARReditar';
        $idProyecto = $this->input->get('codigo');
        $proyectoInversion = $this->Model_ProyectoInversion->getProyectoInversionNoPipPorIdPi($idProyecto);
        $naturaleza=$this->TipoNoPip_Model->get_tipo_no_pip();
        $nivelGobiero=$this->NivelGobierno_Model->ListaNivelGobierno();
        $unidadEjecutora=$this->Model_UnidadE->ListaUnidadEjecutora();
        $unidadFormuladora=$this->Model_UnidadF->ListaUnidadFormuladora();
        $funcion=$this->Model_Funcion->GetListaFuncion();
        $divisionfuncional=$this->Model_DivisionFuncional->DivisionFuncionalPorFuncion($proyectoInversion[0]->id_funcion);        
        $grupofuncional=$this->Model_GrupoFuncional->GrupoFuncionalPorDivisionFuncional($proyectoInversion[0]->id_div_funcional);
        $this->load->view('front/Pmi/ProyectoInversion/insertarnopip', ['accion'=>$accion,'proyectoInversion' => $proyectoInversion,'naturaleza'=>$naturaleza,'nivelGobiero'=>$nivelGobiero,'unidadEjecutora'=>$unidadEjecutora,'funcion'=>$funcion,'divisionfuncional'=>$divisionfuncional,'grupofuncional'=>$grupofuncional,'unidadFormuladora'=>$unidadFormuladora]);
    }

    public function ReporteAvanceFinanciero()
    {
     $gerenciaFULL='TOTAL';
     $total_proyectos=0;
     $costo_totalFULL=0;
     $PIM_Acumulado_TotalFULL=0;
     $Certificado_TotalFULL=0;
     $Avance_PIM_Certificado_TotalFULL=0;
     $Devengado_TotalFULL=0;
     $Avance_PIM_Devengado_TotalFULL=0;
     $Seguimiento_TotalFULL=0;
     $Por_Gastar_TotalFULL=0;
     $cuenta=0;
     $dataArray=array();
     $dataArray2=array();
     $dataArray3=array();
     $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
     $sec_ejec = isset($_GET['sec_ejec']) ? $_GET['sec_ejec'] : null;
     $tipo_proyecto = isset($_GET['tipo_proyecto']) ? $_GET['tipo_proyecto'] : null;

        $result_ue = [];
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $unidad_ejec='001549';
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
        $cantidadProyectosSinOfi = 0;
        $result = [];
        $lista_tipos = $this->db->query("select distinct tipo_proyecto from DBSIAF.dbo.act_proy_nombre where ano_eje = '$anio'");
        if ($lista_tipos->num_rows()> 0)
          $result = $lista_tipos->result();

        foreach ($Ger->result() as $key => $value) {
          
          $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvancePorOficina($value->id_oficina,$anio, $sec_ejec, $tipo_proyecto);
         if ($data !=null and $data[0]->proys!=0) {
          $gerencia=$value->denom_oficina;
 
               $dataArray2['gerencia']= $gerencia;
               $dataArray2['cantidadProyectos']=$data[0]->proys;
               $dataArray2['costo_total'] =$data[0]->costo_total;
               $dataArray2['PIM_Acumulado_Total'] = $data[0]->pim_acumulado;
               $dataArray2['Certificado_Total'] = $data[0]->monto_certificado;
               $dataArray2['Avance_PIM_Certificado_Total']= $data[0]->avance_pim_cert;
               $dataArray2['Devengado_Total']= $data[0]->devengado;
               $dataArray2['Avance_PIM_Devengado_Total']= $data[0]->avance_pim_devengado;
               $dataArray2['Seguimiento_Total']= $data[0]->para_seguimiento;
               $dataArray2['Por_Gastar_Total']= $data[0]->saldo_por_gastar;
              
              array_push($dataArray, $dataArray2);
               $total_proyectos+=$data[0]->proys;
               $costo_totalFULL+=$data[0]->costo_total;
               $PIM_Acumulado_TotalFULL+=$data[0]->pim_acumulado;
               $Certificado_TotalFULL+=$data[0]->monto_certificado;
               $Avance_PIM_Certificado_TotalFULL+=$data[0]->avance_pim_cert*$data[0]->proys;
               $Devengado_TotalFULL+=$data[0]->devengado;
               $Avance_PIM_Devengado_TotalFULL+=$data[0]->avance_pim_devengado*$data[0]->proys;
               $Seguimiento_TotalFULL+=$data[0]->para_seguimiento;
               $Por_Gastar_TotalFULL+=$data[0]->saldo_por_gastar;
               
                }
            }
                $dataSinOfi=$this->Model_Dashboard_Reporte->avanceSinOficina($anio, $sec_ejec, $tipo_proyecto);
                 if ($dataSinOfi!=null) {
                  $gerencia=$value->denom_oficina;

                  $resultSinOfi = [];         
                              
                      $dataArray3['sinOficina']='SIN ASIGNAR GERENCIA(OFICINA)';
                      $dataArray3['cantidadProyectosNO']=$dataSinOfi[0]->proys;
                      $dataArray3['costo_totalNO']=$dataSinOfi[0]->costo_total;
                      $dataArray3['PIM_Acumulado_TotalNO']=$dataSinOfi[0]->pim_acumulado;
                      $dataArray3['Certificado_TotalNO']=$dataSinOfi[0]->monto_certificado;
                      $dataArray3['Avance_PIM_Certificado_TotalNO']=$dataSinOfi[0]->avance_pim_cert;                      
                      $dataArray3['Devengado_TotalNO']=$dataSinOfi[0]->devengado;
                      $dataArray3['Avance_PIM_Devengado_TotalNO']=$dataSinOfi[0]->avance_pim_devengado;                      
                      $dataArray3['Seguimiento_TotalNO']=$dataSinOfi[0]->para_seguimiento;
                      $dataArray3['Por_Gastar_TotalNO']=$dataSinOfi[0]->saldo_por_gastar;
                  
               $dataArray2['gerencia']= $gerenciaFULL;
               $dataArray2['cantidadProyectos']=$total_proyectos+$dataArray3['cantidadProyectosNO'];
               $dataArray2['costo_total'] =$costo_totalFULL+$dataArray3['costo_totalNO'];
               $dataArray2['PIM_Acumulado_Total'] = $PIM_Acumulado_TotalFULL+$dataArray3['PIM_Acumulado_TotalNO'];
               $dataArray2['Certificado_Total'] = $Certificado_TotalFULL+$dataArray3['Certificado_TotalNO'];
               $dataArray2['Avance_PIM_Certificado_Total']= $Avance_PIM_Certificado_TotalFULL/($total_proyectos+$dataArray3['cantidadProyectosNO']);
               $dataArray2['Devengado_Total']= $Devengado_TotalFULL+$dataArray3['Devengado_TotalNO'];
               $dataArray2['Avance_PIM_Devengado_Total']= $Avance_PIM_Devengado_TotalFULL/($total_proyectos+$dataArray3['cantidadProyectosNO']);
               $dataArray2['Seguimiento_Total']= $Seguimiento_TotalFULL+$dataArray3['Seguimiento_TotalNO'];
               $dataArray2['Por_Gastar_Total']= $Por_Gastar_TotalFULL+$dataArray3['Por_Gastar_TotalNO'];
            }

        $listaUnidadEjecutora = $this->Model_UnidadE->getUnidadEjecutoraOpciones();
        $listaInsumoNivel1 = $this->Model_OficinaR->listaOficinaNivel1(1);
            foreach ($listaInsumoNivel1 as $key => $value) 
            {
                $value->hasChild = ($value->n==0 ? false : true);
            }
        $datasinoficina=$this->Model_Dashboard_Reporte->proysinoficina($anio, $sec_ejec, $tipo_proyecto);
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/ProyectoInversion/AvanceFinancieroPorOficina',['Consolidado' => $data,'anio' =>$anio, 'unidadEjecutora'=>$sec_ejec,'tipoProyecto'=>$tipo_proyecto,'dataArray'=>$dataArray,'datatotal'=>$dataArray2,'sinOficina'=>$dataArray3,'datasinofi'=>$datasinoficina,'lista_tipos' => $result, 'lista_ue' => $result_ue,'listaUnidadEjecutora'=>$listaUnidadEjecutora]);
        $this->load->view('layout/Reportes/footer');
    
        
    }
    public function ReportePorOficina()
    { 
      $anio = $this->input->post("anio");
      $sec_ejec = $this->input->post("sec_ejec");
      $tipo_proyecto = $this->input->post("tipo_proyecto");
      $id_oficina = $this->input->post("id_oficina");
      $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvancePorOficina($id_oficina,$anio, $sec_ejec, $tipo_proyecto);
          
        echo json_encode($data);exit;

    }
    public function modalDetallesProyecto()
    {
      $anio = $this->input->post("anio");
      $sec_ejec = $this->input->post("sec_ejec");
      $tipo_proyecto = $this->input->post("tipo_proyecto");
      $act_proy=$this->input->post("act_proy");
      $data=$this->Model_Dashboard_Reporte->ReporteConsolidadoAvanceFisicoFinan($anio, $sec_ejec, $tipo_proyecto);
      $this->load->view('front/Reporte/ProyectoInversion/DetalleConcepto',['listaPorOrden'=>$listaPorOrden,'meta'=>$correlativoMeta, 'anio'=>$anioMeta,'sec_ejec'=>$sec_ejec ]);
    }
    public function proyectosPorOficina()
    {
      $anio = $this->input->post("anio");
      $sec_ejec = $this->input->post("sec_ejec");
      $tipo_proyecto = $this->input->post("tipo_proyecto");
      $id_oficina = $this->input->post("id_oficina");
      $data=$this->Model_Dashboard_Reporte->proyectosPorOficina($id_oficina,$anio, $sec_ejec, $tipo_proyecto);
      echo json_encode($data);exit;
    }
    function detalladoProyectoInversion()
    {
      $anio = $this->input->get("anio");
      $act_proy=$this->input->get("act_proy");
      $sec_func=$this->input->get("sec_func");
      $dataDetalle=$this->Model_Dashboard_Reporte->detalleProys($sec_func,$act_proy,$anio);
      $this->load->view('front/Reporte/ProyectoInversion/detalleProyectoInversion',['dataDetalle'=>$dataDetalle ]);
    }
    function listarProyecto()
    {
      $CodigoUnico=$this->input->post('CodigoProyecto');
      $proyectoInversion=$this->Model_ET_Expediente_Tecnico->ExpedienteContarRegistros($CodigoUnico);
      echo json_encode($proyectoInversion);exit;
    }

}
