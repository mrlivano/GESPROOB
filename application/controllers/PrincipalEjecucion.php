<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrincipalEjecucion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function PrincipalEjec(){

        $this->_load_layout('Ejecucion');

    }

    public function _load_layout($template)
    {
        $this->load->view('layout/Ejecucion/header');
        $this->load->view($template);
        $this->load->view('layout/Ejecucion/footer');
    }

}
