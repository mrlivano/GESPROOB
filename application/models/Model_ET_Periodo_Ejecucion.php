<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Periodo_Ejecucion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function listaPlazoEjecucion($id_Et)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et=$id_Et order by estado desc,fecha_fin desc");
		return  $query->result();
	}
	function listaPlazoEjecucionAnio($id_Et,$anio)
	{
		$query=$this->db->query("select MES.id, MES.num, MES.mes from ET_TIEMPO_EJECUCION INNER JOIN MES on ((MES.id BETWEEN MONTH(fecha_inicio) and  MONTH(fecha_fin)) or (YEAR(fecha_fin)>YEAR(fecha_inicio) and ( (YEAR(fecha_inicio)='$anio'and mes.id between month(fecha_inicio) and 12) or (YEAR(fecha_fin)='$anio'and mes.id between 1 and month(fecha_fin))))) where id_et='$id_Et' and (YEAR(fecha_inicio)='$anio' or YEAR(fecha_fin)='$anio') group by MES.id,MES.num,MES.MES order by MES.id asc");
		return  $query->result();
	}
	function listaAnioPlazoEjecucion($id_Et)
	{
		$query=$this->db->query("select YEAR(fecha_inicio) as anio from ET_TIEMPO_EJECUCION  where id_et='$id_Et' UNION select YEAR(fecha_fin) as anio from ET_TIEMPO_EJECUCION  where id_et='$id_Et'");
		return  $query->result();
	}

	function plazoEjecucion($idExpedienteTecnico, $tipo)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et=$idExpedienteTecnico and tipo='$tipo' order by fecha_inicio asc ");
		
		return  $query->result();
	}

	function insertar($data)
	{
		$this->db->insert('ET_TIEMPO_EJECUCION',$data);
		return $this->db->affected_rows();
	}

	function editarEstado($data,$idET)
	{
		$this->db->set($data);
		$this->db->where('id_et', $idET);
		$this->db->update('ET_TIEMPO_EJECUCION');
		return $this->db->affected_rows();
	}

	function plazoPorDescripcion($idEt, $descripcion)
	{
		$query=$this->db->query("select * from ET_TIEMPO_EJECUCION where id_et='$idEt' and tipo='$descripcion' order by fecha_inicio");
		
		return  $query->result();
	}

	function plazoValidar($idEt, $periodo_inicial, $periodo_final)
	{
		$query=$this->db->query("select * from et_tiempo_ejecucion where ((fecha_inicio <= '$periodo_inicial' and fecha_fin>='$periodo_inicial') or (fecha_inicio <= '$periodo_final' and fecha_fin>='$periodo_final')) and id_et='$idEt'");
		
		return  $query->result();
	}

	function eliminar($idPeriodo)
    {
        $this->db->where('id_tiempo_ejecucion',$idPeriodo);
        $this->db->delete('ET_TIEMPO_EJECUCION');
        return $this->db->affected_rows();
    }
}