<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FEnivelEstudio extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_FEnivelEstudio');
	}

    public function get_FEnivelEstudio(){
    	if ($this->input->is_ajax_request())
        {
        $datos=$this->Model_FEnivelEstudio->get_FEnivelEstudio();
        echo json_encode($datos);
        }
        else
        {
          show_404();
        }
    }
     public function  add_NivelEstudio(){
    	if ($this->input->is_ajax_request())
	    {
	      $denom_nivel_estudio =$this->input->post("denom_nivel_estudio");
	     if($this->Model_FEnivelEstudio->add_NivelEstudio($denom_nivel_estudio)== false)
		       echo "Se Inserto Nuevo Nivel de Estudio ";
		      else
		      echo "Se Inserto Nuevo Nivel de Estudio ";
		 }
	     else
	     {
	      show_404();
	      }

    }
    public function Update_NivelEstudio(){
    	if ($this->input->is_ajax_request())
	    {
	      $Id_denom_nivel_estudioA=$this->input->post("Id_denom_nivel_estudioA");
	      $txt_denom_nivel_estudioA =$this->input->post("txt_denom_nivel_estudioA");
	     if($this->Model_FEnivelEstudio->updateNivelEstudio($Id_denom_nivel_estudioA,$txt_denom_nivel_estudioA)== false)
		       echo "Se Modificó el Nive de Estudio ";
		      else
		      echo "Se Modificó el Nivel  de Estudio ";
		 }
	     else
	     {
	      show_404();
	      }
    }

		public function EliminarNivelEstudios() {
			if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_nivel_estudio = $this->input->post("id_nivel_estudio");

			if($this->Model_FEnivelEstudio->EliminarNivelEstudios($id_nivel_estudio)==true){
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

	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
