<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Insumo_Valorizacion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ETValorizacionPorRelacionInsumo($idRelacionInsumo)
	{
		$data=$this->db->query("select * from ET_INSUMO_VALORIZACION where id_relacion_insumo='$idRelacionInsumo'");

		return $data->result();
	}

	function ETValorizacionPorRecursoInsumo($idRecursoInsumo)
	{
		$data=$this->db->query("select * from ET_INSUMO_VALORIZACION where id_recurso_insumo='$idRecursoInsumo'");

		return $data->result();
	}

	function ETMesValorizacionPorIdDetallePartidaAndNumeroMes($idRelacionInsumo,$numeroMes)
	{
		$data=$this->db->query("select * from ET_INSUMO_VALORIZACION where id_relacion_insumo='$idRelacionInsumo' and numero_mes='$numeroMes'");

		return $data->result();
	}

	function insertar($data)
	{
		$this->db->insert('ET_INSUMO_VALORIZACION',$data);

		return $this->db->affected_rows();
	}

	function editar($data,$idInsumoValorizacion)
	{
		$this->db->set($data);

		$this->db->where('id_insumo_valorizacion', $idInsumoValorizacion);

		$this->db->update('ET_INSUMO_VALORIZACION');

		return $this->db->affected_rows();
	}

	function sumatoriaValorizacionRecurso($idRelacionInsumo)
	{
		$data=$this->db->query("select r.cantidad, sum(v.cantidad) sumatoria from ET_RELACION_INSUMO r inner join ET_INSUMO_VALORIZACION v 
		on r.id_relacion_insumo=v.id_relacion_insumo where v.id_relacion_insumo='$idRelacionInsumo' group by r.cantidad");

		return $data->result();
	}
}