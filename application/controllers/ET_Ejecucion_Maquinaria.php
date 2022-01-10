<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Ejecucion_Maquinaria extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ET_Ejecucion_Maquinaria');
    }

    public function index()
    {
        $idMaquinaria=$this->input->get('id_maquinaria');  

        $listaEjecucionMaquinaria = $this->Model_ET_Ejecucion_Maquinaria->EjecucionPorMaquinaria($idMaquinaria);

        $this->load->view('Front/Ejecucion/ETMaquinaria/ejecucion',['idMaquinaria'=>$idMaquinaria,'listaEjecucionMaquinaria'=>$listaEjecucionMaquinaria]);
    }

    public function insertar()
    {
        if($_POST)
        {
            $msg = array();

            $c_data['id_maquinaria']=$this->input->post('hdIdMaquinaria');
            $c_data['trabajos_realizados']=$this->input->post('txtTrabajosRealizados');
            $c_data['num_horas_trabajadas']=$this->input->post('txtCantidad');
            $c_data['fecha']=$this->input->post('txtFecha');

            $data = $this->Model_ET_Ejecucion_Maquinaria->insertar($c_data);

            $msg=($data>0 ? (['proceso'=>'Correcto', 'mensaje'=>'Los datos fuerón registrados correctamente']) : (['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error inesperado']));       

            echo json_encode($msg);exit;
        }
    }

    public function eliminar()
    {
        $idEjecucion = $this->input->post('idEjecucion');

        $data = $this->Model_ET_Ejecucion_Maquinaria->eliminar($idEjecucion);

        $msg=($data>0 ? (['proceso'=>'Correcto', 'mensaje'=>'El registro fue eliminado correctamente']) : (['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error inesperado']));       

        echo json_encode($msg);exit;
    }

}
