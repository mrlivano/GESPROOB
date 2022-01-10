<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Tipo_Gasto extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model("Model_ET_Tipo_Gasto");  
	}
    public function index()
    {
        $flat  = "R";
        $listaTipoGastoAnalitico=$this->Model_ET_Tipo_Gasto->TipoGastoAnaliticoListar($flat);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('front/Ejecucion/TipoGastoAnalitico/index',['listaTipoGastoAnalitico'=>$listaTipoGastoAnalitico]);
        $this->load->view('layout/Ejecucion/footer');
    }
    public function insertar()
    {
        if($_POST)
        {
            $this->db->trans_start(); 
            $flat  = "C";
            $txtDescripcion=$this->input->post('txtDescripcion');

            if(count($this->Model_ET_Tipo_Gasto->EtTipoGastoPorDescripcion($txtDescripcion))>0)
            {
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este tipo de gasto de ejecución ya fue registrado con anterioridad.']);exit; 
            }
            
            $this->Model_ET_Tipo_Gasto->insertar($flat,$txtDescripcion);       
            $this->db->trans_complete();     
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit;  
        }

        return $this->load->view('front/Ejecucion/TipoGastoAnalitico/insertar');
    }

    public function editar()
    {
        if($this->input->post('hdId'))
        {
            $this->db->trans_start(); 
            $flat  = "U";
            $id=$this->input->post('hdId');

            $txtDescripcion=$this->input->post('txtDescripcion');
            if(count($this->Model_ET_Tipo_Gasto->EtTipoGastoPorDescripcionDiffId($id, $txtDescripcion))>0)
            {
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este presupuesto de ejecución ya fue registrado con anterioridad.']);exit;  
            }
            $this->Model_ET_Tipo_Gasto->editar($flat,$id,$txtDescripcion);
            $this->db->trans_complete();
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos actualizados correctamente.']);exit; 
        }

        $id=$this->input->get('id');
        $tipogastoanalitico=$this->Model_ET_Tipo_Gasto->TipoGastoAnalitico($id)[0];
        return $this->load->view('front/Ejecucion/TipoGastoAnalitico/editar',['tipogastoanalitico'=>$tipogastoanalitico]);       
    }
}