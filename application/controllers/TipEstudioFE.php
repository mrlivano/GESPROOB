<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipEstudioFE extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_TipEstudioFE');
	}

    public function GetTipEstudioFE()
    {
    	if ($this->input->is_ajax_request())
        {
            $datos=$this->Model_TipEstudioFE->GetTipEstudioFE();
            echo json_encode($datos);
        }
        else
        {
          show_404();
        }
    }
    public function  AddTipoEstudioFE()
    {
        if ($this->input->is_ajax_request())
        {
            $txt_tipoEstudioFE =$this->input->post("txt_tipoEstudioFE");
            if($this->Model_TipEstudioFE->AddTipoEstudioFE($txt_tipoEstudioFE)== false)
                echo "SE INSERTO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
            else
                echo "SE INSERTO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
        }
        else
        {
            show_404();
        }
    }
    public function  UpdateTipoEstudioFE()
	{
		if ($this->input->is_ajax_request())
		{
			$id_tipoEstudioFEModi =$this->input->post("id_tipoEstudioFEModi");
			$txt_tipoEstudioFEModi =$this->input->post("txt_tipoEstudioFEModi");
			if($this->Model_TipEstudioFE->UpdateTipoEstudioFE($id_tipoEstudioFEModi,$txt_tipoEstudioFEModi)== false)
				echo "SE ACTUALIZO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
			else
                echo "SE ACTUALIZO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
		}
		else
		{
            show_404();
		}
	}
    public function  deleteTipoEstudioFE()
    {
        if ($this->input->is_ajax_request())
        {
            $id_tipoEstudioFE =$this->input->post("id_tipoEstudioFE");
            if($this->Model_TipEstudioFE->DeleteTipoEstudioFE($id_tipoEstudioFE)== false)
                echo "SE ELIMINO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
            else
                echo "SE ELIMINO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION";
        }
        else
        {
            show_404();
        }
    }

	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }
}
