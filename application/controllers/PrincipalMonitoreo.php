<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalMonitoreo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Bandeja_Monitoreo');

    }
   public function PrincipalMonitoreo()
    {
        $this->_load_layout('front/Monitoreo/PrincipalMonitoreo');
    }
    function _load_layout($template)
    {
        $mensajesNoLeidos = count($this->Model_Mo_Bandeja_Monitoreo->getNoleidos());
        $this->load->view('layout/MONITOREO/header',['mensajesNoLeidos'=>$mensajesNoLeidos]);
        $this->load->view($template);
        $this->load->view('layout/MONITOREO/footer');
    }
}
