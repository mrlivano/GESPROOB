<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Lista_Partida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ETListaPartidaPorDescListaPartida($valueSearch)
	{
		$data=$this->db->query("select ETEJ_Partida.Descripcion, ETEJ_Unidad.Descripcion AS Unidad, ETEJ_Partida.RendimientoMO FROM   ETEJ_Partida LEFT OUTER JOIN ETEJ_Unidad ON ETEJ_Partida.CodUnidad= ETEJ_Unidad.CodUnidad where replace(ETEJ_Partida.Descripcion, ' ', '') like '%'+replace('".$valueSearch."', ' ', '')+'%' ");

		return $data->result();
	}
}
?>