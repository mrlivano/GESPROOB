<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_Programacion_Actividad extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('FormatNumber_helper');
        $this->load->model('Model_Mo_Programacion_Actividad');
        $this->load->model('Model_Mo_Actividad');
    }

    function Insertar()
    {
        if($_POST)
        {
            $msg = array();

            $fechaProgramacion = $this->input->post('txtMeses').'-01';
            $existe = count($this->Model_Mo_Programacion_Actividad->verificarProgramacion($fechaProgramacion,$this->input->post('hiddenIdActividad')));

            if($existe!=0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Ya existe la Programación para esa fecha y año']);
                echo json_encode($msg);
                exit;
            }

            $actividad=$this->Model_Mo_Actividad->actividadId($this->input->post('hiddenIdActividad'));
            $sumatoriaProg=$this->Model_Mo_Actividad->sumatoriaEjecucionProgramada($this->input->post('hiddenIdActividad'));
            if(count($sumatoriaProg)>0)
            {
                if($actividad->meta<$sumatoriaProg[0]->cantidad+$this->input->post('txtFisica'))
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'La cantidad ingresada supera la meta definido para esta Actividad']);
                    echo json_encode($msg);
                    exit;
                }
                if($actividad->costo_total<$sumatoriaProg[0]->monto+floatval(str_replace(",","",$this->input->post("txtFinanc"))))
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'El monto ingresado supera el monto definido para esta Actividad']);
                    echo json_encode($msg);
                    exit;
                }
            }

            $c_data['fecha_programacion']=$fechaProgramacion;
            $c_data['cantidad_ejecucion_programada']=$this->input->post('txtFisica');
            $c_data['ejec_finan_programada']=floatval(str_replace(",","",$this->input->post("txtFinanc")));
            $c_data['id_actividad']=$this->input->post('hiddenIdActividad');
            
            $data = $this->Model_Mo_Programacion_Actividad->insertar($c_data);

            $msg = ($data != '' || $data != null ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idProgramacion' => $data ]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $idActividad = $this->input->get('idActividad');
        $idPi = $this->input->get('idPi');

        $Actividad = $this->Model_Mo_Actividad->actividadId($idActividad);
        $sumatoriaEjec = $this->Model_Mo_Actividad->sumatoriaEjecucionProgramada($idActividad);
        $cantidadRestante = $Actividad->meta;
        $costoRestante = $Actividad->costo_total;
        if(count($sumatoriaEjec)>0)
        {
            $cantidadRestante = $Actividad->meta - $sumatoriaEjec[0]->cantidad;
            $costoRestante = $Actividad->costo_total - $sumatoriaEjec[0]->monto;
        }       
       
        $this->load->view('front/Monitoreo/Mo_Programacion_Actividad/insertar', ['idPi' => $idPi, 'Actividad' => $Actividad,'cantidadRestante'=>$cantidadRestante,'costoRestante'=>$costoRestante]);
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();
            $fechaProgramacion = $this->input->post('txtMesesEditar').'-01';

            $fechaProgramacion=date('Y-m-d',strtotime($fechaProgramacion));

            $existe = count($this->Model_Mo_Programacion_Actividad->verificarProgramacionDiferente($fechaProgramacion,$this->input->post('hdIdActividad'),$this->input->post('hdIdProgramacion')));
            if($existe!=0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Ya existe la programacion para ese mes.']);
                echo json_encode($msg);
                exit;
            }

            $this->db->trans_begin();

            $c_data['fecha_programacion']=$fechaProgramacion;
            $c_data['cantidad_ejecucion_programada']=$this->input->post('txtFisicaEditar');
            $c_data['ejec_finan_programada']=floatval(str_replace(",","",$this->input->post('txtFinancEditar')));
            $data = $this->Model_Mo_Programacion_Actividad->editar($c_data,$this->input->post('hdIdProgramacion'));

            $programacion = $this->Model_Mo_Programacion_Actividad->verprogramacion($this->input->post('hdIdProgramacion'));
            $Actividad=$this->Model_Mo_Actividad->actividadId($programacion->id_actividad);
            $sumatoriaEjec = $this->Model_Mo_Actividad->sumatoriaEjecucionProgramada($programacion->id_actividad);
            if(count($sumatoriaEjec)>0)
            {
                if($Actividad->meta<$sumatoriaEjec[0]->cantidad)
                {
                    $this->db->trans_rollback();
                    $msg = (['proceso' => 'Error', 'mensaje' => 'La cantidad ingresada supera la meta definido para esta Actividad']);
                    echo json_encode($msg);
                    exit;
                }
                if($Actividad->costo_total<$sumatoriaEjec[0]->monto)
                {
                    $this->db->trans_rollback();
                    $msg = (['proceso' => 'Error', 'mensaje' => 'El monto ingresado supera el monto definido para esta Actividad']);
                    echo json_encode($msg);
                    exit;
                }
            }   

            $this->db->trans_complete();         

            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron editados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }

        $programacion=$this->Model_Mo_Programacion_Actividad->verprogramacion($this->input->get('idEjecucion'));
        $Actividad = $this->Model_Mo_Actividad->actividadId($this->input->get('idActividad'));
        $sumatoriaEjec = $this->Model_Mo_Actividad->sumatoriaEjecucionProgramada($this->input->get('idActividad'));

        $cantidadRestante = $Actividad->meta;
        $costoRestante = $Actividad->costo_total;
        if(count($sumatoriaEjec)>0)
        {
            $cantidadRestante = $Actividad->meta - $sumatoriaEjec[0]->cantidad;
            $costoRestante = $Actividad->costo_total - $sumatoriaEjec[0]->monto;
        }

        $this->load->view('front/Monitoreo/Mo_Programacion_Actividad/editar', ['programacion' => $programacion,'Actividad'=>$Actividad,'cantidadRestante'=>$cantidadRestante,'costoRestante'=>$costoRestante]);
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_Mo_Programacion_Actividad->eliminar($this->input->post('idProgramacion'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'La Programación ha sido eliminada con exito']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
}
