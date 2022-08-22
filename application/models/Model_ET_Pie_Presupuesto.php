<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Pie_Presupuesto extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function PiePresupuestoPorIdETAll($idExpedienteTecnico)
	{
		$data=$this->db->query("select * from pie_presupuesto where id_et='".$idExpedienteTecnico."'");

		return $data->result();
	}

	public function PiePresupuestoPorIdET($idExpedienteTecnico)
	{
		$data=$this->db->query("select p.*, pe.gasto from pie_presupuesto p left join et_presupuesto_ejecucion pe on p.id_presupuesto_ej=pe.id_presupuesto_ej where p.id_et='".$idExpedienteTecnico."' and p.modalidad_ejecucion=1 order by p.orden");

		return $data->result();
	}

	public function PiePresupuestoPorIdETAdmInd($idExpedienteTecnico)
	{
		$data=$this->db->query("select p.*, pe.gasto from pie_presupuesto p left join et_presupuesto_ejecucion pe on p.id_presupuesto_ej=pe.id_presupuesto_ej where p.id_et='".$idExpedienteTecnico."' and p.modalidad_ejecucion=2 order by p.orden");

		return $data->result();
	}

	public function updatePresupuestoTotal($idExpedienteTecnico,$modalidad,$monto)
	{
		if ( $modalidad == 1 ){
			$this->db->set('costo_total_inv_et_ad', $monto);
			$this->db->set('costo_total_inv_et', 'case when costo_total_inv_et_ai is NULL then '.$monto.' else (CONVERT(DECIMAL(18,4), costo_total_inv_et_ai)+'.$monto.') end', FALSE);
		} else {
			$this->db->set('costo_total_inv_et_ai', $monto);
			$this->db->set('costo_total_inv_et', 'case when costo_total_inv_et_ad is NULL then '.$monto.' else (CONVERT(DECIMAL(18,4), costo_total_inv_et_ad)+'.$monto.') end', FALSE);
		}
		$this->db->where('id_et', $idExpedienteTecnico);
		$this->db->update('et_expediente_tecnico');

		return $this->db->affected_rows();
	}

	function buscar($id)
	{
		$this->db->select('PIE_PRESUPUESTO.*');
		$this->db->from('PIE_PRESUPUESTO');
		$this->db->where('PIE_PRESUPUESTO.id_pie_presupuesto',$id);
		return $this->db->get()->result();
	}

	function insertar($data)
	{
		$this->db->insert('PIE_PRESUPUESTO',$data);

		return $this->db->insert_id();
	}

	function editar($id, $data)
	{
		$this->db->set($data);

		$this->db->where('id_pie_presupuesto', $id);

		$this->db->update('PIE_PRESUPUESTO');

		return $this->db->affected_rows();
	}

	function eliminar($id)
	{
		$this->db->where('id_pie_presupuesto',$id);
		$this->db->delete('PIE_PRESUPUESTO');
		return $this->db->affected_rows();
	}

}