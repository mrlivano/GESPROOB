<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FEestado extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_FEestado');
	}

    public function get_FEestado(){
    	if ($this->input->is_ajax_request())
        {
        $datos=$this->Model_FEestado->get_FEestado();
        echo json_encode($datos);
        }
        else
        {
          show_404();
        }
    }
     public function  add_FEestado(){
    	if ($this->input->is_ajax_request())
	    {
	      $txt_denom_estado_fe =$this->input->post("txt_denom_estado_fe");
	     if($this->Model_FEestado->add_FEestado($txt_denom_estado_fe)== false)
		       echo "Se Inserto Nuevo estado ";
		      else
		      echo "Se Inserto Nuevo estado ";
		 }
	     else
	     {
	      show_404();
	      }

    }
    public function updateFEestado(){
    	if ($this->input->is_ajax_request())
	    {
	      $id_estado =$this->input->post("id_estado");
	      $denom_estado_fe =$this->input->post("denom_estado_fe");
	     if($this->Model_FEestado->updateFEestado($id_estado,$denom_estado_fe)== false)
		       echo "Se Modificó el estado ";
		      else
		      echo "Se Modificó el estado ";
		 }
	     else
	     {
	      show_404();
	      }
    }
    public function EliminarFEestado(){
    	    if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_estado_etapa = $this->input->post("id_estado_etapa");

        if($this->Model_FEestado->EliminarEstado($id_estado_etapa)==true){
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

		public function EliminarEstado() {
			if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_estado_etapa = $this->input->post("id_estado");

			if($this->Model_FEestado->EliminarEstadoFE($id_estado_etapa)==true){
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

    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function ver_EstadoFE()
	{
		$this->_load_layout('Front/Formulacion_Evaluacion/frmEstadoFE');
	}
	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
