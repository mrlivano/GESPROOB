<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PmiCriterioEspecifico extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_CriterioEspecifico');
		$this->load->model('Model_criterioGeneral');
	}
	public function index()
	{	
		
		if($_POST)
		{
			$txtIdCriterioG=$this->input->post('txtIdCriterioG');
			$txtNombreCriterioEspecifico=$this->input->post('txtNombreCriterioEspecifico');
			$txtpeso=$this->input->post('txtpeso');
			
			if(count($this->Model_CriterioEspecifico->CriterioEspecificoData($txtNombreCriterioEspecifico))>0)
            {
            	$listaCriteriosEspecificos=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($txtIdCriterioG);
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede registrar .','listaCriteriosEspecificos'=>$listaCriteriosEspecificos]);exit; 
            }

			$this->Model_CriterioEspecifico->insertar($txtIdCriterioG,$txtNombreCriterioEspecifico,$txtpeso);
			$listaCriteriosEspecificos=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($txtIdCriterioG);

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.', 'listaCriteriosEspecificos' => $listaCriteriosEspecificos]);exit;
		}

		$id_criterio_gen=$this->input->GET('id_criterio_gen');
		$listadoUnicoCGeneral=$this->Model_criterioGeneral->listadoUnicoCGeneral($id_criterio_gen);
		$nombre_criterio_gen=$this->input->GET('nombre_criterio_gen');

		$listaCriterioEspec=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($id_criterio_gen);

		$this->load->view('front/Pmi/CriteriosEspecificos/index',['id_criterio_gen' => $id_criterio_gen,'listadoUnicoCGeneral'=> $listadoUnicoCGeneral,'listaCriterioEspec' => $listaCriterioEspec]);		
	}

	public function editar()
	{
		if($_POST)
		{
            $id=$this->input->post('hdId');
            $txtcriterioespecifico=$this->input->post('txtcriterioespecifico');
            $txtpeso=$this->input->post('txtpeso');

	        $this->Model_CriterioEspecifico->editar($id,$txtcriterioespecifico,$txtpeso);

	        $id_criterio_gen=$this->input->post('id_criterio_gen');

	        $data=$this->Model_CriterioEspecifico->criterioEspecifico($id);

	        $datas=$this->Model_CriterioEspecifico->listarCriterioGeneralUnico($this->input->post('hdId'));
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos actualizados correctamente.','id_criterio_gen'=>$data->id_criterio_gen,'anio_criterio_gen' => $datas->anio_criterio_gen,'id_funcion' => $datas->id_funcion]);exit;  

        }

        $id=$this->input->get('id');
        $CriterioEspecifico=$this->Model_CriterioEspecifico->criterioEspecifico($id);
		
		return $this->load->view('front/Pmi/CriteriosEspecificos/editar',['CriterioEspecifico'=>$CriterioEspecifico]); 
	}

	function eliminar()
    {
        if($_POST)
		{
			 $id=$this->input->post('id_criterio');
			 $id_criterio_gen=$this->input->post('id_criterio_gen');
			 $listaCriteriosEspecificos=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($id_criterio_gen);

			if(count($this->Model_CriterioEspecifico->validarAsociacionProyecto($id))>0)
			{
				   
	            echo json_encode(['proceso' => 'Error', 'mensaje' => 'No es posible Eliminar, se encuentra asociado a un proyecto.','listaCriteriosEspecificos'=>$listaCriteriosEspecificos]);exit;  

			}else{
	            $this->Model_CriterioEspecifico->eliminar($id);
	            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Registro Eliminado.','listaCriteriosEspecificos'=>$listaCriteriosEspecificos]);exit;  

			}

	         
    	} 
    } 
    function listarCriterioEspecificos()
    {
    	 $id_criterio_gen=$this->input->post('id_criterio_gen');
    	 $listaCriteriosEspecificos=$this->Model_CriterioEspecifico->ListarCriterioEspecifico($id_criterio_gen);
    	 echo json_encode(['listaCriteriosEspecificos'=>$listaCriteriosEspecificos]);exit;  


    } 
	
}
