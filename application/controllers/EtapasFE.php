<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EtapasFE extends CI_Controller {

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_EtapasFE');
	}

    //CONTROLADOR DE LISTAR ETAPAS DE FORMULACION Y EVALUACION EN UNA TABLA
    public function GetEtapasFE(){
    	if ($this->input->is_ajax_request())
        {
        $datos=$this->Model_EtapasFE->GetEtapasFE();
        echo json_encode($datos);
        }
        else
        {
          show_404();
        }
    }

		public function EliminarEtapa() {
			if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_etapa_fe = $this->input->post("id_etapa_fe");

			if($this->Model_EtapasFE->EliminarEtapa($id_etapa_fe)==true){
							$flag=0;
							$msg="registro Eliminado Satisfactoriamente";
					}
					else{
							$flag=1;
							$msg="No se pudo eliminar";
					}
									$datos['flag']=$flag;
									$datos['msg']=$msg;
									echo json_encode($datos);
			}  else {
					show_404();
			}
		}
       //CONTROLADOR PARA AGREGAR ETAPAS DE FORMULACION Y EVALUACION EN UNA TABLA
    public function  AddEtapasFE()
    {
        if ($this->input->is_ajax_request())
            {
             $txt_EtapasFE =$this->input->post("txt_EtapasFE");
             if($this->Model_EtapasFE->AddEtapasFE($txt_EtapasFE)== false)
                   echo "SE INSERTO UNA NUEVA ETAPA EN FORMULACION Y EVALUACION";
                  else
                  echo "SE INSERTO UNA NUEVA ETAPA N EN FORMULACION Y EVALUACION";
            }
        else
            {
              show_404();
            }
    }
		public function UpdateEtapasFE(){
					if ($this->input->is_ajax_request())
							{
							 $id_etapaDenominacion  =$this->input->post("id_etapa_fe");
							 $txt_etapaDenominacion =$this->input->post("denom_etapas_fe");
							 if($this->Model_EtapasFE->UpdateEtapasFE($id_etapaDenominacion,$txt_etapaDenominacion)== false)
										echo "SE  ACTUALIZO UNA NUEVA ETAPA EN FORMULACION Y EVALUACION";
										else
										echo "SE ACTUALIZO  UNA NUEVA ETAPA N EN FORMULACION Y EVALUACION";
							}
					else
							{
								show_404();
							}
		}
    //FIN CONTROLADOR PARA AGREGAR ETAPAS DE FORMULACION Y EVALUACION EN UNA TABLA
   public function index()
  {
    $this->_load_layout('Front/Formulacion_Evaluacion/frmEtapasFE');
  }
	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
