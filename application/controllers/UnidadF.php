<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnidadF extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_UnidadF');
        $this->load->helper('FormatNumber_helper');
    }
    public function index()
    {
        $this->_load_layout('Front/Administracion/frmUnidadFjecutora');
    }

    public function indexunidadFormuladora()
    {
        $listaPipUnidadFormuladora=$this->Model_UnidadF->UnidadFormuladoraPipListar();
        $listaMontoTotalUnidadFormuladora=$this->Model_UnidadF->UnidadFormuladoraMontoTotal();

        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/UnidadFormuladora/index',['listaPipUnidadFormuladora'=>$listaPipUnidadFormuladora,'listaMontoTotalUnidadFormuladora'=>$listaMontoTotalUnidadFormuladora]);
        $this->load->view('layout/Reportes/footer');
    }
//----------------------MANTENIMIENTOS DE UNIDAD EJECUTORA-------------------------------------------
    //AGREGAR UNA UNIDAD DE EJECUTORA
    public function AddUnidadF()
    {
        if ($this->input->is_ajax_request()) {
            $flat              = 'C';
            $ID                = '0';
            $txt_NombreUnidadF = $this->input->post("txt_NombreUnidadF");
            if ($this->Model_UnidadF->AddUnidadF($flat, $ID, $txt_NombreUnidadF) == true) {
                echo "NO Se añadio la unidad formuladora";
            } else {
                echo " se añadio  la unidad formuladora";
            }

        } else {
            show_404();
        }

    }
//FIN DE AGREGAR UNA UNIDAD EJECUTORA

//LISTAR UNIDAD DE  EJECUCION*/
    public function GetUnidadF()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_UnidadF->GetUnidadF();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
//FIN LISTAR UNIDAD DE  EJECUCION
    //ACTUALIZAR O MODIFICAR DATOS DE UNIDAD EJECUTORA
    public function UpdateUnidadF()
    {
        if ($this->input->is_ajax_request()) {
            $flat               = 'U';
            $txt_IdUnidadFModif = $this->input->post("txt_IdUnidadFModif");
            $txt_NombreUnidadFU = $this->input->post("txt_NombreUnidadFU");
            if ($this->Model_UnidadF->UpdateUnidadF($flat, $txt_IdUnidadFModif, $txt_NombreUnidadFU) == false) {
                echo "Se actualizo correctamente la unidad formuladora";
            } else {
                echo "No se actualizo correctamente la unidad formuladora";
            }

        } else {
            show_404();
        }
    }
//FIN ACTUALIZAR O MODIFICAR DATOS DE UNIDAD EJECUTORA
    //----------------------FIN MANTENIMIENTOS DE UNIDAD EJECUTORA-------------------------------------------
    public function Eliminar()
    {
        $id_uf = $this->input->post("id_codigo");

        $data = $this->Model_UnidadF->eliminar($id_uf);

        echo $data;

    }
    public function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

}
