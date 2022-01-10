<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Detalle_Analisis_Unitario extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertarDetalleAnalisisUnitario($data)
	{
		$this->db->insert('ET_DETALLE_ANALISIS_UNITARIO',$data);
		
		return $this->db->insert_id();
	}

	function insertar($idAnalisis, $idUnidad, $descripcionDetalleAnalisis, $cuadrilla, $cantidad, $precioUnitario, $rendimiento)
	{
		$data = array(
			'id_analisis' => $idAnalisis,
			'id_unidad' => $idUnidad,
			'desc_detalle_analisis' => $descripcionDetalleAnalisis,
			'cuadrilla' => $cuadrilla,
			'cantidad' => $cantidad,
			'precio_unitario' => $precioUnitario,
			'rendimiento' => $rendimiento
		);

		$this->db->insert('et_detalle_analisis_unitario',$data);
		
		return $this->db->insert_id();
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_detalle_analisis_u) as idDetalleAnalisisUnitario from ET_DETALLE_ANALISIS_UNITARIO");

		return $data->result()[0]->idDetalleAnalisisUnitario;
	}

	function ETDetalleAnalisisUnitarioPorId($idDetalleAnalisisUnitario)
	{
		$data=$this->db->query("select * from ET_DETALLE_ANALISIS_UNITARIO where id_detalle_analisis_u=".$idDetalleAnalisisUnitario);

		return $data->result();
	}

	function ETDetalleAnalisisPorIdAnalisis($idAnalisis)
	{
		$data=$this->db->query("select * from ET_DETALLE_ANALISIS_UNITARIO where id_analisis=".$idAnalisis);

		return $data->result();
	}

	function ETDetalleAnalisisUnitarioPorIdAnalisis($idAnalisis)
	{
		$data=$this->db->query("select * from ET_DETALLE_ANALISIS_UNITARIO as ETDAU left join UNIDAD_MEDIDA as UM on ETDAU.id_unidad=UM.id_unidad where id_analisis=".$idAnalisis);

		return $data->result();
	}

	public function ETDetalleAnalisisUnitarioPorIdAnalisisAndDescDetalleAnalisis($idAnalisis, $descripcion)
	{
		$descripcion=str_replace("'", "", $descripcion);

		$data=$this->db->query("select * from ET_DETALLE_ANALISIS_UNITARIO where id_analisis='".$idAnalisis."' and replace(desc_detalle_analisis, ' ', '')=replace('".$descripcion."', ' ', '')");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function eliminar($idDetalleAnalisisUnitario)
	{
		$this->db->query("delete from ET_DETALLE_ANALISIS_UNITARIO where id_detalle_analisis_u=".$idDetalleAnalisisUnitario);

		return true;
	}

	function ETDetallePartidaPorIdAnalisis($idAnalisis)
	{
		$data=$this->db->query("select * FROM ET_ANALISIS_UNITARIO AU INNER JOIN ET_DETALLE_PARTIDA DP 
		ON AU.id_detalle_partida=DP.id_detalle_partida AND AU.id_analisis='$idAnalisis'");

		return $data->result();
	}
}