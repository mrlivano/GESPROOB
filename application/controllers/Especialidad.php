<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Especialidad');
	}

	public function index()
	{
		$this->_load_layout('Front/Administracion/frmSectorEntidad');
	}

  public function ListarEspecialidad() {
    if($this->input->is_ajax_request())
    {
        $datos=$this->Model_Especialidad->ListarEspecialidad();
        echo json_encode($datos);
    }
    else
    {
        show_404();
    }
  }

	public function addEspecialidad() {

		if ($this->input->is_ajax_request()) {
				$txt_nombre_esp = $this->input->post("txt_nombre_esp");
				$datos=$this->Model_Especialidad->addEspecialidad($txt_nombre_esp);
		} else {
				show_404();
		}
  }

	public function updateEspecialidad() {

		if ($this->input->is_ajax_request()) {
				$txt_id_esp = $this->input->post("txt_id_esp");
				$txt_nombre_esp_M = $this->input->post("txt_nombre_esp_M");
				$datos=$this->Model_Especialidad->updateEspecialidad($txt_id_esp, $txt_nombre_esp_M);
		} else {
				show_404();
		}
  }

	public function deleteEspecialidad() {
		if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_esp = $this->input->post("id_esp");

				if($this->Model_Especialidad->deleteEspecialidad($id_esp)==true){
						$flag=1;
						$msg="registro Eliminado Satisfactoriamente";
				}
				else{
						$flag=0;
						$msg="No se pudo eliminar";
				}
								$datos['flag']=$flag;
								$datos['msg']=$msg;
								echo json_encode($datos);
		}  else {
				show_404();
		}
	}

}
