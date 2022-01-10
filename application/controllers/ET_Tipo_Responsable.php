<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Tipo_Responsable extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_ET_Tipo_Responsable");   
	}
    public function index()
    {
        $flat  = "LISTAR";
        $listaTipoResponsable=$this->Model_ET_Tipo_Responsable->TipoResponsableListar($flat);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('front/Ejecucion/ETTipoResponsable/index',['listaTipoResponsable'=>$listaTipoResponsable]);
        $this->load->view('layout/Ejecucion/footer');
    }
    public function insertar()
    {
        if($_POST)
        {
            $flat  = "INSERTAR";
            $txtDescripcion=$this->input->post('txtDescripcion');
            $this->Model_ET_Tipo_Responsable->insertar($flat,$txtDescripcion); 
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit; 
        }

        $this->load->view('front/Ejecucion/ETTipoResponsable/insertar');
    }
     public function editar()
    {

        if($this->input->post('hdId'))
        {
            $flat  = "ACTUALIZAR";
            $id=$this->input->post('hdId');
            $txtDescripcion=$this->input->post('txtDescripcion');

            $this->Model_ET_Tipo_Responsable->editar($flat,$id,$txtDescripcion);
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos actualizados correctamente.']);exit;  
        }
        $id=$this->input->get('id');
        $tiporesponsable=$this->Model_ET_Tipo_Responsable->TipoResponsable($id)[0];
        
        return $this->load->view('front/Ejecucion/ETTipoResponsable/editar',['tiporesponsable'=>$tiporesponsable]);
    }

}