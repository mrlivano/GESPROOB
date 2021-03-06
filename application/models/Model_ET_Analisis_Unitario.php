<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Analisis_Unitario extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('ET_ANALISIS_UNITARIO',$data);
		return $this->db->insert_id();
	}

	function update($data,$idDetallePartida)
	{
		$this->db->set($data);
		$this->db->where('id_detalle_partida', $idDetallePartida);
		$this->db->update('ET_ANALISIS_UNITARIO');
		return $this->db->affected_rows();
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_analisis) as idAnalisis from ET_ANALISIS_UNITARIO");

		return $data->result()[0]->idAnalisis;
	}

	function ETAnalisisUnitarioPorIdDetalle($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO where id_detalle_partida=".$idDetallePartida);

		return $data->result();
	}

	function ETAnalisisUnitarioPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO as ETAU inner join ET_RECURSO as ETR on ETAU.id_recurso=ETR.id_recurso where id_detalle_partida=".$idDetallePartida);

		return $data->result();
	}

	function ETClasificadorPorIdDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO where id_detalle_partida='$idDetallePartida'");
		
		return $data->result();
	}

	function ETAnalisisUnitarioPorIdPartidaFromDetallePartida($idPartida)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO as etau inner join ET_DETALLE_PARTIDA as etdp on etau.id_detalle_partida=etdp.id_detalle_partida where etdp.id_partida=".$idPartida." and etau.id_analitico is null");

		return $data->result();
	}

	function ETAnalisisUnitarioPorIdDetallePartidaAndIdRecurso($idDetallePartida, $idRecurso)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO where id_detalle_partida=".$idDetallePartida." and id_recurso=".$idRecurso);

		return count($data->result())==0 ? null : $data->result()[0]; 
	}

	function eliminar($idAnalisis)
	{
		$this->db->query("delete from ET_ANALISIS_UNITARIO where id_analisis=".$idAnalisis);

		return true;
	}

	function eliminarAuPorMeta($idDetallePartida)
	{
		$this->db->where('id_detalle_partida',$idDetallePartida);
		$this->db->delete('ET_ANALISIS_UNITARIO');
		return $this->db->affected_rows();
	}

	function actualizarAnalitico($idAnalisis, $idAnalitico)
	{
		$this->db->query("update ET_ANALISIS_UNITARIO set id_analitico=".$idAnalitico." where id_analisis=".$idAnalisis);

		return true;
	}
	function listarEtAnalisisUnitario($id_analitico)
	{
		$this->db->query("select * from ET_ANALISIS_UNITARIO WHERE id_analitico=".$id_analitico);

		return true;
	}
	function insertarAnalisisCUS10($data)
	{
		$this->db->insert('ET_ANALISIS_CU_S10',$data);
		return $this->db->insert_id();
	}
	function listarCostoUnitario($id){
        $costoUnitario=$this->db->query("select* from S10_COSTO_UNITARIO where Id_Partida='".$id."' order by Tipo");
        return $costoUnitario->result();
    }
	function insertarCostoUnitario($id){
        $costoUnitario=$this->db->query("select* from ET_ANALISIS_CU_S10 where id_partida='".$id."' ");
        return $costoUnitario->result();
    }
	
	function eliminarCU($idPartida){
		$this->db->query("delete from ET_ANALISIS_CU_S10 where id_partida=".$idPartida);
		return true;
	}
}