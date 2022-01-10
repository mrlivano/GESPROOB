<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PipProgramados extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PipProgramados_Model');        
        $this->load->helper('FormatNumber_helper');
        $this->load->model('programar_pip_modal');      
        $this->load->model('Model_MetaPresupuestalPi'); 
        $this->load->model('Model_Dashboard_Reporte'); 
        $this->load->library('mydompdf');           
    }

    public function GetPipProgramadosFormulacionEvaluacion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "listarpip_formulacion_evaluacion_programado";
            $anio = $this->input->post("anio");
            $data = $this->PipProgramados_Model->GetPipProgramadosFormulacionEvaluacion($flat, $anio);  
            
            echo json_encode(array('data' => $data));
        } 
        else 
        {
            show_404();
        }
    }

    public function GetPipProgramadosEjecucion()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat = "listarpip_ejecucion_programado";
            $anio = $this->input->post("anio");
            $data = $this->PipProgramados_Model->GetPipProgramadosEjecucion($flat, $anio);
            echo json_encode(array('data' => $data));
        } 
        else 
        {
            show_404();
        }
    }

    public function GetPipOperacionMantenimiento()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat = "listarpip_operacionmantenimiento_programado";
            $anio = $this->input->post("anio");
            $data = $this->PipProgramados_Model->GetPipOperacionMantenimiento($flat, $anio);
            echo json_encode(array('data' => $data));
        } 
        else 
        {
            show_404();
        }
    }

    public function index()
    {
        $anioProgramado=$this->programar_pip_modal->GetAnioCarteraProgramado();
        $this->load->view('layout/PMI/header');
        $this->load->view('Front/Pmi/frmpipprogramados',['anioProgramado'=>$anioProgramado]);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsPipProgramados.php');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');        
    }

    public function ProyectoProgramadoEjecucion()
    {
        $anio=$this->input->post("anio");
        $data = $this->PipProgramados_Model->GetPipProgramadosEjecucion('listarpip_ejecucion_programado', $anio);
        $inv1='Inv_'.($anio+1);
		$inv2='Inv_'.($anio+2);
        $inv3='Inv_'.($anio+3);
        
        foreach ($data as $value) 
        {
            $devengadoAcumulado=0;
            $secFuncProyecto=$this->Model_Dashboard_Reporte->ConsultaMetaAcumulado($value->codigo_unico_pi,$anio);
            foreach ($secFuncProyecto as $key => $item) 
            {
                $listaDevengado=$this->Model_Dashboard_Reporte->ConsultaDevengadoAcumulado($item->ano_eje, $item->sec_ejec, $item->sec_func);
                $devengadoAcumulado+=(count($listaDevengado)>0 ? $listaDevengado[0]->devengado : 0);
            }

            $metaPresupuestal=$this->Model_MetaPresupuestalPi->MetaPresupuestalPorAnioIdPi($anio, $value->id_pi);
            $value->pim=(count($metaPresupuestal)>0 ? $metaPresupuestal[0]->pim_acumulado : '0.00'); 
            //$value->devengado_acumulado=(count($metaPresupuestal)>0 ? $metaPresupuestal[0]->devengado_acumulado : '0.00');        
            $value->devengado_acumulado=$devengadoAcumulado;         
            $value->saldo=$value->costo_pi-$value->devengado_acumulado-$value->pim-$value->$inv1-$value->$inv2-$value->$inv3;
        }
        $this->load->view('Front/Pmi/tablaProgramacionEjecucion', ['ProyectoProgramado'=>$data, 'anio'=>$anio]);
    }

    public function reporteProgramacionPdf()
    {
        $anio=$this->input->get("anio");
        if($this->input->get("opcion")=='ejecucion')
        {
            $data = $this->PipProgramados_Model->GetPipProgramadosEjecucion('listarpip_ejecucion_programado', $anio);
            $inv1='Inv_'.($anio+1);
            $inv2='Inv_'.($anio+2);
            $inv3='Inv_'.($anio+3);
            foreach ($data as $value) 
            {
                $metaPresupuestal=$this->Model_MetaPresupuestalPi->MetaPresupuestalPorAnioIdPi($anio, $value->id_pi);
                $value->pim=(count($metaPresupuestal)>0 ? $metaPresupuestal[0]->pim_acumulado : '0.00'); 
                $value->devengado_acumulado=(count($metaPresupuestal)>0 ? $metaPresupuestal[0]->devengado_acumulado : '0.00');             
                $value->saldo=$value->costo_pi-$value->devengado_acumulado-$value->pim-$value->$inv1-$value->$inv2-$value->$inv3;
            }

            $html=$this->load->view('Front/Pmi/tablaReporteProgramacion', ['ProyectoProgramado'=>$data, 'anio'=>$anio],true);
            $this->mydompdf->load_html($html);
            $this->mydompdf->set_paper("A4", "landscape");
            $this->mydompdf->render();
            $this->mydompdf->stream("proyectoprogramado.pdf", array("Attachment" => false));

        }
    }

}
