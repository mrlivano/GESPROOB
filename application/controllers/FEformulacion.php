<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FEformulacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FEformulacion_Modal');
        $this->load->model('Estudio_Inversion_Model');
        $this->load->helper('FormatNumber_helper');
    }

    public function GetFormulacion()
    {
        if ($this->input->is_ajax_request()) {

            $id_est_inve = $this->session->userdata('id_est_inve');

            //$idUsuario    = $this->session->userdata('idPersona');
            //$dataIdPersona= $this->Estudio_Inversion_Model->UsuarioPersona($idUsuario);

            $idPersona=$this->session->userdata('idPersona');
            $TipoUsuario=$this->session->userdata('tipoUsuario');

            if($TipoUsuario==9)
            {
                $id_est_inve=0;
                $datos = $this->FEformulacion_Modal->GetFormulacion($id_est_inve,$idPersona,$TipoUsuario);
                echo json_encode($datos);
            }
            else
            {
                $datos = $this->FEformulacion_Modal->GetFormulacion(48,$idPersona,$TipoUsuario);
                echo json_encode($datos);
            }

        }
        else
        {
            show_404();
        }
    }

    public function GetFEViabilizado()
    {
        if ($this->input->is_ajax_request())
        {
            $id_est_inve = $this->session->userdata('id_est_inve');
            if (empty($id_est_inve))
            {
                $id_est_inve = 'NULL';
            }
            if ($id_est_inve == 'all')
            {
                $id_est_inve = 'NULL';
            }
            $datos = $this->FEformulacion_Modal->GetFEViabilizado($id_est_inve);
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    public function Feformulacion()
    {

            $id_est_inve = isset($_GET['id_est_inv']) ? $_GET['id_est_inv'] : null;
            $data = array('id_est_inve' => $id_est_inve);
            $this->session->set_userdata($data);
            $this->_load_layout('Front/Formulacion_Evaluacion/frmFormulacion');




    }

    public function Feaprobado()
    {
        $id_est_inve = isset($_GET['id_est_inv']) ? $_GET['id_est_inv'] : null;
        $data = array('id_est_inve' => $id_est_inve);
        $this->session->set_userdata($data);
        $this->_load_layout_jsFormFormulacion('Front/Formulacion_Evaluacion/frmAprobados');
    }

    public function Feviabilizado()
    {
        $id_est_inve = isset($_GET['id_est_inv']) ? $_GET['id_est_inv'] : null;
        $data = array('id_est_inve' => $id_est_inve);
        $this->session->set_userdata($data);
        $this->_load_layout_jsViabilizado('Front/Formulacion_Evaluacion/frmViabilizado');
    }

    public function FeEstudioInversion()
    {
        $data= $this->Estudio_Inversion_Model->GetProyectosEstudio();
        foreach ($data as $key => $value)
        {
            $value->costo_estudio = a_number_format($value->costo_estudio , 2, '.',",",3);
        }
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Front/Formulacion_Evaluacion/EstudioInversion/index',['ListaEstudio' => $data]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

    public function insertar()
    {
        if($_POST)
        {
            $idPersona=$this->input->post("listaCoordinador");
            $nombreEstudio=$this->input->post("txtNombreEstudioInversion");
            $idPi=$this->input->post("listaProyectos");
            $idTipoEstudio=$this->input->post("listaTipoEstudio");
            $idNivelEstudio=$this->input->post("listaNivelEstudio");
            $idUnidadFormuladora=$this->input->post("listaUnidadFormuladora");
            $idUnidadEjecutora=$this->input->post("listaUnidadEjecutora");
            $descripcionEstudio=$this->input->post("txtDescripcionEstudio");
            $montoInversion=floatval(str_replace(",","",$this->input->post("txtMontoInversion")));
            $costoEstudio=floatval(str_replace(",","",$this->input->post("txtCostoEstudio")));

            $datos = $this->Estudio_Inversion_Model->RegistrarEstudioInversion($idPersona,$nombreEstudio,$idPi,$idTipoEstudio,$idNivelEstudio,$idUnidadFormuladora,$idUnidadEjecutora,$descripcionEstudio,$montoInversion,$costoEstudio);

            $this->session->set_flashdata('correcto', 'Se registró correctamente');
            return redirect('/FEformulacion/FeEstudioInversion');
        }
        $listaNivelEstudio= $this->Estudio_Inversion_Model->get_NivelEstudio();
        $listaTipoEstudio= $this->Estudio_Inversion_Model->get_TipoEstudio();
        $listaUnidadFormuladora = $this->Estudio_Inversion_Model->get_UnidadFormuladora();
        $listaUnidadEjecutora = $this->Estudio_Inversion_Model->get_UnidadEjecutora();
        $listaCoordinador = $this->Estudio_Inversion_Model->get_coordinador();
        return $this->load->view('Front/Formulacion_Evaluacion/EstudioInversion/insertar',['listaNivelEstudio' => $listaNivelEstudio, 'listaTipoEstudio' => $listaTipoEstudio , 'listaUnidadFormuladora' => $listaUnidadFormuladora, 'listaUnidadEjecutora' => $listaUnidadEjecutora, 'listaCoordinador' => $listaCoordinador]);
    }

    public function getProyectos()
    {
        if ($this->input->is_ajax_request())
        {
            $anio=$this->input->post("anio");
            $data= $this->Estudio_Inversion_Model->GetProyectosparaEstudio($anio);
            echo json_encode($data);
        }
        else
        {
            show_404();
        }
    }

    public function getProyectoParaEstudioInversion()
    {
        if ($this->input->is_ajax_request())
        {
            $anio=$this->input->post("anio");
            $id_pi=$this->input->post("id_pi");
            $datos= $this->Estudio_Inversion_Model->GetProyectoParaEstudioInversion($anio,$id_pi);
            $datos->costo_pi = a_number_format($datos->costo_pi , 2, '.',",",3);
            echo json_encode(['estudioInversion' => $datos]);
        }
        else
        {
            show_404();
        }
    }

    public function FeEstudioInversionFormulador()
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Front/Formulacion_Evaluacion/ProyectosFormulacion/index');
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

    public function UFEstudioInversionFormulacionFormulador()
    {
        $listarEstudioFormulacionlacionForulador = $this->FEformulacion_Modal->UFEstudioInversionFormulacion();
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Front/Formulacion_Evaluacion/ProyectosFormulacion/index',['listarEstudioFormulacionlacionForulador' =>$listarEstudioFormulacionlacionForulador]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
        $this->load->view('Front/Formulacion_Evaluacion/js/jsFormFormulacion');
    }

    public function _load_layout_jsFormFormulacion($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
        $this->load->view('Front/Formulacion_Evaluacion/js/jsFormAprobados');
    }

    public function _load_layout_jsViabilizado($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
        $this->load->view('Front/Formulacion_Evaluacion/js/jsFormViabilizados');
    }
}
