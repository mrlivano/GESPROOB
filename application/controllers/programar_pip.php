<?php
defined('BASEPATH') or exit('No direct script access allowed');

class programar_pip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('FormatNumber_helper');
        $this->load->model('programar_pip_modal');
        $this->load->model('Meta_Model');
    }

    public function GetProyectosFormulacionEvaluacion()
    {
        if ($this->input->is_ajax_request())
        {
            $flat  = "listarpip_formulacion_evaluacion";
            $datos = $this->programar_pip_modal->GetProyectosFormulacionEvaluacion($flat);
            $saldo = 0;
            foreach ($datos as $key => $value) 
            {
                if($value->ultimo_pim_meta_pres==0.00 || $value->ultimo_pim_meta_pres==null )
                {
                    $saldo = $value->costo_pi-$value->ultimo_pia_meta_pres-$value->devengado_acumulado_total;
                }
                else
                {
                    $saldo = $value->costo_pi-$value->ultimo_pim_meta_pres-$value->devengado_acumulado_total;
                }

                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
                $value->ultimo_pia_meta_pres = a_number_format($value->ultimo_pia_meta_pres , 2, '.',",",3);
                $value->devengado_acumulado_total = a_number_format($value->devengado_acumulado_total , 2, '.',",",3);
                $value->ultimo_pim_meta_pres = a_number_format($value->ultimo_pim_meta_pres , 2, '.',",",3); 
                $value->saldo = a_number_format($saldo , 2, '.',",",3);            
            }
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function GetProyectosEjecucion()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "listarpip_viable_ejecucion";
            $datos = $this->programar_pip_modal->GetProyectosEjecucion($flat);
            $saldo = 0;
            foreach ($datos as $key => $value) 
            {
                if($value->ultimo_pim_meta_pres==0.00 || $value->ultimo_pim_meta_pres==null )
                {
                    $saldo = $value->costo_pi-$value->ultimo_pia_meta_pres-$value->devengado_acumulado_total;
                    $value->avanceFinanciero=number_format((0), 2, '.', '');
                }
                else
                {
                    $saldo = $value->costo_pi-$value->ultimo_pim_meta_pres-$value->devengado_acumulado_total;
                    $avanceFinanciero=($value->devengado_acumulado_total/$value->ultimo_pim_meta_pres)*100;
                    $value->avanceFinanciero=number_format(($avanceFinanciero), 2, '.', '');
                }
                
                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
                $value->ultimo_pia_meta_pres = a_number_format($value->ultimo_pia_meta_pres , 2, '.',",",3);
                $value->devengado_acumulado_total = a_number_format($value->devengado_acumulado_total , 2, '.',",",3);
                $value->ultimo_pim_meta_pres = a_number_format($value->ultimo_pim_meta_pres , 2, '.',",",3); 
                $value->saldo = a_number_format($saldo , 2, '.',",",3);            
            }
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function GetProyectosFuncionamiento()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "listarpip_funcionamiento";
            $datos = $this->programar_pip_modal->GetProyectosFuncionamiento($flat);
            $saldo = 0;
            if(!$datos)
            {
                echo json_encode($datos);exit;
            }
            foreach ($datos as $key => $value) 
            {
                if($value->ultimo_pim_meta_pres==0.00 || $value->ultimo_pim_meta_pres==null )
                {
                    $saldo = $value->costo_pi-$value->ultimo_pia_meta_pres-$value->devengado_acumulado_total;
                }
                else
                {
                    $saldo = $value->costo_pi-$value->ultimo_pim_meta_pres-$value->devengado_acumulado_total;
                }

                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
                $value->ultimo_pia_meta_pres = a_number_format($value->ultimo_pia_meta_pres , 2, '.',",",3);
                $value->devengado_acumulado_total = a_number_format($value->devengado_acumulado_total , 2, '.',",",3);
                $value->ultimo_pim_meta_pres = a_number_format($value->ultimo_pim_meta_pres , 2, '.',",",3); 
                $value->saldo = a_number_format($saldo , 2, '.',",",3);            
            }
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function GetAnioCartera()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->programar_pip_modal->GetAnioCartera();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    public function GetAnioCarteraProgramado()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->programar_pip_modal->GetAnioCarteraProgramado();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function AddProgramacion()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat = "programar_formulacion_evaluacion_pip";
            $id_programacion = "0";
            $Cbx_AnioCartera = $this->input->post("Cbx_AnioCartera");
            $cbxBrecha = $this->input->post("cbxBrecha");
            $txt_id_pip_programacion = $this->input->post("txt_id_pip_programacion");
            $txt_anio1 = floatval(str_replace(",", "", $this->input->post("txt_anio1")));
            $txt_anio2 = floatval(str_replace(",", "", $this->input->post("txt_anio2")));
            $txt_anio3 = floatval(str_replace(",", "", $this->input->post("txt_anio3")));            
            $txt_anio1_oper=($this->input->post("txt_anio4")=='')?0:floatval(str_replace(",", "", $this->input->post("txt_anio4")));
            $txt_anio2_oper=($this->input->post("txt_anio5")=='')?0:floatval(str_replace(",", "", $this->input->post("txt_anio5")));
            $txt_anio3_oper=($this->input->post("txt_anio6")=='')?0:floatval(str_replace(",", "", $this->input->post("txt_anio6")));  

            $txt_prioridad = floatval($this->input->post("txt_prioridad"));
            if ($this->programar_pip_modal->AddProgramacion($flat, $id_programacion, $Cbx_AnioCartera, $cbxBrecha, $txt_id_pip_programacion, $txt_anio1, $txt_anio2, $txt_anio3, $txt_anio1_oper, $txt_anio2_oper, $txt_anio3_oper, $txt_prioridad) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }
    }
    //agregar progrmacion para operacion y mantenimiento
    public function AddProgramacion_operacion_mantenimiento()
    {
        if ($this->input->is_ajax_request()) {
            $flat                     = "programar_operacion_mantenimiento";
            $id_programacion_         = "0";
            $Cbx_AnioCartera_         = $this->input->post("Cbx_AnioCartera_");
            $cbxBrecha_               = $this->input->post("cbxBrecha_");
            $txt_id_pip_programacion_ = $this->input->post("txt_id_pip_programacion_");
            $txt_anio1_               = floatval(str_replace(",", "", $this->input->post("txt_anio1_")));
            $txt_anio2_               = floatval(str_replace(",", "", $this->input->post("txt_anio2_")));
            $txt_anio3_               = floatval(str_replace(",", "", $this->input->post("txt_anio3_")));
            $txt_prioridad_           = floatval($this->input->post("txt_prioridad_"));
            if ($this->programar_pip_modal->AddProgramacion_operacion_mantenimiento($flat, $id_programacion_, $Cbx_AnioCartera_, $cbxBrecha_, $txt_id_pip_programacion_, $txt_anio1_, $txt_anio2_, $txt_anio3_, $txt_prioridad_) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }
    }

    //Agregar META PRESUPUESTAL PI
    public function AddMeta_PI()
    {
        if ($this->input->is_ajax_request()) 
        {
            $Meta=$this->Meta_Model->correlativoMeta($this->input->post("cbx_Meta"));
            
            $idCorrelativo = (count($Meta)>0 ? $Meta->id_correlativo_meta : '0001');
            $flat= "C";
            $id_meta_pi= "0";
            $txt_anio_meta=$this->input->post("txt_anio_meta");
            $cbx_meta_presupuestal=$this->input->post("cbx_meta_presupuestal");
            $txt_id_pip_programacion_mp=$this->input->post("txt_id_pip_programacion_mp");
            $cbx_Meta=$idCorrelativo;
            $txt_pia=floatval(str_replace(",","",$this->input->post("txt_pia")));
            $txt_pim=floatval(str_replace(",","",$this->input->post("txt_pim")));
            $txt_certificado=floatval(str_replace(",","",$this->input->post("txt_certificado")));
            $txt_compromiso=floatval(str_replace(",","",$this->input->post("txt_compromiso")));
            $txt_devengado=floatval(str_replace(",","",$this->input->post("txt_devengado")));
            $txt_girado=floatval(str_replace(",","",$this->input->post("txt_girado")));
            if ($this->programar_pip_modal->AddMeta_PI($flat, $id_meta_pi, $txt_anio_meta, $cbx_meta_presupuestal, $txt_id_pip_programacion_mp, $cbx_Meta, $txt_pia, $txt_pim, $txt_certificado, $txt_compromiso, $txt_devengado, $txt_girado) == false) 
            {
                echo "1";
            } 
            else 
            {
                echo "2";
            }

        } 
        else 
        {
            show_404();
        }
    }
    //Listar prioridad
    public function listar_prioridad()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "listar_ultimo_pi_programado_prioridad";
            $anio = $this->input->post("anio");
            $data = $this->programar_pip_modal->listar_prioridad($flat, $anio);
            echo json_encode(array('data' => $data));
        } else {
            show_404();
        }
    }
    //Listar programación
    public function listar_programacion()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "listar_programado_pip";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->programar_pip_modal->listar_programacion($flat, $id_pi);
            foreach ($data as $key => $value) 
            {
                $value->monto_prog = a_number_format($value->monto_prog , 2, '.',",",3);                
            }
            echo json_encode(array('data' => $data));          
        } 
        else 
        {
            show_404();
        }
    }    //Listar programación en modal operacion y mantenimiento
    public function listar_programacion_operacion_mantenimiento()
    {
        if ($this->input->is_ajax_request()) {
            $flat  = "listar_programacion_operacion"; //para listar en el modal
            $id_pi = $this->input->post("id_pi");
            $data  = $this->programar_pip_modal->listar_programacion_operacion_mantenimiento($flat, $id_pi);
            foreach ($data as $key => $value) 
            {
                $value->monto_opera_mant_prog = a_number_format($value->monto_opera_mant_prog, 2, '.',",",3);
            }
            echo json_encode(array('data' => $data)); 
        } 
        else 
        {
            show_404();
        }
    }
    //listar meta proyecto
    public function listar_metas_pi()
    {
        if ($this->input->is_ajax_request()) {
            $flat  = "R";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->programar_pip_modal->listar_metas_pi($flat, $id_pi);
            echo json_encode(array('data' => $data));
        } else {
            show_404();
        }
    }
    //eliminar metas pi
    public function Eliminar_meta_prepuestal_pi()
    {
        if ($this->input->is_ajax_request()) {
            $flat       = "D";
            $id_meta_pi = $this->input->post("id_meta_pi");
            if ($this->programar_pip_modal->Eliminar_meta_prepuestal($flat, $id_meta_pi) == true) {
                echo "Se Eliminó  ";
            } else {
                //echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }
    public function index()
    {
        $this->_load_layout('Front/Pmi/frmprogramarpip');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsProgramarPip.php');
    }
}
