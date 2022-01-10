<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FEsituacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_FEsituacion');

    }

    /*  */
    public function get_FEsituacion()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_FEsituacion->get_FEsituacion();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    public function EliminarSituacion() {
			if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_situacion_fe = $this->input->post("id_situacion_fe");

			if($this->Model_FEsituacion->EliminarSituacion($id_situacion_fe)==true){
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

    public function add_FEsituacion()
    {
        if ($this->input->is_ajax_request()) {
            $txt_SituacionFE = $this->input->post("txt_SituacionFE");
            if ($this->Model_FEsituacion->add_FEsituacion($txt_SituacionFE) == false) {
                echo "Se Inserto Nueva Situación ";
            } else {
                echo "Se Inserto Nueva Situación ";
            }

        } else {
            show_404();
        }

    }
    public function update_FEsituacion()
    {
        if ($this->input->is_ajax_request()) {
            $id_situacion_fe    = $this->input->post("id_situacion_fe");
            $denom_situacion_fe = $this->input->post("denom_situacion_fe");
            if ($this->Model_FEsituacion->update_FEsituacion($id_situacion_fe, $denom_situacion_fe) == false) {
                echo "Se Modificó la  Situación ";
            } else {
                echo "Se Modificó la  Situación ";
            }

        } else {
            show_404();
        }
    }
    public function AddSituacion()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();

            $c_data['id_situacion_fe']=$this->input->post("Cbx_Situacion");
            $c_data['id_etapa_estudio']=$this->input->post("txt_IdEtapa_Estudio");
            $c_data['observacion']=$this->input->post("txadescripcion");
            $c_data['fecha']=date('Y-m-d H:i:s');

            $q1=$this->Model_FEsituacion->AddSituacion($c_data);

            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }
    }
    public function ver_FEsistuacion()
    {
        $this->_load_layout('Front/Formulacion_Evaluacion/frmSituacion');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
/*REGISTAR SITUACION ACTUAL DEL ESTUDIO DE INVERSION*/
