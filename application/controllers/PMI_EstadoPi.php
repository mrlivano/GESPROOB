<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PMI_EstadoPi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('bancoproyectos_modal');
        $this->load->model('Model_EstadoPi');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $c_data['id_estado_ciclo']=$this->input->post('selectEstado');
            $c_data['id_pi']=$this->input->post('hdIdPI');
            $c_data['fecha_estado_ciclo_pi']=$this->input->post('txtFecha');
            $data=$this->Model_EstadoPi->insertar($c_data);
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }

        $idProyecto=$this->input->get('codigo');
        $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
        $ciclo=$this->bancoproyectos_modal->listar_estado();
        $this->load->view('front/Pmi/ProyectoInversion/estado', ['proyectoInversion'=>$proyectoInversion,'ciclo'=>$ciclo]);
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_EstadoPi->eliminar($this->input->post('idEstado'));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function ListaEstadoProyecto()
    {
        if ($this->input->is_ajax_request())
        {
            $data=$this->Model_EstadoPi->ListaEstadoProyecto($this->input->post("id_pi"));
            foreach ($data as $key => $value)
            {
                $value->fecha_estado_ciclo_pi=date('d/m/Y',strtotime($value->fecha_estado_ciclo_pi));
            }
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }
}
