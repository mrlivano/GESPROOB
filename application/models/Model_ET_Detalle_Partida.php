<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Detalle_Partida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertarDetallePartida($data)
	{
		$this->db->insert('ET_DETALLE_PARTIDA',$data);

		return $this->db->insert_id();
	}

	function insertar($idPartida, $idUnidad, $idEtapaET, $rendimiento, $cantidad, $precioUnitario, $estado)
	{
		$this->db->query("execute sp_Gestionar_ETDetallePartida_c 'insertar', ".$idPartida.", ".$idUnidad.", ".$idEtapaET.", '".$rendimiento."', ".$cantidad.", ".$precioUnitario.", ".$estado);

		return true;
	}
	function PartidaporAnalitico($idAnalisis)
	{
		$data=$this->db->query("select p.id_partida from ET_ANALISIS_UNITARIO au inner join ET_DETALLE_PARTIDA dp on au.id_detalle_partida=dp.id_detalle_partida inner join ET_PARTIDA p on dp.id_partida=p.id_partida where au.id_analisis=$idAnalisis");
		return $data->result()[0];
	}
	function partidaAnaliticoEt($idAnalisis)
	{
		$data=$this->db->query("select * from ET_ANALISIS_UNITARIO a inner join ET_DETALLE_PARTIDA dp on a.id_detalle_partida=dp.id_detalle_partida inner join ET_PARTIDA p on dp.id_partida = p.id_partida inner join unidad_medida um on um.id_unidad=dp.id_unidad where a.id_analisis = $idAnalisis");
		return $data->result()[0];
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_detalle_partida) as idDetallePartida from ET_DETALLE_PARTIDA");

		return $data->result()[0]->idDetallePartida;
	}
	function ultimoIdPartida($idPartida)
	{
		$data=$this->db->query("select max(id_detalle_partida) as idDetallePartida from ET_DETALLE_PARTIDA where id_partida=".$idPartida." and estado=1");

		return $data->result()[0]->idDetallePartida;
	}


	function ETDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_DETALLE_PARTIDA where id_detalle_partida=$idDetallePartida");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function ultimoETDetallePartida()
	{
		$data=$this->db->query("select * from ET_DETALLE_PARTIDA where id_detalle_partida=(select max(id_detalle_partida) from ET_DETALLE_PARTIDA) and estado=1");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function ETDetallePartidaPorIdPartidaAndIdEtapaET($idPartida, $idEtapaET)
	{
		$data=$this->db->query("select * from ET_DETALLE_PARTIDA where id_partida=".$idPartida." and id_etapa_et=".$idEtapaET." and estado=1");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function CostoDetallePartida($id_analitico)
	{
		$data=$this->db->query("select ET_ANALISIS_UNITARIO.id_analitico,sum(parcial) as costoDirecto from ET_ANALISIS_UNITARIO right  JOIN ET_DETALLE_PARTIDA ON 
								ET_ANALISIS_UNITARIO.id_detalle_partida=ET_DETALLE_PARTIDA.id_detalle_partida 
								WHERE   id_analitico='".$id_analitico."'  GROUP BY ET_ANALISIS_UNITARIO.id_analitico");
		return $data->result();
	}

	function ETDetallePartidaPorIdPartida($idPartida)
	{
		$data=$this->db->query("select * from ET_DETALLE_PARTIDA where id_partida=".$idPartida." and estado=1");

		return $data->result();
	}

	function ETDetallePartidaPorIdPartidaParaValorizacion($idPartida)
	{
		$data=$this->db->query("select * from ET_DETALLE_PARTIDA where id_partida=".$idPartida." and estado=1");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function ETDetallePartidaPorIdPartidaMontoff05($id_meta)
	{
		$data=$this->db->query("select sum (ET_DETALLE_PARTIDA.parcial)as parcial from ET_PARTIDA inner join ET_DETALLE_PARTIDA ON ET_PARTIDA.id_partida=ET_DETALLE_PARTIDA.id_partida where id_meta=".$id_meta." and estado=1");

		return $data->result();
	}

	function ETPDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select p.id_partida,dp.parcial,dp.id_detalle_partida, p.desc_partida, dp.precio_unitario,dp.cantidad from ET_PARTIDA p inner join ET_DETALLE_PARTIDA dp on p.id_partida= dp.id_partida where dp.id_detalle_partida=$idDetallePartida");
		return $data->result()[0];
	}

	public function updateCambiosDetallePartida($idPartida, $cantidad, $rendimiento, $precioUnitario )
	{
		$this->db->query("update ET_DETALLE_PARTIDA set cantidad=$cantidad, rendimiento = '$rendimiento', precio_unitario = $precioUnitario where id_partida=$idPartida");

		return true;
	}

	public function update($idDetallePartida,$data)
	{
		$this->db->set($data);
		$this->db->where('id_detalle_partida', $idDetallePartida);
		$this->db->update('ET_DETALLE_PARTIDA');
		return $this->db->affected_rows();
	}

	public function getDetallePartida($idDetallePartida)
	{
		$data=$this->db->query("select * from ET_PARTIDA P inner join ET_DETALLE_PARTIDA DP ON P.id_partida=dp.id_partida where dp.id_detalle_partida='$idDetallePartida'");

		return $data->result();
	}

	public function getPartidaPorDescripcion($texto, $idPartida)
	{
		$data=$this->db->query("select * from ET_PARTIDA P inner join ET_DETALLE_PARTIDA DP ON P.id_partida=dp.id_partida 
		where p.desc_partida like '%".$texto."%' and Dp.especificacion_tecnica IS NOT NULL AND P.id_partida <> '$idPartida'");

		return $data->result();
	}

	public function partidasEjecutada($idDetallePartida, $anio, $mes)
	{
		$data=$this->db->query("select sum(cantidad) as cantidad from det_seg_valorizacion where DATEPART(year, fecha_dia)='$anio' and DATEPART(month, fecha_dia)='$mes' and id_detalle_partida='$idDetallePartida' and (etapa_valorizacion='valorizacion' or etapa_valorizacion='mayor metrado')");
		return $data->result();
	}	
}