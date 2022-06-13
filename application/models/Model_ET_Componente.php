<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Componente extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($idET, $descripcion,$idPresupuestoEjecucion)
	{
		$this->db->query("execute sp_Gestionar_ETComponente_c @Opcion='insertar',@idET='".$idET."',@descripcion= '".$descripcion."', @id_presupuesto_ej = $idPresupuestoEjecucion");

		return true;
	}

	function insertarComponente($data)
	{
		$this->db->insert('ET_COMPONENTE',$data);

		return $this->db->insert_id();
	}

	function insert($data)
	{
		$this->db->insert('ET_COMPONENTE',$data);

		return $this->db->affected_rows();
	}

	function ultimoId()
	{
		$data=$this->db->query("select max(id_componente) as idComponente from ET_COMPONENTE");

		return $data->result()[0]->idComponente;
	}

	public function ETComponentePorIdComponente($idComponente)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_componente=".$idComponente);

		return $data->result()[0];
	}

	public function ETComponentePorIdET($idExpedienteTecnico)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='".$idExpedienteTecnico."'");

		return $data->result();
	}

	public function ETComponentePorPresupuestoEstado($idExpedienteTecnico,$idPresupuestoEjecucion,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and id_presupuesto_ej='$idPresupuestoEjecucion' and estado='$estado'");
		
		return $data->result();
	}

	public function ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and estado='$estado' and id_presupuesto_ej=(select top 1 id_presupuesto_ej from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej='2' or desc_presupuesto_ej like 'ADMINISTRACION DIRECTA - COSTOS DIRECTOS')");
		
		return $data->result();
	}

	public function ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($idExpedienteTecnico,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and estado='$estado' and id_presupuesto_ej=(select top 1 id_presupuesto_ej from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej='1030' or desc_presupuesto_ej like 'ADMINISTRACION INDIRECTA - COSTOS DIRECTOS')");
		
		return $data->result();
	}

	public function ETComponentePorPresupuestoEstadoAdmDirecCostoIndirec($idExpedienteTecnico,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and estado='$estado' and id_presupuesto_ej=(select top 1 id_presupuesto_ej from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej='16' or desc_presupuesto_ej like 'ADMINISTRACION DIRECTA - COSTOS INDIRECTOS')");
		
		return $data->result();
	}

	public function ETComponentePorPresupuestoEstadoAdmIndirecCostoIndirec($idExpedienteTecnico,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and estado='$estado' and id_presupuesto_ej=(select top 1 id_presupuesto_ej from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej='1031' or desc_presupuesto_ej like 'ADMINISTRACION INDIRECTA - COSTOS INDIRECTOS')");
		
		return $data->result();
	}

	public function ETCostoIndirectoPorDescripcion($idExpedienteTecnico,$idPresupuestoEjecucion,$texto,$estado)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='$idExpedienteTecnico' and id_presupuesto_ej='$idPresupuestoEjecucion' and estado='$estado' and descripcion like '%".$texto."%'");
		
		return $data->result();
	}

	public function ETComponentePorIdETAndDescripcion($idExpedienteTecnico, $descripcion, $presupuesto)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_et='".$idExpedienteTecnico."' and id_presupuesto_ej=$presupuesto  and replace(descripcion, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $data->result();
	}

	function eliminar($idComponente)
	{
		$this->db->query("delete from ET_COMPONENTE where id_componente=".$idComponente);

		return true;
	}

	function editar($idComponente, $data)
	{
		$this->db->set($data);

		$this->db->where('id_componente', $idComponente);

		$this->db->update('ET_COMPONENTE');

		return $this->db->affected_rows();
	}

	function existsDiffIdComponenteAndSameDescripcion($idComponente, $descripcionComponente)
	{
		$data=$this->db->query("select * from ET_COMPONENTE where id_componente!=".$idComponente." and descripcion='".$descripcionComponente."'");

		return count($data->result())>0 ? true : false;
	}

	function updateDescComponente($idComponente, $descripcionComponente)
	{
		$this->db->query("update ET_COMPONENTE set descripcion='".$descripcionComponente."' where id_componente=".$idComponente);

		return true;
	}

	function updateMontoComponente($idComponente,$porcentaje, $montoComponente)
	{
		$this->db->query("update ET_COMPONENTE set monto='".$montoComponente."' , porcentaje='".$porcentaje."' where id_componente=".$idComponente);

		return true;
	}

	public function updateNumeracionPorIdComponente($idComponente, $numeracion)
	{
		$this->db->query("update ET_COMPONENTE set numeracion='".$numeracion."' where id_componente=".$idComponente);

		return true;
	}
}