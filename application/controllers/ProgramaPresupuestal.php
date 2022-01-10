<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProgramaPresupuestal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProgramaPresupuestal');
    }
    public function index()
    {
        $this->_load_layout('Front/ADMINISTRACION/frmInformacionPresupuestal');
    }
//---------------------MANTENIMIENTOS DE PROGRAMA PRESUPUESTAL-------------------------------------
    //AGREGAR UN PROGRAMA PRESUPUESTAL
    public function AddProgramaP()
    {
        if ($this->input->is_ajax_request())
        {
            $flag=0;
            $msg='';
            $txt_CodigoProgramaP=$this->input->post("txt_CodigoProgramaP");
            $txt_NombreProgramaP = $this->input->post("txt_NombreProgramaP");
            $p_data['cod_programa_pres']=$txt_CodigoProgramaP;
            $p_data['nombre_programa_pres']=$txt_NombreProgramaP;
            $p_data=$this->security->xss_clean($p_data);
            if($this->Model_ProgramaPresupuestal->BuscarProgramaP($txt_CodigoProgramaP)){
                $flag=1;
                $msg='Registro ya Existente';
            }
            else{
                if($this->Model_ProgramaPresupuestal->AddProgramaP($p_data)!=0){
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
        } else {
            show_404();
        }
    }
//FIN DE PROGRAMA PRESUPUESTAL
    /* LISTAR PROGRAMA PRESUPUESTAL*/
    public function GetProgramaP()
    {
        if ($this->input->is_ajax_request()) {
            $flat  = 'R';
            $datos = $this->Model_ProgramaPresupuestal->GetProgramaP($flat);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
//FIN LISTAR PROGRAMA PRESUPUESTAL
    //ACTUALIZAR O MODIFICAR DATOS DE PROGRAMA PRESUPUESTAL
    public function UpdateProgramaP()
    {
        if ($this->input->is_ajax_request()) {
            $flag = 0;
            $msg = '';
            $id_programa_pres=$this->input->post("txt_IdProgramaPU");
            $nombre_programa_pres=$this->input->post("txt_NombreProgramaPU");
            $cod_programa_pres=$this->input->post("txt_CodigoProgramaPU");
            $p_data['cod_programa_pres']=$cod_programa_pres;
            $p_data['nombre_programa_pres']=$nombre_programa_pres;
            $p_data=$this->security->xss_clean($p_data);
            if($this->Model_ProgramaPresupuestal->BuscarProgramaPU($id_programa_pres,$nombre_programa_pres)==true){
                    $flag=1;
                    $msg="Registro ya existente";
            }
            else{
                if($this->Model_ProgramaPresupuestal->UpdateProgramaP($id_programa_pres,$p_data)==true){
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
    public function EliminarProgramaP()
    {
        if ($this->input->is_ajax_request())
        {
            $flag=0;
            $msg="";
            $id_programa_pres = $this->input->post("id_programa_pres");
           if($this->Model_ProgramaPresupuestal->EliminarProgramaP($id_programa_pres)==true){
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
        } else {
            show_404();
        }
    }
//FIN ACTUALIZAR O MODIFICAR DATOS DE PROGRAMA PRESUPUESTAL
    //---FIN MANTENIMIENTOS DE PROGRAMA PRESUPUESTAL-------

    public function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

}
