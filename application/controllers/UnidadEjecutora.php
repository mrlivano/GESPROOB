<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadEjecutora extends CI_Controller {
	public function __construct(){
      parent::__construct();
	}
	public function index()
	{
		$this->_load_layout('Front/Administracion/frmUnidadEjecutora');
	}

	function _load_layout($template)
    {
      $this->load->view('layout/ADMINISTRACION/header');
      $this->load->view($template);
      $this->load->view('layout/ADMINISTRACION/footer');
    }
}
