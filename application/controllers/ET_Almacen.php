<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Almacen extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('Front/Ejecucion/ETAlmacen/index');
        $this->load->view('layout/Ejecucion/footer');
    }
}
