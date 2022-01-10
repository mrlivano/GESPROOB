<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Per_Req extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($idPersona, $idEsp, $idET, $fechaDesign, $craet)
	{
		$this->db->query("exec sp_Gestionar_ETPERREQ_c @opcion='insertar', @idPersona=$idPersona, @idEsp=$idEsp, @idET=$idET, @fechaDesign=$fechaDesign, @craet=$craet");

		return true;
	}

	function ETPerReqPorIdET($idET)
	{
		$data=$this->db->query("select * from ET_PER_REQ as etpr inner join ESPECIALIDAD as e on etpr.id_esp=e.id_esp left join PERSONA as p on etpr.id_persona=p.id_persona where etpr.id_et=$idET order by (e.nombre_esp)");

		return $data->result();
	}

	function ETPerReqPorIdETParaAsignPersTarea($idET)
	{
		$data=$this->db->query("select etpr.id_per_req, etpr.id_persona, etpr.id_esp, etpr.id_et, etpr.fecha_desig, etpr.craet, e.nombre_esp, e.descipcion_esp, p.id_oficina, p.nombres, p.apellido_p, p.apellido_m, p.dni, p.direccion, p.telefonos, p.correo, p.grado_academico from ET_PER_REQ as etpr inner join ESPECIALIDAD as e on etpr.id_esp=e.id_esp inner join PERSONA as p on etpr.id_persona=p.id_persona where etpr.id_et=$idET order by (e.nombre_esp)");

		return $data->result();
	}

	function ultimoETPerReq()
	{
		$data=$this->db->query("select * from ET_PER_REQ where id_per_req=(select max(id_per_req) from ET_PER_REQ)");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function eliminar($idPerReq)
	{
		$this->db->query("delete from ET_PER_REQ where id_per_req=$idPerReq");

		return true;
	}

	function existePersonaPorET($idPersona, $idET)
	{
		$data=$this->db->query("select * from ET_PER_REQ where id_persona=$idPersona and id_et=$idET");

		return count($data->result())>0 ? true : false;
	}

	function asignarPersonal($idPerReq, $idPersona, $fechaDesign)
	{
		$this->db->query("exec sp_Gestionar_ETPERREQ_c @opcion='asignarPersonal', @idPerReq=$idPerReq, @idPersona=$idPersona, @fechaDesign='$fechaDesign'");

		return true;
	}

	function asignarQuitarCraet($idPerReq, $craet)
	{
		$this->db->query("exec sp_Gestionar_ETPERREQ_c @opcion='asignarQuitarCraet', @idPerReq=$idPerReq, @craet=$craet");

		return true;
	}

	function ETPerReqCraetPorIdETYIdPersona($idET, $idPersona)
	{
		$data=$this->db->query("select * from ET_PER_REQ where id_et=$idET and id_persona=$idPersona and craet=1");

		return count($data->result())==0 ? null : $data->result()[0];
	}
}