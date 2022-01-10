<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Detalle_Analitico_Partida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETDetalleAnaliticoPartidaPorIdAnaliticoPartida($idAnaliticoPartida)
	{
		$data=$this->db->query("select ETDAP.id_detalle_analitico_partida as id_detalle_analitico_partida, ETDAP.id_analitico_partida as id_analitico_partida, ETDAP.rendimiento as rendimiento, ETDAP.cuadrilla as cuadrilla, ETDAP.precio as precio, ETDAP.parcial as parcial, ETI.id_insumo as id_insumo, ETI.desc_insumo as desc_insumo, UM.id_unidad as id_unidad, UM.descripcion as descripcion from ET_DETALLE_ANALITICO_PARTIDA as ETDAP inner join ET_INSUMO as ETI on ETDAP.id_insumo=ETI.id_insumo inner join UNIDAD_MEDIDA as UM on ETI.id_unidad=UM.id_unidad where id_analitico_partida='".$idAnaliticoPartida."'");

		return $data->result();
	}
}