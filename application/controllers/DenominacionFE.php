<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DenominacionFE extends CI_Controller {

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_DenominacionFE');
	}
	public function index()
	{
		$this->_load_layout('Front/Formulacion_Evaluacion/frmDenominacionFE');
	}
    //CONTROLADOR DE LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN UNA TABLA
    public function GetDenominacionFE(){
    	if ($this->input->is_ajax_request())
        {
        $datos=$this->Model_DenominacionFE->GetDenominacionFE();
        echo json_encode($datos);
        }
        else
        {
          show_404();
        }
    }
     //FIN CONTROLADOR DE LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN UNA TABLA
    //CONTROLADOR PARA AGREGAR UNA NUEVA DENOMINCACION EN FROUMLACION Y EVALUACION
    public function  AddDenominacionFE()
    {
        if ($this->input->is_ajax_request())
            {
             $txt_DenominacionFE =$this->input->post("txt_DenominacionFE");
            $DATOS=$this->Model_DenominacionFE->AddDenominacionFE($txt_DenominacionFE);
             echo json_encode($DATOS);
            }
        else
            {
              show_404();
            }
    }
    //FIN CONTROLADOR PARA AGREGAR UNA NUEVA DENOMINCACION EN FROUMLACION Y EVALUACION
    //CONTROLADOR PARA ACTUALIZAR UNA NUEVA DENOMINCACION EN FORMULACION Y EVALUACION
    public function UpdateDenominacionFE(){
      if ($this->input->is_ajax_request())
      {
        $txt_IdDenominacionModiFE=$this->input->post("txt_IdDenominacionModiFE");
        $txt_DenominacionModiFE =$this->input->post("txt_DenominacionModiFE");
       if($this->Model_DenominacionFE->UpdateDenominacionFE($txt_IdDenominacionModiFE,$txt_DenominacionModiFE)== false)
           echo "SE MODIFICO LA DENOMINACION EN FORMULACIÓN Y EVALUACIÓN";
          else
          echo "SE MODIFICO LA DENOMINACIÓN EN FORMULACIÓN Y EVALUACIÓN";
     }
       else
       {
        show_404();
        }
    }


    function EliminarD(){

        if ($this->input->is_ajax_request())
        {
            $id_dno = $this->input->post("id_denom_fe");
            $this->Model_DenominacionFE->EliminarDeno($id_dno);
            echo "1";

        } else {
            show_404();
        }

    }

    //FIN CONTROLADOR PARA ACTUALIZAR UNA NUEVA DENOMINCACION EN FORMULACION Y EVALUACION
	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
