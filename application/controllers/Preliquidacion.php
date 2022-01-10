<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preliquidacion extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('Preliquidacion_Model');

      $this->load->model('Model_ET_Expediente_Tecnico');
  		$this->load->model('Model_ET_Analisis_Unitario');
  		$this->load->model('Model_ET_Componente');
  		$this->load->model('Model_ET_Meta');
  		$this->load->model('Model_ET_Partida');
  		$this->load->model('Model_Personal');
  		$this->load->model("Model_ET_Tipo_Responsable");
  		$this->load->model("Model_ET_Responsable");
  		$this->load->model("Cargo_Modal");
  		$this->load->model("Model_ET_Presupuesto_Analitico");
  		$this->load->model("Model_ET_Img");
  		$this->load->model('Model_ET_Etapa_Ejecucion');
  		$this->load->model('Model_ET_Presupuesto_Ejecucion');
  		$this->load->model('Model_Personal');
  		$this->load->model('Model_ET_Detalle_Partida');
  		$this->load->model('Model_ET_Detalle_Analisis_Unitario');
  		$this->load->model('Model_ET_Tarea');
  		$this->load->model('Model_ET_Mes_Valorizacion');
  		$this->load->model('Model_Unidad_Medida');
  		$this->load->model('Model_DetSegOrden');
  		$this->load->model('UsuarioProyecto_model');
  		$this->load->model('Model_ModalidadE');
  		$this->load->model('FuenteFinanciamiento_Model');
  		$this->load->library('mydompdf');
  		$this->load->helper('FormatNumber_helper');
  }

  public function index()
  {
    $data['listaPreliquidacion'] = $this->Preliquidacion_Model->listPreliquidacion();

    $this->load->view('layout/Ejecucion/header');
  	$this->load->view('front/Ejecucion/PreLiquidacion/index', $data);
		$this->load->view('layout/Ejecucion/footer');
  }

  public function insertar()
	{
    if($_POST)
		{
			$data['proyecto']=$this->input->post('txtProyecto');
			$data['unidad_ejec']=$this->input->post('txtUnidadEjecutora');
			$data['fuente_fto']=$this->input->post('txtFuenteFinanciamiento');
			$data['mod_ejec']=$this->input->post('txtModalidadEjecucion');
			$data['correlativo']=$this->input->post('txtCorrelativo');
			$data['funcion']=$this->input->post('txtFuncion');
			$data['programa']=$this->input->post('txtPrograma');
			$data['sub_programa']=$this->input->post('txtSubPrograma');

      $data['act_proyecto']=$this->input->post('txtActProyecto');
			$data['componente']=$this->input->post('txtComponente');
			$data['meta']=$this->input->post('txtMeta');
      $codigo_unico = $this->Preliquidacion_Model->getCodigoUnico($this->input->post('txtIdPi'));
      $data['codigo_unico'] = $codigo_unico[0]->codigo_unico_pi;

      $data2['id_liq_proyecto']  = $this->Preliquidacion_Model->insertarPreLiq($data);

      foreach ($_POST['responsable'] as $k => $v) {
           $data2['id_persona'] = $_POST['responsable'][$k];
           $data2['tipo'] = $_POST['tipo'][$k];
           $data2['fecha_inicio'] = $_POST['dateStart'][$k];
           $data2['fecha_fin'] = $_POST['dateEnd'][$k];
           $this->Preliquidacion_Model->insertarPersonal($data2);
      }
			$this->db->trans_complete();

			echo json_encode("Se registro Correctamente el Expediente Técnico");
		}

		if($this->input->get('buscar')=="true")
		{

			$listarCargo=$this->Cargo_Modal->getcargo();
			$opcion  = "001";
  			$listaTipoResponsableElaboracion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

  			$opcion  = "002";
  			$listaTipoResponsableEjecucion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

			$listarPersona=$this->Model_Personal->listarPersona();
			$codigo_unico_pi=$this->input->get('CodigoUnico');
			$Listarproyectobuscado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoBuscar($codigo_unico_pi);
			$listaModalidadEjecucion=$this->Model_ModalidadE->GetModalidadE();
			$listaFuenteFinanciamiento=$this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento();

			$this->load->view('front/Ejecucion/PreLiquidacion/insertar',['Listarproyectobuscado'=>$Listarproyectobuscado,'listarPersona' =>$listarPersona,'listaTipoResponsableElaboracion' => $listaTipoResponsableElaboracion,'listaTipoResponsableEjecucion' => $listaTipoResponsableEjecucion,'listarCargo' =>$listarCargo,'listaModalidadEjecucion' => $listaModalidadEjecucion , 'listaFuenteFinanciamiento' => $listaFuenteFinanciamiento]);
		}
	}

  public function verdetalle()
	{
    $codigo_unico = isset($_GET['codigo_unico']) ? $_GET['codigo_unico'] : null;
    $id_liq_proyecto = isset($_GET['id_liq_proyecto']) ? $_GET['id_liq_proyecto'] : null;
    $listPreliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);
    $infoProject = $this->Preliquidacion_Model->getNameProject($codigo_unico);
    $preliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);

		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/PreLiquidacion/verdetalle',['preliquidacion' => $preliquidacion,'listPreliquidacion' => $listPreliquidacion, 'infoProject' => $infoProject]);
		$this->load->view('layout/Ejecucion/footer');
	}

  public function editar()
  {
    if ($_POST)
    {
      $id_liq_proyecto = $this->input->post('id_liq_proyecto');

			$data['unidad_ejec']=$this->input->post('txtUnidadEjecutora');
			$data['fuente_fto']=$this->input->post('txtFuenteFinanciamiento');
			$data['mod_ejec']=$this->input->post('txtModalidadEjecucion');

      $data['act_proyecto']=$this->input->post('txtActProyecto');
			$data['componente']=$this->input->post('txtComponente');
			$data['meta']=$this->input->post('txtMeta');

      $data['ubicacion']=$this->input->post('txtUbicacion');

      $this->Preliquidacion_Model->updatePreLiq($data, $id_liq_proyecto);

      foreach ($_POST['responsable'] as $k => $v) {
           $id_pre_persona =  $_POST['idResponsable'][$k];;
           $data2['id_persona'] = $_POST['responsable'][$k];
           $data2['tipo'] = $_POST['tipo'][$k];
           $data2['fecha_inicio'] = $_POST['dateStart'][$k];
           $data2['fecha_fin'] = $_POST['dateEnd'][$k];
           $this->Preliquidacion_Model->updatePersonal($data2, $id_pre_persona);
      }

			$this->db->trans_complete();
			echo json_encode("Se modifico Correctamente los datos");
    }

      $listarCargo=$this->Cargo_Modal->getcargo();
      $opcion  = "001";
        $listaTipoResponsableElaboracion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

        $opcion  = "002";
        $listaTipoResponsableEjecucion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

      $listarPersona=$this->Model_Personal->listarPersona();
      $listaModalidadEjecucion=$this->Model_ModalidadE->GetModalidadE();
      $listaFuenteFinanciamiento=$this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento();

      $id_liq_proyecto = isset($_GET['id_liq_proyecto']) ? $_GET['id_liq_proyecto'] : null;
      $codigo_unico_pi = isset($_GET['codigo_unico']) ? $_GET['codigo_unico'] : null;
      $Listarproyectobuscado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoBuscar($codigo_unico_pi);

      $listPreliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);

      $nameProject = $this->Preliquidacion_Model->getNameProject($codigo_unico_pi);

      $responsables = $this->Preliquidacion_Model->listarPersonal($id_liq_proyecto);

      $preliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);

      return $this->load->view('front/Ejecucion/PreLiquidacion/editar',['preliquidacion' => $preliquidacion,'responsables'=>$responsables,'Listarproyectobuscado'=>$Listarproyectobuscado, 'listPreliquidacion' => $listPreliquidacion,'nameProject' => $nameProject,'listarPersona' =>$listarPersona,'listaTipoResponsableElaboracion' => $listaTipoResponsableElaboracion,'listaTipoResponsableEjecucion' => $listaTipoResponsableEjecucion,'listarCargo' =>$listarCargo,'listaModalidadEjecucion' => $listaModalidadEjecucion , 'listaFuenteFinanciamiento' => $listaFuenteFinanciamiento]);
  }

  public function eliminar()
	{
    if ($this->input->is_ajax_request())
    {
      $id_liq_proyecto = $this->input->post('id_liq_proyecto');
      if($this->Preliquidacion_Model->eliminar($id_liq_proyecto)==true)
      {
        echo json_encode(['proceso' => 'correcto', 'mensaje' => 'El registro fue eliminado correctamente.']);exit;
      }
		}
	}

  public function ReporteEstadistico()
  {
    $listarCargo=$this->Cargo_Modal->getcargo();
    $opcion  = "001";
      $listaTipoResponsableElaboracion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

      $opcion  = "002";
      $listaTipoResponsableEjecucion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable($opcion);

    $listarPersona=$this->Model_Personal->listarPersona();
    $listaModalidadEjecucion=$this->Model_ModalidadE->GetModalidadE();
    $listaFuenteFinanciamiento=$this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento();

    $id_liq_proyecto = isset($_GET['id_liq_proyecto']) ? $_GET['id_liq_proyecto'] : null;
    $codigo_unico_pi = isset($_GET['codigo_unico']) ? $_GET['codigo_unico'] : null;
    $Listarproyectobuscado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoBuscar($codigo_unico_pi);

    $listPreliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);

    $nameProject = $this->Preliquidacion_Model->getNameProject($codigo_unico_pi);

    $responsables = $this->Preliquidacion_Model->listarPersonal($id_liq_proyecto);

    $preliquidacion = $this->Preliquidacion_Model->listPreliquidacionById($id_liq_proyecto);

    $html = $this->load->view('front/Ejecucion/PreLiquidacion/pdfexport',['preliquidacion' => $preliquidacion,'responsables'=>$responsables,'Listarproyectobuscado'=>$Listarproyectobuscado, 'listPreliquidacion' => $listPreliquidacion,'nameProject' => $nameProject,'listarPersona' =>$listarPersona,'listaTipoResponsableElaboracion' => $listaTipoResponsableElaboracion,'listaTipoResponsableEjecucion' => $listaTipoResponsableEjecucion,'listarCargo' =>$listarCargo,'listaModalidadEjecucion' => $listaModalidadEjecucion , 'listaFuenteFinanciamiento' => $listaFuenteFinanciamiento], true);

    $this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "portrait");
		$this->mydompdf->render();
		$this->mydompdf->stream("ReporteExpedienteTecnico.pdf", array("Attachment" => false));
  }

  public function _load_layout($template)
  {
      $this->load->view('layout/Administracion/header');
      $this->load->view($template);
      $this->load->view('layout/Administracion/footer');
      $this->load->view('Front/Administracion/js/jsLiquidacion.php');
  }

}
