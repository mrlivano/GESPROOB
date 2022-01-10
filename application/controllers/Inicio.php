<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{

		$this->load->model('Model_Menu');

		$idPersona = $this->session->userdata('idPersona');

    $menuAll['resp'] = $this->Model_Menu->getMenuAll($idPersona);

		$this->load->view('Inicio',$menuAll);

	}

	function _load_layout($template)
    {
    	$this->load->view($template);
    }
}
