<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Manifiesto_Gasto extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('ET_Manifiesto_Gasto',$data);
		return $this->db->affected_rows();
	}

	function editar($data, $idManifiesto)
	{
		$this->db->set($data);
		$this->db->where('ET_Manifiesto_Gasto.id_manifiestoGasto',$idManifiesto);
		$this->db->update('ET_Manifiesto_Gasto');
		return $this->db->affected_rows();
	}

	function getManifiestoGasto($expedientesiaf, $meta, $anio, $id_et)
	{
		$this->db->select('ET_Manifiesto_Gasto.*');
		$this->db->from('ET_Manifiesto_Gasto');
		$this->db->where('ET_Manifiesto_Gasto.expediente_siaf',$expedientesiaf);
		$this->db->where('ET_Manifiesto_Gasto.meta',$meta);
		$this->db->where('ET_Manifiesto_Gasto.anio',$anio);
		$this->db->where('ET_Manifiesto_Gasto.id_et',$id_et);
		return $this->db->get()->result();
	}

	function getManifiestoGastoById($idManifiesto)
	{
		$this->db->select('ET_Manifiesto_Gasto.*');
		$this->db->from('ET_Manifiesto_Gasto');
		$this->db->where('ET_Manifiesto_Gasto.id_manifiestoGasto',$idManifiesto);
		return $this->db->get()->result();
	}
}