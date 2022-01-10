<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Programacion extends CI_Controller
{
/* Mantenimiento de sector entidad Y servicio publico asociado*/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Programacion');

        $this->load->helper('FormatNumber_helper');
    }
    /*INSERTAR UN PROYECTO*/
    public function AddProgramacion()
    {
        if ($this->input->is_ajax_request()) {
            $textidCartera         = $this->input->post("textidCartera");
            $cbxBrechaP            = $this->input->post("cbxBrechaP");
            $textidpip             = $this->input->post("textidpip");
            $txt_MontoProgramado   = $this->input->post("txt_MontoProgramado");
            $AnioProgramado        = $this->input->post("AnioProgramado");
            $txtPrioridadProg      = $this->input->post("txtPrioridadProg");
            $monto_opera_mant_prog = "0.0";

            if ($this->Model_Programacion->AddProgramacion($textidCartera, $cbxBrechaP, $textidpip, $txt_MontoProgramado, $AnioProgramado, $txtPrioridadProg, $monto_opera_mant_prog) == true) {
                echo "Se añadio una Programacion";
            } else {
                echo "Se añadio una Programacion";
            }

        } else {
            show_404();
        }
    }
    /*FIN INSERTAR UN PROYECTO*/
    //
    public function AddProgramacionOperManteni()
    {
        if ($this->input->is_ajax_request()) {
            $textidCartera           = $this->input->post("textidCartera");
            $cbxBrechaP              = $this->input->post("cbxBrechaP");
            $textidpip               = $this->input->post("textidpip");
            $txt_MontoProgramado     = "0.0";
            $AnioProgramadoOpeMant   = $this->input->post("AnioProgramadoOpeMant");
            $txtPrioridadProg        = $this->input->post("txtPrioridadProg");
            $txt_MontoOperacionMante = $this->input->post("txt_MontoOperacionMante");

            if ($this->Model_Programacion->AddProgramacionOperManteni($textidCartera, $cbxBrechaP, $textidpip, $txt_MontoProgramado, $AnioProgramadoOpeMant, $txtPrioridadProg, $txt_MontoOperacionMante) == true) {
                echo "Se añadio una Programacion Multianual";
            } else {
                echo "Se añadio una Programacion Multianual";
            }

        } else {
            show_404();
        }
    }
    //
    //AGREGAR MONTO PROGRAMADO EN UNA TABLA TEMPORAL

    //FIN MONTO PROGRAMADO EN UNA TABLA TEMPORAL

    //para traer los proyectos
    public function GetProgramacion()
    {
        if ($this->input->is_ajax_request()) 
        {
            $id_proyecto_filtro = "";
            $anio_apertura_actual = $this->input->post('AnioCartera');
            $skip                 = $this->input->post('start');
            $numberRow            = $this->input->post('length');
            $valueSearch          = $this->input->post('search[value]');
            $datos      = $this->Model_Programacion->GetProgramacion($id_proyecto_filtro, $anio_apertura_actual, $skip, $numberRow, $valueSearch);
            $totalDatos = $this->Model_Programacion->GetProgramacion($id_proyecto_filtro, $anio_apertura_actual, 0, 0, $valueSearch);
            echo '{ "recordsTotal" : ' . (count($totalDatos)) . ', "recordsFiltered" : ' . (count($totalDatos)) . ', "data" : ' . json_encode($datos) . ' }';
        } 
        else 
        {
            show_404();
        }
    }

    //fin traer proyectos
    //buscar proyecto de inversion
    public function BuscarProyectoInversion()
    {
        if ($this->input->is_ajax_request()) {
            $Id_ProyectoInver = $this->input->post("Id_ProyectoInver");
            $opcion           = $this->input->post("opcion");
            $datos            = $this->Model_Programacion->BuscarProyectoInversion($Id_ProyectoInver, $opcion);
            echo json_encode($datos);

        } else {
            show_404();
        }
    }
    //para mostrar las tres programaciones y poder actualizar
    public function GetProgramacionModificar()
    {
        if ($this->input->is_ajax_request()) {

            $opcion = "R";

            $id_prog               = "0";
            $id_cartera            = "1";
            $id_brecha             = "02";
            $id_pi                 = "03";
            $monto_prog            = "0.0";
            $año_prog             = "2000-02-2";
            $prioridad_prog        = "5";
            $monto_opera_mant_prog = "6";
            $tipo_prog             = "NULL";

            $datos = $this->Model_Programacion->GetProgramacionModificar($opcion, $id_prog, $id_cartera, $id_brecha, $id_pi, $monto_prog, $año_prog, $prioridad_prog, $monto_opera_mant_prog, $tipo_prog);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    public function UpdateProgramacion()
    {

        if ($this->input->is_ajax_request()) {

            $opcion = "U";
            //$id_prog="0";
            $id_pi                 = "0";
            $id_cartera            = "1";
            $id_brecha             = "1";
            $id_prog               = $this->input->post("texIdeProyecto");
            $monto_prog            = $this->input->post("txtMontoProgramado");
            $año_prog             = $this->input->post("txtañoProgramado");
            $prioridad_prog        = $this->input->post("txtPrioridad");
            $monto_opera_mant_prog = $this->input->post("txtOperacioMantenimiento");
            $tipo_prog             = $this->input->post("txtTipoProgramacion");

            $datos = $this->Model_Programacion->UpdateProgramacion($opcion, $id_prog, $id_cartera, $id_brecha, $id_pi, $monto_prog, $año_prog, $prioridad_prog, $monto_opera_mant_prog, $tipo_prog);
            echo json_encode($datos);
        } else {
            show_404();
        }

    }
    public function index()
    {
        $this->_load_layout('Front/Pmi/frmMProyectoInversion');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');
    }

}
