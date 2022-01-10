<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrincipalFyE extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_DashboardFE');
    }

    public function PrincipalFyED(){

       $listarEtapas= $this->Model_DashboardFE->GetAprobadosEstudio();
      // var_dump($listarEtapas);exit;
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Formulacion_Evaluacion',['listarEtapas'=> $listarEtapas]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

    public function Formulacion_Eval()
    {
        $this->_load_layout('front/Formulacion_Evaluacion/Inicio.php');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }
    //estadistica
    public function GetAprobadosEstudio()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_DashboardFE->GetAprobadosEstudio();
            echo json_encode($datos);
        } else
        show_404();
    }
    //fin estadistica
    public function EstudioInvPorTipoEstudio()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_DashboardFE->EstudioInvPorTipoEstudio();
            echo json_encode($datos);
        } else
        show_404();
    }
    public function EstudioInvPorProvincia()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_DashboardFE->EstudioInvPorProvincia();
            echo json_encode($datos);
        } else
        show_404();
    }

    public function TipoGastoMontos()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_DashboardFE->TipoGastoMontos();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    public function AvanceCostoInv()
    {
        if ($this->input->is_ajax_request()) 
        {
            $avance= array();
            $datos = $this->Model_DashboardFE->AvanceCostoInv();
            foreach ($datos as $key => $Itemp) 
            {
               $avance[$key]=[$Itemp->avance_fisico,$Itemp->costo_estudio];
            }
            echo json_encode($avance);
        } 
        else 
        {
            show_404();
        }
    }

    public function getDatosEstudiosInversionNotificacion()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_DashboardFE->getDatosEstudiosInversion();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }



}
