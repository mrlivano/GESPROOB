<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Programacion_Analitico extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function listarProgramacion($id_analitico, $fuenteFinanciamiento, $meta, $anio, $sec_ejec)
	{
		$data=$this->db->query("select * from ET_PROGRAMACION_ANALITICO where id_analitico='$id_analitico' and fuente_financ='$fuenteFinanciamiento' and meta='$meta' and anio='$anio' and sec_ejec='$sec_ejec'");

		return $data->result();
	}

	function insertar($data)
	{
		$this->db->insert('ET_PROGRAMACION_ANALITICO',$data);

		return $this->db->affected_rows();
	}

	function editar($data,$idProgramacion)
	{
		$this->db->set($data);		
		$this->db->where('id_programacion', $idProgramacion);
		$this->db->update('ET_PROGRAMACION_ANALITICO');
		return $this->db->affected_rows();
	}

	function sumatoriaProgramacion($idFuenteFinanciamiento, $meta, $anio, $sec_ejec)
	{
		$data=$this->db->query("select fuente_financ, meta, anio, sec_ejec, sum(monto) as total_fuente 
		from ET_PROGRAMACION_ANALITICO where fuente_financ='$idFuenteFinanciamiento' and meta='$meta' and anio='$anio' and sec_ejec='$sec_ejec'
		group by fuente_financ, meta, anio, sec_ejec");

		return $data->result();
	}

	function getProgramacionByMes($idEt, $meta, $anio, $sec_ejec, $idPresupuesto, $num_clasificador, $mes, $fuenteFinanciamiento)
	{
		$data=$this->db->query("select mes, sum(monto) as montomensual from ET_Manifiesto_Gasto where id_et='$idEt' and 
		meta='$meta' and anio='$anio' and sec_ejec='$sec_ejec' and id_presupuesto_ej='$idPresupuesto' and 
		numero_clasificador='$num_clasificador' and fuente_financ='$fuenteFinanciamiento'  and mes<='$mes' group by mes order by mes asc");

		return $data->result();
	}

	function gastoEjecutadoAcumulado($idEt, $meta, $anio, $sec_ejec, $mes)
	{
		$data=$this->db->query("select sum(monto) as gastoEjecutado from ET_Manifiesto_Gasto where id_et='$idEt' and 
		meta='$meta' and anio='$anio' and sec_ejec='$sec_ejec' and mes<='$mes'");
		return $data->result();
	}
}