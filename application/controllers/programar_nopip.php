<?php
defined('BASEPATH') or exit('No direct script access allowed');

class programar_nopip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('programar_nopip_modal');
        $this->load->helper('FormatNumber_helper');
    }
    
    public function Get_no_pip()
    {
        if ($this->input->is_ajax_request())
        {
            $flat  = "LISTARNOPIP_PROGRAMACION";
            $datos = $this->programar_nopip_modal->Get_no_pip($flat);
            if(!$datos)
            {
                echo json_encode($datos);exit;
            }
            foreach ($datos as $key => $value)
            {
                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
            }
            echo json_encode($datos);exit;
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
            $flat                    = "programar_no_pip";
            $id_programacion         = "0";
            $Cbx_AnioCartera         = $this->input->post("Cbx_AnioCartera");
            $cbxBrecha               = $this->input->post("cbxBrecha");
            $txt_id_pip_programacion = $this->input->post("txt_id_pip_programacion");
            $txt_anio1               = floatval(str_replace(",", "", $this->input->post("txt_anio1")));
            $txt_anio2               = "0.00";
            $txt_anio3               = "0.00";
            $txt_prioridad           = floatval($this->input->post("txt_prioridad"));
            if ($this->programar_nopip_modal->AddProgramacion($flat, $id_programacion, $Cbx_AnioCartera, $cbxBrecha, $txt_id_pip_programacion, $txt_anio1, $txt_anio2, $txt_anio3, $txt_prioridad) == false)
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
    //Agregar META PRESUPUESTAL PI
    public function AddMeta_PI()
    {
        if ($this->input->is_ajax_request()) {
            $flat                       = "C";
            $id_meta_pi                 = "0";
            $txt_anio_meta              = $this->input->post("txt_anio_meta");
            $cbx_meta_presupuestal      = $this->input->post("cbx_meta_presupuestal");
            $txt_id_pip_programacion_mp = $this->input->post("txt_id_pip_programacion_mp");
            $cbx_Meta                   = $this->input->post("cbx_Meta");
            $txt_pia        = floatval(str_replace(",","",$this->input->post("txt_pia")));
            $txt_pim        = floatval(str_replace(",","",$this->input->post("txt_pim")));
            $txt_certificado       = floatval(str_replace(",","",$this->input->post("txt_certificado")));
            $txt_compromiso        = floatval(str_replace(",","",$this->input->post("txt_compromiso")));
            $txt_devengado       = floatval(str_replace(",","",$this->input->post("txt_devengado")));
            $txt_girado       = floatval(str_replace(",","",$this->input->post("txt_girado")));
            if ($this->programar_nopip_modal->AddMeta_PI($flat, $id_meta_pi, $txt_anio_meta, $cbx_meta_presupuestal, $txt_id_pip_programacion_mp, $cbx_Meta, $txt_pia, $txt_pim, $txt_certificado, $txt_compromiso, $txt_devengado, $txt_girado) == false) {
                echo "1";
            } else {
                echo "2";
            }

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
            $data  = $this->programar_nopip_modal->listar_programacion($flat, $id_pi);
            if($data == false)
            {
                echo json_encode(array('data' => $data));
            }
            else
            {
                foreach ($data as $key => $value)
                {
                    $value->monto_prog = a_number_format($value->monto_prog , 2, '.',",",3);
                }
                echo json_encode(array('data' => $data));
            }
        }
        else
        {
            show_404();
        }
    }
    //listar meta proyecto
    public function listar_metas_pi()
    {
        if ($this->input->is_ajax_request())
        {
            $flat  = "R";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->programar_nopip_modal->listar_metas_pi($flat, $id_pi);
            if($data == false)
            {
                echo json_encode(array('data' => $data));
            }
            else
            {
                foreach ($data as $key => $value)
                {
                    $value->pia_meta_pres = a_number_format($value->pia_meta_pres , 2, '.',",",3);
                    $value->pim_acumulado = a_number_format($value->pim_acumulado , 2, '.',",",3);
                    $value->certificacion_acumulado = a_number_format($value->certificacion_acumulado , 2, '.',",",3);
                    $value->compromiso_acumulado = a_number_format($value->compromiso_acumulado , 2, '.',",",3);
                    $value->devengado_acumulado = a_number_format($value->devengado_acumulado , 2, '.',",",3);
                    $value->girado_acumulado = a_number_format($value->girado_acumulado , 2, '.',",",3);
                }
                echo json_encode(array('data' => $data));
            }
        }
        else
        {
            show_404();
        }
    }
    public function EliminarMetaPI()
    {
        if ($this->input->is_ajax_request()) {
            $flat       = "D";
            $id_meta_pi = $this->input->post("id_meta_pi");
            if ($this->programar_nopip_modal->EliminarMetaPI($flat, $id_meta_pi) == false) {
                echo "Se elimino la entidad";
            } else {
                echo "Se elimino entidad";
            }

        } else {
            show_404();
        }
    }
    public function EliminarProgramacion()
    {
        if ($this->input->is_ajax_request()) {
            $flat       = "D";
            $id_pi      = $this->input->post("id_pi");
            $id_cartera = $this->input->post("id_cartera");
            if ($this->programar_nopip_modal->EliminarProgramacion($flat, $id_pi, $id_cartera) == false) {
                echo "Se elimino ";
            } else {
                echo "No Se elimino";
            }

        } else {
            show_404();
        }
    }

    public function index()
    {
        $this->_load_layout('Front/Pmi/frmprogramar_nopip');
    }
    public function _load_layout($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsProgramarNoPip.php');
    }

}
