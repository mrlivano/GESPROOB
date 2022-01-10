<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EstadoCicloInversion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EstadoCicloInversion_Model');

    }
    public function index()
    {
        $this->_load_layout('front/Administracion/frmEstadoCicloInversion');
    }
//------------------------------------------------------------------------------------------------------------------

    public function get_EstadoCicloInversion() //mostra ESTADO INVERSION

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdEstadoCicloInversion          = $this->input->post("txt_IdEstadoCicloInversion");
            $txt_NombreEstadoCicloInversion      = $this->input->post("txt_NombreEstadoCicloInversion");
            $txt_DescripcionEstadoCicloInversion = $this->input->post("txt_DescripcionEstadoCicloInversion");

            $datos = $this->EstadoCicloInversion_Model->get_EstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                = "C";
            $txt_IdEstadoCicloInversion          = "0";
            $txt_NombreEstadoCicloInversion      = $this->input->post("txt_NombreEstadoCicloInversion");
            $txt_DescripcionEstadoCicloInversion = $this->input->post("txt_DescripcionEstadoCicloInversion");
            if ($this->EstadoCicloInversion_Model->AddEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }

    }
    //ELIMINAR  ciclo inversion
    public function EliminarEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdEstadoCicloInversion          = $this->input->post("id_estado_ciclo");
            $txt_NombreEstadoCicloInversion      = "NULL";
            $txt_DescripcionEstadoCicloInversion = "NULL";

            if ($this->EstadoCicloInversion_Model->EliminarEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA
    public function UpdateEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                 = "U";
            $txt_IdEstadoCicloInversionM          = $this->input->post("txt_IdEstadoCicloInversionM");
            $txt_NombreEstadoCicloInversionM      = $this->input->post("txt_NombreEstadoCicloInversionM");
            $txt_DescripcionEstadoCicloInversionM = $this->input->post("txt_DescripcionEstadoCicloInversionM");

            if ($this->EstadoCicloInversion_Model->UpdateEstadoCicloInversion($flat, $txt_IdEstadoCicloInversionM, $txt_NombreEstadoCicloInversionM, $txt_DescripcionEstadoCicloInversionM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

    public function listarEstadoCicloNombre()
    {
        if ($this->input->is_ajax_request())
         {

            $data=$this->EstadoCicloInversion_Model->listarEstadoCicloNombre();
            echo json_encode($data);

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
