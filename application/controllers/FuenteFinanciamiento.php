<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FuenteFinanciamiento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FuenteFinanciamiento_Model');

    }
    public function index()
    {
        $this->_load_layout('front/Administracion/frmInformacionPresupuestal');
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_FuenteFinanciamiento() //mostra fuente financiamietno
    {
        if ($this->input->is_ajax_request()) 
        {
            $datos = $this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento();
            echo json_encode($datos);
        } else 
        {
            show_404();
        }
    }
    //REGISTRAR NUEVA
    public function AddFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flag = 0;
            $msg = '';
            $txt_NombreFuenteFinanciamiento=$this->input->post("txt_ffto");
            $txt_AcronimoFuenteFinanciamiento=$this->input->post("txt_AcronimoFuenteFinanciamiento");
            $f_data['nombre_fuente_finan']=$txt_NombreFuenteFinanciamiento;
            $f_data['acronimo_fuente_finan']=$txt_AcronimoFuenteFinanciamiento;
            $f_data=$this->security->xss_clean($f_data);
            if($this->FuenteFinanciamiento_Model->BuscarFuenteF($txt_NombreFuenteFinanciamiento)==true){
                $flag=1;
                $msg='Registro ya Existente';
            }
            else{
                if($this->FuenteFinanciamiento_Model->AddFuenteFinanciamiento($f_data)!=0){
                    $flag=0;
                    $msg='Registro exitoso';      
                }
                else{
                    $flag=1;
                    $msg='Error dbx0001';
                }
            }
                    $datos['flag']=$flag;
                    $datos['msg']=$msg;
                    echo json_encode($datos);
        } 
        else {
            show_404();
        }

    }
    //ELIMINAR  fuente Financiamiento
    public function EliminarFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_fuente_finan = $this->input->post("id_fuente_finan");

        if($this->FuenteFinanciamiento_Model->EliminarFuenteFinanciamiento($id_fuente_finan)==true){
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

    //ACTUALIZAR NUEVA
    public function UpdateFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flag = 0;
            $msg = '';
            $id_fuente_finan=$this->input->post("txt_IdFuenteFinanciamientoM");
            $txt_NombreFuenteFinanciamiento=$this->input->post("txt_NombreFuenteFinanciamientoM");
            $txt_AcronimoFuenteFinanciamiento=$this->input->post("txt_AcronimoFuenteFinanciamientoM");
            $f_data['nombre_fuente_finan']=$txt_NombreFuenteFinanciamiento;
            $f_data['acronimo_fuente_finan']=$txt_AcronimoFuenteFinanciamiento;
            $f_data=$this->security->xss_clean($f_data);
            if($this->FuenteFinanciamiento_Model->BuscarFuenteFU($id_fuente_finan,$txt_NombreFuenteFinanciamiento)==true){
                    $flag=1;
                    $msg="Registro ya existente";
            }
            else{
                if($this->FuenteFinanciamiento_Model->UpdateFuenteFinanciamiento($id_fuente_finan,$f_data)==true){
                        $flag=0;
                        $msg='Registro Actualizado';             

                }
                else{
                        $flag=1;
                        $msg='Error dbx0003';

                }

            }
            $datos['flag']=$flag;
            $datos['msg']=$msg;
            echo json_encode($datos);
        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------
    public function _load_layout($template)
    {
        $this->load->view('layout/Administracion/header');
        $this->load->view($template);
        $this->load->view('layout/Administracion/footer');
    }

}
