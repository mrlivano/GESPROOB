<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PMI_RubroPi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('Model_RubroPi');
        $this->load->model('Model_RubroE');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $c_data['id_rubro']=$this->input->post('selectRubro');
            $c_data['id_pi']=$this->input->post('hdIdPI');
            $c_data['fecha_rubro_pi']=$this->input->post('txtFecha');
            $c_data['monto']=floatval(str_replace(",","",$this->input->post("txtMonto")));
            $data=$this->Model_RubroPi->insertar($c_data);
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }

        $idProyecto=$this->input->get('codigo');
        $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
        $rubro=$this->Model_RubroE->ListaRubro();
        $this->load->view('front/Pmi/ProyectoInversion/rubro', ['proyectoInversion'=>$proyectoInversion,'rubro'=>$rubro]);
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_RubroPi->eliminarRubroPi($this->input->post('id_rubro_pi'));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function ListaRubroProyecto()
    {
        if ($this->input->is_ajax_request())
        {
            $data=$this->Model_RubroPi->ListaRubroProyecto($this->input->post("id_pi"));
            foreach ($data as $key => $value)
            {
                $value->fecha_rubro_pi=date('d/m/Y',strtotime($value->fecha_rubro_pi));
                $value->monto= number_format($value->monto, 2, '.', ',');
            }
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }
}
