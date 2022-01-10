<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PMI_MetaPresupuestalPi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('Model_MetaPresupuestalPi');
        $this->load->model('Model_MetaPresupuestal');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $c_data['id_meta_pres']=$this->input->post("selectMetaPresupuestal");
            $c_data['id_pi']=$this->input->post("hdIdPI");
            $c_data['id_correlativo_meta']=$this->input->post("cbx_Meta");
            $c_data['anio_meta_pres']=$this->input->post("txtAnio");
            $c_data['pia_meta_pres']=floatval(str_replace(",","",$this->input->post("txt_pia")));
            $c_data['pim_acumulado']=floatval(str_replace(",","",$this->input->post("txt_pim")));
            $c_data['certificacion_acumulado']=floatval(str_replace(",","",$this->input->post("txt_certificado")));
            $c_data['compromiso_acumulado']=floatval(str_replace(",","",$this->input->post("txt_compromiso")));
            $c_data['devengado_acumulado']=floatval(str_replace(",","",$this->input->post("txt_devengado")));
            $c_data['girado_acumulado']=floatval(str_replace(",","",$this->input->post("txt_girado")));

            $q1 = $this->Model_MetaPresupuestalPi->insertar($this->security->xss_clean($c_data));               
            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        if($_GET)
        {
            $idProyecto=$this->input->get('codigo');
            $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
            $metaPresupuestal=$this->Model_MetaPresupuestal->ListaMetaPresupuestal();
            $this->load->view('front/Pmi/ProyectoInversion/metapresupuestal', ['proyectoInversion'=>$proyectoInversion,'metaPresupuestal'=>$metaPresupuestal]);
        }        
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();
            $u_data['id_correlativo_meta']=$this->input->post("txtCorrelativo");
            $u_data['pia_meta_pres']=floatval(str_replace(",","",$this->input->post("txtPia")));
            $u_data['pim_acumulado']=floatval(str_replace(",","",$this->input->post("txtPim")));
            $u_data['certificacion_acumulado']=floatval(str_replace(",","",$this->input->post("txtCertificado")));
            $u_data['compromiso_acumulado']=floatval(str_replace(",","",$this->input->post("txtCompromiso")));
            $u_data['devengado_acumulado']=floatval(str_replace(",","",$this->input->post("txtDevengado")));
            $u_data['girado_acumulado']=floatval(str_replace(",","",$this->input->post("txtGirado")));
            $q1 = $this->Model_MetaPresupuestalPi->editar($this->security->xss_clean($u_data), $this->input->post("hdIdMetaPi"));               
            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        if($_GET)
        {
            $idMetaPresupuestal=$this->input->get('idMetaPresupuestal');
            $metaPi=$this->Model_MetaPresupuestalPi->MetaPresupuestalPorId($idMetaPresupuestal);    
            $metaPresupuestal=$this->Model_MetaPresupuestal->ListaMetaPresupuestal();
            $this->load->view('front/Pmi/ProyectoInversion/editarmetapresupuestal', ['metaPi'=>$metaPi,'metaPresupuestal'=>$metaPresupuestal]);
        }        
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_MetaPresupuestalPi->eliminar($this->input->post("idMetaPresupuestal"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
}
