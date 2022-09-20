<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Detalle_Formatos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function getDetalleBy($idExpedienteTecnico, $anio, $meta, $sec_ejec, $mes)
	{
		$query=$this->db->query("select * from ET_DETALLE_FORMATO where id_et='$idExpedienteTecnico' and 
		meta ='$meta' and anio='$anio' and sec_ejec ='$sec_ejec' and mes ='$mes'");

		return $query->result();
	}

	function getDetalleAvanceMensual($idDatosG, $anio,  $mes)
	{
		$query=$this->db->query("select * from ET_INFORMECONTRATA where id_datosg='$idDatosG' and anio='$anio' and mes ='$mes'");

		return $query->result();
	}

	function getDetalleByAnio($idExpedienteTecnico, $anio, $meta, $sec_ejec)
	{
		$query=$this->db->query("select * from ET_DETALLE_FORMATO where id_et='$idExpedienteTecnico' and 
		meta ='$meta' and anio='$anio' and sec_ejec ='$sec_ejec'");

		return $query->result();
	}

	public function insertar($data)
	{
		$this->db->insert('ET_DETALLE_FORMATO',$data);

 		return $this->db->insert_id();
	}

	public function editar($idDetalleFormato, $data)
	{
		$this->db->set($data);
		$this->db->where('id_detalle', $idDetalleFormato);
		$this->db->update('ET_DETALLE_FORMATO');
		return $this->db->affected_rows();
	}

	public function insertarManoObra($data)
	{
		$this->db->insert('ET_CONTROL_MANO_OBRA',$data);

 		return $this->db->insert_id();
	}

	public function editarManoObra($idDetalleFormato,$semana, $data)
	{
		$this->db->set($data);
		$this->db->where('id_detalle', $idDetalleFormato);
		$this->db->where('nro_semana',$semana);
		$this->db->update('ET_CONTROL_MANO_OBRA');
		return $this->db->affected_rows();
	}

	function getManoObra($idDetalle)
	{
		$query=$this->db->query("select * from ET_CONTROL_MANO_OBRA where id_detalle='$idDetalle' order by nro_semana");

		return $query->result();
	}

	function sumatoriaManodeObra($idDetalle)
	{
		$query=$this->db->query("select sum(jornal_peon) as totalpeon, sum(jornal_oficial) as totaloficial, sum(jornal_operario) as totaloperario, sum(monto_peon) as montopeon, sum(monto_oficial) as montooficial, sum (monto_operario) as montooperario
		from ET_CONTROL_MANO_OBRA where id_detalle='$idDetalle'");

		return $query->result();
	}	
}
