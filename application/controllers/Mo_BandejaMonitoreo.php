<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_BandejaMonitoreo extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Bandeja_Monitoreo');
    }

    function ListaMensajes()
    {
        $data = $this->Model_Mo_Bandeja_Monitoreo->get();
        foreach ($data as $key => $value) 
        {
            $value->fecha_registro = date('d/m/Y H:i',strtotime($value->fecha_registro));
        }
        echo json_encode($data);
        exit;
    }
    function editarBandeja()
    {
        $this->Model_Mo_Bandeja_Monitoreo->updateBandeja();
    }
}
