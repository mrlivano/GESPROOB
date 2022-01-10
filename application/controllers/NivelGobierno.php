 <?php
defined('BASEPATH') or exit('No direct script access allowed');

class NivelGobierno extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NivelGobierno_Model');
    }
    public function index()
    {
        $this->_load_layout('front/Administracion/frmUnidadEjecutora');
    }
    public function get_NivelGobierno() //mostra nivel de gobierno

    {

        if ($this->input->is_ajax_request()) {
            $flat                    = "R";
            $txt_IdNivelGobierno     = "0";
            $txt_NombreNivelGobierno = "NULL";
            $datos                   = $this->NivelGobierno_Model->get_NivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat                    = "C";
            $txt_IdNivelGobierno     = "0";
            $txt_NombreNivelGobierno = $this->input->post("txt_NombreNivelGobierno");
            if ($this->NivelGobierno_Model->AddNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno) == false) {
                echo "Se Registró ...";
            } else {
                echo "No se Registró";
            }
        } else {
            show_404();
        }

    }
    //ELIMINAR  nivel Gobierno
    public function EliminarNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat                    = "D";
            $txt_IdNivelGobierno     = $this->input->post("id_nivel_gob");
            $txt_NombreNivelGobierno = "NULL";
            if ($this->NivelGobierno_Model->EliminarNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA
    public function UpdateNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat                     = "U";
            $txt_IdNivelGobiernoM     = $this->input->post("txt_IdNivelGobiernoM");
            $txt_NombreNivelGobiernoM = $this->input->post("txt_NombreNivelGobiernoM");
            if ($this->NivelGobierno_Model->UpdateNivelGobierno($flat, $txt_IdNivelGobiernoM, $txt_NombreNivelGobiernoM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------
    public function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

}