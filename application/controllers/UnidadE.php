<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnidadE extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_UnidadE');
        $this->load->helper('FormatNumber_helper');
    }
    public function index()
    {
        $this->_load_layout('Front/Administracion/frmUnidadEjecutora');
    }

    public function indexunidadEjecutora()
    {
        $listaPipUnidadEjecutora=$this->Model_UnidadE->UnidadEjecutoraPipListar();
        $listaMontoTotalUnidadEjecutora=$this->Model_UnidadE->UnidadEjecutoraPipListarResumen();
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/UnidadEjecutora/index',['listaPipUnidadEjecutora'=>$listaPipUnidadEjecutora,'listaMontoTotalUnidadEjecutora'=>$listaMontoTotalUnidadEjecutora]);
        $this->load->view('layout/Reportes/footer');
    }
//----------------------MANTENIMIENTOS DE UNIDAD EJECUTORA-------------------------------------------
    //AGREGAR UNA UNIDAD DE EJECUTORA
      public function AddUnidadE()
    {
        if ($this->input->is_ajax_request()) {
            $txt_NombreUnidadE = $this->input->post("txt_NombreUnidadE");
            $txtCodigoUE = $this->input->post("txtCodigoUE");
            if ($this->Model_UnidadE->AddUnidadE($txt_NombreUnidadE, $txtCodigoUE) == true) {
                echo "No añadio la unidad ejecutora";
            } else {
                echo "se añadio  la unidad ejecutora";
            }

        } else {
            show_404();
        }

    }
//FIN DE AGREGAR UNA UNIDAD EJECUTORA

//LISTAR UNIDAD DE  EJECUCION*/
    public function GetUnidadE()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_UnidadE->GetUnidadE();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
//FIN LISTAR UNIDAD DE  EJECUCION
    //ACTUALIZAR O MODIFICAR DATOS DE UNIDAD EJECUTORA
    public function UpdateUnidadE()
    {
        if ($this->input->is_ajax_request()) {
            $txt_IdUnidadEModif = $this->input->post("txt_IdUnidadEModif");
            $txt_NombreUnidadEU = $this->input->post("txt_NombreUnidadEU");
            $txtCodigoUE_M = $this->input->post("txtCodigoUE_M");
            if ($this->Model_UnidadE->UpdateUnidadE($txt_IdUnidadEModif, $txt_NombreUnidadEU, $txtCodigoUE_M) == false) {
                echo "Se actualizo correctamente la unidad ejecutora";
            } else {
                echo "No se actualizo correctamente la unidad ejecutora";
            }

        } else {
            show_404();
        }
    }



    public function Eliminar()
    {
        $id_tipog=$this->input->post("id_codigo");

        $data = $this->Model_UnidadE->eliminar($id_tipog);
        /*
        if($data>0)
        {
            $this->session->set_flashdata('correcto', 'Se eliminó correctamente el registro');
            redirect('Tipo_Gasto_FE/index');
        }
        $this->session->set_flashdata('error', 'Ha ocurrido un error inesperado');
        redirect('Tipo_Gasto_FE/index');
        */
        echo $data;


    }


//FIN ACTUALIZAR O MODIFICAR DATOS DE UNIDAD EJECUTORA
    //----------------------FIN MANTENIMIENTOS DE UNIDAD EJECUTORA-------------------------------------------

    public function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

}
