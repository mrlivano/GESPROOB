<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InformacionPresupuestal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FuenteFinanciamiento_Model');
        //$this->load->model('NivelGobierno_Model');

    }
    public function index()
    {
        $this->_load_layout('front/Administracion/frmInformacionPresupuestal');
    }

    //------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------
    public function _load_layout($template)
    {
        $this->load->view('layout/Administracion/header');
        $this->load->view($template);
        $this->load->view('layout/Administracion/footer');
    }

}
