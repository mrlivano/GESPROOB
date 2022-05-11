<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Cronograma_Ejecucion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETCronogramaPorIdDetallePartida($idDetallePartida, $anio)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_EJECUCION where id_detalle_partida='$idDetallePartida' and anio='$anio'");

		return $data->result();
	}

	function ETCronogramaEjecucionPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_EJECUCION where id_detalle_partida='$idDetallePartida'");

		return $data->result();
	}

	function sumCantidadPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select sum(cantidad) as sumatoriaCantidad from ET_CRONOGRAMA_EJECUCION where id_detalle_partida=$idDetallePartida");

		return $data->result()[0]->sumatoriaCantidad;
	}

	function ETCronogramaPorIdDetallePartidaAndNumeroMes($idDetallePartida, $numeroMes, $anio)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_EJECUCION where id_detalle_partida='$idDetallePartida' and numero_mes='$numeroMes' and anio='$anio'");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function ETCronogramaPorIdDetallePartidaAnterior($idDetallePartida, $numeroMes, $anio)
	{
		$data=$this->db->query("select * from ET_CRONOGRAMA_EJECUCION where id_detalle_partida='$idDetallePartida' and numero_mes<'$numeroMes' and anio='$anio'");

		return $data->result();
	}

	function insertar($data)
	{
		$this->db->insert('ET_CRONOGRAMA_EJECUCION',$data);

		return $this->db->affected_rows();
	}

	function editar($id_cronograma, $data)
	{
		$this->db->set($data);

		$this->db->where('id_cronograma_valorizacion', $id_cronograma);

		$this->db->update('ET_CRONOGRAMA_EJECUCION');

		return $this->db->affected_rows();
	}
}