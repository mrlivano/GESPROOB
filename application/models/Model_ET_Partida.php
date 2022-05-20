<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Partida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertarPartida($data)
	{
		$this->db->insert('ET_PARTIDA',$data);

		return $this->db->insert_id();
	}

	function insertar($idMeta, $idUnidad, $idListaPartida, $descripcion, $rendimiento, $cantidad, $numeracion)
	{
		$data = array(
			'id_meta' => $idMeta,
			'id_unidad' => $idUnidad,
			'desc_partida' => $descripcion,
			'rendimiento' => $rendimiento,
			'cantidad' => $cantidad,
			'id_lista_partida' => $idListaPartida,
			'numeracion' => $numeracion
		);

		$this->db->insert('ET_PARTIDA',$data);
		
		return $this->db->affected_rows();		
	}

	function editar($idPartida, $data)
	{
		$this->db->set($data);

		$this->db->where('id_partida', $idPartida);

		$this->db->update('ET_PARTIDA');

		return $this->db->affected_rows();
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_partida) as idPartida from ET_PARTIDA");

		return $data->result()[0]->idPartida;
	}

	public function ETPartidaDetallePartidaPorIdMeta($idMeta)
	{
		$data=$this->db->query("select * from ET_PARTIDA ETP inner join ET_DETALLE_PARTIDA ETDP 
		on ETP.id_partida=ETDP.id_partida where ETP.id_meta='$idMeta'");

		return $data->result();
	}

	public function ETPartidaPorIdMeta($idMeta)
	{
		$data=$this->db->query("select ETP.id_partida, ETP.id_meta, ETP.desc_partida, ETP.rendimiento, ETP.cantidad, ETDP.id_detalle_partida, ETDP.especificacion_tecnica, ETDP.parcial, ETDP.precio_unitario, UM.id_unidad, UM.descripcion,ETP.numeracion from ET_PARTIDA as ETP inner join UNIDAD_MEDIDA as UM on ETP.id_unidad=UM.id_unidad left join ET_DETALLE_PARTIDA as ETDP on ETP.id_partida=ETDP.id_partida where id_meta='".$idMeta."'");

		return $data->result();
	}

	public function ETPartidaPorIdMetaAndDescPartida($idMeta, $descripcion)
	{
		$descripcion=str_replace("'", "", $descripcion);

		$data=$this->db->query("select * from ET_PARTIDA where id_meta='".$idMeta."' and replace(desc_partida, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $data->result();
	}

	function ETPartidaPorIdPartida($idPartida)
	{
		$data=$this->db->query("select * from ET_PARTIDA where id_partida=".$idPartida);

		return count($data->result())>0 ? $data->result()[0] : null;
	}

	function eliminar($idPartida)
	{
		$this->db->query("delete from ET_PARTIDA where id_partida=".$idPartida);

		return true;
	}

	function eliminarPorIdMeta($idMeta)
	{
		$this->db->query("delete from ET_PARTIDA where id_meta=".$idMeta);

		return true;
	}

	public function updateNumeracionPorIdPartida($idPartida, $numeracion)
	{
		$this->db->query("update ET_PARTIDA set numeracion='".$numeracion."' where id_partida=".$idPartida);

		return true;
	}

	public function updateCambiosPartida($idPartida,$nombre, $cantidad, $rendimiento)
	{
		$this->db->query("update ET_PARTIDA set desc_partida='$nombre', cantidad=$cantidad, rendimiento='$rendimiento' where id_partida=".$idPartida);

		return true;
	}

	public function EspecificacionPartidaPorMeta($idMeta)
	{
		$data=$this->db->query("select ETP.id_partida, ETP.id_meta, ETP.desc_partida,ETDP.id_detalle_partida, ETDP.especificacion_tecnica,ETP.numeracion 
		from ET_PARTIDA as ETP inner join ET_DETALLE_PARTIDA as ETDP on ETP.id_partida=ETDP.id_partida where id_meta='$idMeta'");
		return $data->result();
	}

	function mostrarPartidaPorIdMeta($idMeta)
	{
		$data=$this->db->query("select * from ET_PARTIDA where id_meta=".$idMeta);

		return $data->result();
	}
}