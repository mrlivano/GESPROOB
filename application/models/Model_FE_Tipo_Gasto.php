<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_FE_Tipo_Gasto extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ListarTipoGasto()
	{
		$listaTipoGast=$this->db->query("select * from FE_TIPO_GASTO");

	    return $listaTipoGast->result();
	}
}