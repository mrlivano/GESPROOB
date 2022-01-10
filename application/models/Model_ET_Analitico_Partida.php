<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Analitico_Partida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETAnaliticoPartidaPorIdListaPartida($idListaPartida)
	{
		$data=$this->db->query("select ETAP.id_analitico_partida as id_analitico_partida, ETAP.id_lista_partida as id_lista_partida, ETR.id_recurso as id_recurso, ETR.desc_recurso as desc_recurso from ET_ANALITICO_PARTIDA as ETAP inner join ET_RECURSO as ETR on ETAP.id_recurso=ETR.id_recurso where id_lista_partida='".$idListaPartida."'");

		return $data->result();
	}
}