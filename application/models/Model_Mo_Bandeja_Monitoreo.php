<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Bandeja_Monitoreo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('MO_BANDEJA_MONITOREO',$data);
		return $this->db->affected_rows();
	}

	function get()
	{
		$idPersona=$this->session->userdata('idPersona');
		$query = $this->db->query("select bm.mensaje,bm.fecha_registro,py.nombre_pi,bm.visto from  PROYECTO_INVERSION py inner join USUARIO_PROYECTO u inner join usuario us on us.id_persona=u.id_persona on py.id_pi=u.id_pi inner join MO_BANDEJA_MONITOREO bm on bm.id_pi = py.id_pi and u.id_persona = $idPersona and us.id_usuario_tipo=7 order by bm.fecha_registro desc");		
		return  $query->result();
	}

	function getNoleidos()
	{
		$idPersona=$this->session->userdata('idPersona');
		$query = $this->db->query("select bm.mensaje,bm.fecha_registro,py.nombre_pi,bm.visto from  PROYECTO_INVERSION py inner join USUARIO_PROYECTO u inner join usuario us on us.id_persona=u.id_persona on py.id_pi=u.id_pi inner join MO_BANDEJA_MONITOREO bm on bm.id_pi = py.id_pi and u.id_persona = $idPersona and us.id_usuario_tipo=7 and bm.visto=0");
		return  $query->result();
	}

	function updateBandeja()
	{
		$idPersona=$this->session->userdata('idPersona');
		$query = $this->db->query("update MO_BANDEJA_MONITOREO set visto=1 from  PROYECTO_INVERSION py inner join USUARIO_PROYECTO u inner join usuario us on us.id_persona=u.id_persona on py.id_pi=u.id_pi inner join MO_BANDEJA_MONITOREO bm on bm.id_pi = py.id_pi and u.id_persona = $idPersona and us.id_usuario_tipo=7");
	}

	function BandejaProyecto($idPi)
	{
		$query = $this->db->query("select * from mo_bandeja_monitoreo bm where bm.id_pi=$idPi order by bm.fecha_registro desc, bm.visto asc");
		return  $query->result();
	}
}