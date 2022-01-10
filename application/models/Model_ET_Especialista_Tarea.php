<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Especialista_Tarea extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($idPerReq, $idTareaET, $idEsp)
	{
		$this->db->query("execute sp_Gestionar_ETEspecialistaTarea_c @opcion='insertar', @idPerReq=$idPerReq, @idTareaET=$idTareaET, @idEsp=$idEsp");

		return true;
	}

	function ETEspecialistaTareaPorIdTareaET($idTareaET)
	{
		$data=$this->db->query("select etet.id_especialista_tarea, etet.id_per_req, etet.id_tarea_et, etet.id_esp, e.nombre_esp, e.descipcion_esp, etpr.id_persona, etpr.id_et, etpr.fecha_desig, etpr.craet from ET_ESPECIALISTA_TAREA as etet inner join ESPECIALIDAD as e on etet.id_esp=e.id_esp left join ET_PER_REQ as etpr on etet.id_per_req=etpr.id_per_req where etet.id_tarea_et=$idTareaET order by (e.nombre_esp)");

		return $data->result();
	}

	function ultimoETEspecialistaTarea()
	{
		$data=$this->db->query("select * from ET_ESPECIALISTA_TAREA where id_especialista_tarea=(select max(id_especialista_tarea) from ET_ESPECIALISTA_TAREA)");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function eliminar($idEspecialistaTarea)
	{
		$this->db->query("delete from ET_ESPECIALISTA_TAREA where id_especialista_tarea=$idEspecialistaTarea");

		return true;
	}

	function existeETPerReqPorIdTareaET($idPerReq, $idTareaET)
	{
		$data=$this->db->query("select * from ET_ESPECIALISTA_TAREA where id_per_req=$idPerReq and id_tarea_et=$idTareaET");

		return count($data->result())>0 ? true : false;
	}

	function asignarPersonal($idEspecialistaTarea, $idPerReq)
	{
		$this->db->query("execute sp_Gestionar_ETEspecialistaTarea_c @opcion='asignarPersonal', @idEspecialistaTarea=$idEspecialistaTarea, @idPerReq=$idPerReq");

		return true;
	}

	public function EspecialistaTareaPorIdTarea($idTareaET)
	{
		$data=$this->db->query("select * from ET_ESPECIALISTA_TAREA as ETESPT left join ET_PER_REQ as ETPR on ETESPT.id_per_req=ETPR.id_per_req left join PERSONA as P on ETPR.id_persona=P.id_persona left join ESPECIALIDAD as E on ETPR.id_esp=E.id_esp where ETESPT.id_tarea_et=$idTareaET order by (E.nombre_esp)");

		return $data->result();
	}

	public function EspecialistaTareaPorIdTareaYIdPersona($idTareaET, $idPersona)
	{
		$data=$this->db->query("select * from ET_ESPECIALISTA_TAREA as ETESPT left join ET_PER_REQ as ETPR on ETESPT.id_per_req=ETPR.id_per_req left join PERSONA as P on ETPR.id_persona=P.id_persona left join ESPECIALIDAD as E on ETPR.id_esp=E.id_esp where ETESPT.id_tarea_et=$idTareaET and P.id_persona=$idPersona order by (E.nombre_esp)");

		return count($data->result())==0 ? null : $data->result()[0];
	}
}