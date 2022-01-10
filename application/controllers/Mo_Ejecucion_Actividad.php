<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_Ejecucion_Actividad extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('FormatNumber_helper');
        $this->load->model('Model_Mo_Ejecucion_Actividad');
        $this->load->model('Model_Mo_Actividad');
    }

    function Insertar()
    {
        if($_POST)
        {
            $msg = array();

            $actividad=$this->Model_Mo_Actividad->actividadId($this->input->post('hdIdActividad'));
            $sumatoriaReal=$this->Model_Mo_Actividad->sumatoriaEjecucionReal($this->input->post('hdIdActividad'));
            if(count($sumatoriaReal)>0)
            {
                if($actividad->meta<$sumatoriaReal[0]->cantidad+$this->input->post('txtCantidadEjecutada'))
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'La cantidad ingresada supera la meta definido para esta Actividad']);
                    echo json_encode($msg);
                    exit;
                }
            }

            $c_data['fecha_ejec']=$this->input->post('txtFecha');
            $c_data['ejec_fisic_real']=$this->input->post('txtCantidadEjecutada');
            $c_data['ejec_finan_real']=floatval(str_replace(",","",$this->input->post("txtMontoEjecutado")));
            $c_data['fecha_registro']=date('Y-m-d');
            $c_data['id_actividad']=$this->input->post('hdIdActividad');
            
            $data = $this->Model_Mo_Ejecucion_Actividad->insertar($c_data);

            $completo=false;

            if($actividad->meta==$sumatoriaReal[0]->cantidad+$this->input->post('txtCantidadEjecutada'))
            {
                $completo=true;
                $this->Model_Mo_Actividad->editarEstado($this->input->post('hdIdActividad'),1);
            }

            $sumatoriaEjec = $this->Model_Mo_Actividad->sumatoriaEjecucionReal($this->input->post('hdIdActividad'));
            $cantidadRestante = $actividad->meta;
            $costoRestante = $actividad->costo_total;
            if(count($sumatoriaEjec)>0)
            {
                $cantidadRestante = $actividad->meta - $sumatoriaEjec[0]->cantidad;
                $costoRestante = $actividad->costo_total - $sumatoriaEjec[0]->monto;
            }

            $msg = ($data != '' || $data != null ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idEjecucion' => $data, 'completo'=>$completo,'cantidadRestante'=>$cantidadRestante,'costoRestante'=>$costoRestante ]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $idActividad = $this->input->get('idActividad');
        $idPi = $this->input->get('idPi');

        $Actividad = $this->Model_Mo_Actividad->actividadId($idActividad);
        $sumatoriaEjec = $this->Model_Mo_Actividad->sumatoriaEjecucionReal($idActividad);
        $cantidadRestante = $Actividad->meta;
        $costoRestante = $Actividad->costo_total;
        if(count($sumatoriaEjec)>0)
        {
            $cantidadRestante = $Actividad->meta - $sumatoriaEjec[0]->cantidad;
            $costoRestante = $Actividad->costo_total - $sumatoriaEjec[0]->monto;
        }
        $costoRestante=a_number_format($costoRestante , 2, '.',",",3);

        $ejecucionActividad = $this->Model_Mo_Ejecucion_Actividad->listaEjecucionActividad($idActividad);
        $this->load->view('front/Monitoreo/Mo_Ejecucion_Actividad/insertar', ['Actividad'=>$Actividad, 'idPi' => $idPi, 'ejecucionActividad' => $ejecucionActividad, 'cantidadRestante'=>$cantidadRestante,'costoRestante'=>$costoRestante]); 
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_Mo_Ejecucion_Actividad->eliminar($this->input->post('idEjecucion'));
        $this->Model_Mo_Actividad->editarEstado($this->input->post('hdIdActividad'),0);
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
}
