<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CostosReferenciales extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->model('Model_CostosReferenciales');
	}

    public function index()
	{
		$listaCostosReferenciales=$this->Model_CostosReferenciales->lista();
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/CostosReferenciales/index.php',['listaCostosReferenciales'=>$listaCostosReferenciales]);
		$this->load->view('layout/Ejecucion/footer');
	}

}
