<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Mes_Valorizacion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertarMesValorizacion($data)
	{
		$this->db->insert('ET_MES_VALORIZACION',$data);

		return $this->db->insert_id();
	}

	function insertar($idDetallePartida, $idValorizacion, $numeroMes, $cantidad, $precio)
	{
		$this->db->query("execute sp_Gestionar_ETMesValorizacion_c @opcion='insertar', @idDetallePartida=$idDetallePartida, @idValorizacion=$idValorizacion, @numeroMes=$numeroMes, @cantidad=$cantidad, @precio=$precio");

		return true;
	}

	function ETMesValorizacionPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_MES_VALORIZACION where id_detalle_partida='$idDetallePartida'");

		return $data->result();
	}

	function ETMesValorizacionPorIdDetallePartidaAndNumeroMes($idDetallePartida, $numeroMes)
	{
		$data=$this->db->query("select * from ET_MES_VALORIZACION where id_detalle_partida=$idDetallePartida and numero_mes=$numeroMes");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function editarCantidadYPrecio($idMesValorizacion, $cantidad, $precio)
	{
		$this->db->query("execute sp_Gestionar_ETMesValorizacion_c @opcion='editarCantidadYPrecio', @idMesValorizacion=$idMesValorizacion, @cantidad=$cantidad, @precio=$precio");

		return true;
	}

	function sumPrecioPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select sum(precio) as sumatoriaPrecio from ET_MES_VALORIZACION where id_detalle_partida=$idDetallePartida");

		return $data->result()[0]->sumatoriaPrecio;
	}
	function sumCantidadPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select sum(cantidad) as sumatoriaCantidad from ET_MES_VALORIZACION where id_detalle_partida=$idDetallePartida");

		return $data->result()[0]->sumatoriaCantidad;
	}
}