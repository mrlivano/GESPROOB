<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Recurso extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model("Model_ET_Recurso");
	}
 public function index()
    {
        $flat  = "R";
        $listaRecurso=$this->Model_ET_Recurso->RecursoListar($flat);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('front/Ejecucion/Recurso/index',['listaRecurso' => $listaRecurso]);
        $this->load->view('layout/Ejecucion/footer');
    }
    public function insertar()
    {
        if($_POST)
        {
            $this->db->trans_start(); 
            $flat  = "C";
            $txtDescripcion=$this->input->post('txtDescripcion');
            $modalidad = $this->input->post('cbxModalidad');

            if(count($this->Model_ET_Recurso->RecursoPorDescripcion($txtDescripcion))>0)
            {
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este Recurso ya fue registrado con anterioridad.']);exit; 
            }
            
            $this->Model_ET_Recurso->insertar($flat,$txtDescripcion,$modalidad);   
            $this->db->trans_complete();         
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit;
        }

        return $this->load->view('front/Ejecucion/Recurso/insertar');

    }
    public function editar()
    {
        if($this->input->post('hdId'))
        {   $this->db->trans_start(); 
            $flat  = "U";
            $id=$this->input->post('hdId');
            $txtDescripcion=$this->input->post('txtDescripcion');
            $modalidad = $this->input->post('cbxModalidad');

            if(count($this->Model_ET_Recurso->EtRecursoPorDescripcionDiffId($id, $txtDescripcion))>0)
            {
                 echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este Recurso ya fue registrado con anterioridad.']);exit; 
            }

            $this->Model_ET_Recurso->editar($flat,$id,$txtDescripcion,$modalidad);    
            $this->db->trans_complete();     
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se actualizo el recurso correctamente.']);exit;
        }

        $id=$this->input->get('id');
        $recurso=$this->Model_ET_Recurso->Recurso($id)[0];
        return $this->load->view('front/Ejecucion/Recurso/editar',['recurso'=>$recurso]);       
    }

    function eliminar()
    { 
        if ($this->input->is_ajax_request()) 
        {
            $opcion="D";
            $id=$this->input->post('id_recurso');
            $this->Model_ET_Recurso->eliminar($opcion,$id);
            echo json_encode($Data);
        }
    }  
}