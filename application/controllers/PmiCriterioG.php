<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PmiCriterioG extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_CriterioGeneral');
		$this->load->model('Model_Funcion');
		$this->load->model('Model_CriterioEspecifico');
		$this->load->library('mydompdf');

	}
	public function insertar()
	{
		if($_POST)
		{

			$txtNombreCriterio=$this->input->post('txtNombreCriterio');
			$txtAnioCriterioG=$this->input->post('txtAnioCriterioG');
			$txtPesoCriterioG=$this->input->post('txtPesoCriterioG');
			$txtIdFuncion=$this->input->post('txtIdFuncion');


			if(count($this->Model_CriterioGeneral->CriterioGeneralData($txtNombreCriterio,$txtAnioCriterioG))>0)
            {
            	$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($txtIdFuncion,$txtAnioCriterioG);

                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este Criterio ya existe. Ingrese otro criterio','listaCritetioGeneral' => $listaCritetioGeneral]);exit;
            }

			$this->Model_CriterioGeneral->insert($txtNombreCriterio,$txtPesoCriterioG,$txtAnioCriterioG,$txtIdFuncion);

			$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($txtIdFuncion,$txtAnioCriterioG);


			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.', 'listaCritetioGeneral' => $listaCritetioGeneral]);exit;
		}

		$anio =$this->input->GET('anio');
		$id_funcion=$this->input->GET('id_funcion');
		$nombre_funcion=$this->input->GET('nombre_funcion');

		$function=$this->Model_Funcion->GetFuncion();

		$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($id_funcion,$anio);

		$this->load->view('front/Pmi/CriteriosGenerales/insertar',['function' => $function,'id_funcion' => $id_funcion,'nombre_funcion'=> $nombre_funcion,'listaCritetioGeneral' => $listaCritetioGeneral,'anio' => $anio]);
	}

	public function editar()
	{
		 if($_POST)
		 {

		 	$hdIdcriterioGeneral=$this->input->post('hdIdcriterioGeneral');
		 	$txtNombreCriterio=$this->input->post('txtNombreCriterio');
		 	$txtPesoCriterioG=$this->input->post('txtPesoCriterioG');
			$txtAnioCriterioG=$this->input->post('txtAnioCriterioG');

			if(count($this->Model_CriterioGeneral->CriterioGeneralModifId($hdIdcriterioGeneral, $txtNombreCriterio))>0)
            {
            	$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($txtIdFuncion,$txtAnioCriterioG);

                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este criterio general ya fue registrado anteriormente.','listaCritetioGeneral'=>$listaCritetioGeneral]);exit;
            }

			$listaCritetioGeneral=$this->Model_CriterioGeneral->Editar($hdIdcriterioGeneral,$txtNombreCriterio,$txtPesoCriterioG,$txtAnioCriterioG);

		 	$id_funcion=$this->input->post('cbx_funcion');
		 	echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos editados  correctamente.', 'id_funcion' => $id_funcion,'anio' => $txtAnioCriterioG]);exit;

		 }

		 $id_criterio_gen=$this->input->get('idCriterioGeneral');
		 $listadoUnicoCGeneral=$this->Model_CriterioGeneral->listadoUnicoCGeneral($id_criterio_gen);

		 $function=$this->Model_Funcion->GetFuncion();

		 $this->load->view('front/Pmi/CriteriosGenerales/modificar',['listadoUnicoCGeneral' => $listadoUnicoCGeneral,'function' => $function,'id_criterio_gen' => $id_criterio_gen]);
	}

	public function eliminar()
	{
		if($_POST)
		{
			$id_criterio_gen=$this->input->post('idCriterioGeneral');
			$id_funcion =$this->input->post('id_funcion');
			$anio_criterio_gen=$this->input->post('anio_criterio_gen');
			$listarCriterioEsp=$this->Model_CriterioGeneral->virificarCriterioEspe($id_criterio_gen);
			if(count($listarCriterioEsp)=='')
			{
				$this->Model_CriterioGeneral->eliminar($id_criterio_gen);
				$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($id_funcion,$anio_criterio_gen);
				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se elimino el criterio General', 'listaCritetioGeneral' => $listaCritetioGeneral]);exit;
			}else
			{

				$listaCritetioGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($id_funcion,$anio_criterio_gen);
				echo json_encode(['proceso' => 'Error', 'mensaje' =>'No es posible eliminar el criterio General,tiene criterios especificos', 'listaCritetioGeneral' => $listaCritetioGeneral]);exit;
			}

		}
	}

	public function ReporteCriteriosG()
	{
		 $id_funcion = isset($_GET['id_funcion']) ? $_GET['id_funcion'] : '';
		 $anio_criterio_gen = isset($_GET['anio']) ? $_GET['anio'] : '';

		 $listarfuncion=$this->Model_CriterioEspecifico->listarFuncion($anio_criterio_gen,$id_funcion);

		if(count($listarfuncion)>0)
		{
			foreach ($listarfuncion as $key => $value)
			    {

						$value->childCriteriGeneral=$this->Model_CriterioGeneral->ListarCriterioGenerales($value->id_funcion,$anio_criterio_gen);
						foreach ($value->childCriteriGeneral as $index => $item)
						{
								$item->childEspecificos=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($item->id_criterio_gen);
						}

			    }
			$html= $this->load->view('front/Pmi/CriteriosGenerales/reporteCriteriosGeneralesEspecificos', ["listarfuncionCriterioGeneral" => $listarfuncion,"anio"=>$anio_criterio_gen], true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper('letter', 'landscape');
			$this->mydompdf->render();
			$this->mydompdf->set_base_path('./assets/css/dompdf.css'); //agregar de nuevo el css

			$this->mydompdf->stream("reporteAnalisisPreciosFF11.pdf", array("Attachment" => false));
		}
		else
		{
			$html= $this->load->view('front/Pmi/CriteriosGenerales/reporteVacioCriterioEspecifico',['Anio' => $anio_criterio_gen], true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper('letter', 'landscape');
			$this->mydompdf->render();
			$this->mydompdf->set_base_path('./assets/css/dompdf.css'); //agregar de nuevo el css
			$this->mydompdf->stream("reporteAnalisisPreciosFF11.pdf", array("Attachment" => false));
		}
	}

	public function index($año=0){
		$listaCriterioGen=$this->Model_CriterioGeneral->CriteriosGenerales();

		$this->load->view('layout/PMI/header');
		$this->load->view('front/Pmi/CriteriosGenerales/index',['listaCriterioGen'=>$listaCriterioGen]);
		$this->load->view('layout/PMI/footer');
	}

	public function criterioFuncion($anio='')
	{
		$anio = date("Y");
		$listaCriterioFuncion=$this->Model_CriterioGeneral->CriteriosGeneralesPorFuncion($anio);
		$this->load->view('layout/PMI/header');
		$this->load->view('front/Pmi/CriteriosGenerales/criteriosFuncion',['listaCriterioFuncion'=>$listaCriterioFuncion,'anio' => $anio]);
		$this->load->view('layout/PMI/footer');
	}

	public function listarCriterioGPorAnios()
	{
		$anio=$this->input->Post('anio');
		$id_funcion=$this->input->Post('id_funcion');
		$dataCriterioGeneralAni=$this->Model_CriterioGeneral->listarCriterioGPorAniosFuncion($anio,$id_funcion);
		echo json_encode(['dataCriterioGeneralAni'=>$dataCriterioGeneralAni]);exit;
	}
}
