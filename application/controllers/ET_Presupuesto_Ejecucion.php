<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Presupuesto_Ejecucion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_ET_Presupuesto_Ejecucion");   
    }
    
    public function index()
    {
        $presupuestoejecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

        foreach($presupuestoejecucion as $key => $value)
        {
            $value->childPresupuesto = $this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
        }

        $this->load->view('layout/Ejecucion/header');
        $this->load->view('front/Ejecucion/PresupuestoEjecucion/index',['listaPresupuestoEjecucion'=>$presupuestoejecucion]);
        $this->load->view('layout/Ejecucion/footer');
    }

    public function insertar()
    {
    	if($_POST)
        {
            $msg = array();

            $this->db->trans_start(); 
            
            $c_data['desc_presupuesto_ej']=$this->input->post('txtDescripcion');

            if($this->input->post('hdIdPresupuestoEjecucion')!='')
            {
                $c_data['id_presupuesto_ej_padre']=$this->input->post('hdIdPresupuestoEjecucion');
            }            

            if(count($this->Model_ET_Presupuesto_Ejecucion->EtPresupuestoEjecucionPorDescripcion($this->input->post('txtDescripcion'),$this->input->post('hdIdPresupuestoEjecucion')))>0)
            {
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este presupuesto de ejecución ya fue registrado con anterioridad.']);exit; 
            }

            $data = $this->Model_ET_Presupuesto_Ejecucion->insertar($c_data); 

            $this->db->trans_complete();

            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
            
            echo json_encode($msg);exit; 

        }

        $this->load->view('front/Ejecucion/PresupuestoEjecucion/insertar');
    }

    function editar()
    {
        
        if($this->input->post('hdId'))
        {
            $this->db->trans_start(); 
            $flat  = "U";
            $id=$this->input->post('hdId');

            $txtDescripcion=$this->input->post('txtDescripcion');

            if(count($this->Model_ET_Presupuesto_Ejecucion->EtPresupuestoEjecucionPorDescripcionDiffId($id, $txtDescripcion))>0)
            {
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este presupuesto de ejecución ya fue registrado con anterioridad.']);exit; 
            }
            $this->Model_ET_Presupuesto_Ejecucion->editar($flat,$id,$txtDescripcion);
            $this->db->trans_complete();
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos actualizados correctamente.']);exit;  
        }
        $id=$this->input->get('id');
        $presupuestoejecucion=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjecucion($id)[0];
        
        return $this->load->view('front/Ejecucion/PresupuestoEjecucion/editar',['presupuestoejecucion'=>$presupuestoejecucion]); 
    }

    function eliminar()
    {
        if ($this->input->is_ajax_request()) 
        {
            $opcion="D";
            $id=$this->input->post('id_presupuesto_ej');
            $this->Model_ET_Presupuesto_Ejecucion->eliminar($opcion,$id);
            echo json_encode($Data);
        }
    }   

    public function insertarPresupuesto()
    {
    	$idPresupuesto =  $this->input->get('idPresupuesto');

        $this->load->view('front/Ejecucion/PresupuestoEjecucion/insertar',['idPresupuesto'=>$idPresupuesto]);        
    }
}