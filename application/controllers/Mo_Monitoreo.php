<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_Monitoreo extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Producto');
        $this->load->model('Model_Mo_Actividad');
        $this->load->model('Model_Mo_Ejecucion_Actividad');
        $this->load->helper('FormatNumber_helper');
    }

    function index()
    {
        if($_POST)
        {

        }
        $proyecto = $this->Model_Mo_Producto->ProyectoPorId($this->input->get('id_pi'));
        $producto = $this->Model_Mo_Producto->listaProducto($this->input->get('id_pi'));       

        foreach ($producto as $key => $value) 
        {
            $value->childActividad = $this->Model_Mo_Actividad->listaActividad($value->id_producto);
        }        
        
        $this->load->view('front/Monitoreo/Mo_Monitoreo/index', ['proyecto' => $proyecto, 'producto'=>$producto]);
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();

            $ejecucion=$this->Model_Mo_Ejecucion_Actividad->verprogramacion($this->input->post('hdIdEjecucion'));
            if($this->input->post('txtEjFisReal')>$ejecucion->ejec_fisic_prog)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'El Avance físico real no puede ser mayor al avance físico programado']);
                echo json_encode($msg);exit;
            }

            $ejecFinancieraReal = floatval(str_replace(',','',$this->input->post('txtEjFinReal')));

            if($ejecFinancieraReal>$ejecucion->ejec_finan_prog)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'El Avance financiero real no puede ser mayor al avance financiero programado']);
                echo json_encode($msg);exit;
            }

            $this->db->trans_start();

            $data['ejec_fisic_real']=$this->input->post('txtEjFisReal');
            $data['ejec_finan_real']=$ejecFinancieraReal;
            $data['fecha_modificacion']=date('Y-m-d');

            $this->Model_Mo_Ejecucion_Actividad->editar($data,$this->input->post('hdIdEjecucion'));

            $Monitoreo['desc_monitoreo']=$this->input->post('txtResultado');
            $Monitoreo['fecha_registro']=date('Y-m-d');
            $Monitoreo['id_ejecucion']=$this->input->post('hdIdEjecucion');

            $query=$this->Model_Mo_Monitoreo->insertar($Monitoreo);

            $this->db->trans_complete();

            $msg = ($query != '' || $query != NULL? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idMonitoreo' =>$query]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }
    }

}
