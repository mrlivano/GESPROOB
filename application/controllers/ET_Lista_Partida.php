<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Lista_Partida extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Lista_Partida');
	}

	public function verPorDescripcion()
	{
		$data=$this->Model_ET_Lista_Partida->ETListaPartidaPorDescListaPartida($this->input->post('valueSearch'));

		echo json_encode($data);exit;
	}
}