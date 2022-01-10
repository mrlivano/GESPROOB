<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_UsuarioControl extends CI_Model
{
	public function __construct()
	{
		parent::__construct();		
	}

	function insertar($data)
	{
		$this->db->insert('usuario_control',$data);
		return $this->db->affected_rows();
	}

	function editar($data,$id_persona)
	{
		$this->db->set($data);
		$this->db->where('id_persona', $id_persona);
		$this->db->update('usuario_control');
		return $this->db->affected_rows();
	}

	function getControlPorUsuario($id_persona)
	{
		$this->db->select('usuario_control.*');
		$this->db->where('id_persona',$id_persona);
		$this->db->from('usuario_control');
		return $this->db->get()->result();
	}

	function getAll()
	{
		$ue=$this->session->userdata('idUnidadEjecutora');
        $idPersona=$this->session->userdata('idPersona');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $q=$this->db->query("exec sp_Gestionar_Persona @opcion='lista_persona_ue',@ue=NULL");
            return $q->result();
        }
        if($tipoUsuario==1)
        {
            $q=$this->db->query("exec sp_Gestionar_Persona @opcion='lista_persona_ue',@ue=$ue");
            return $q->result();
        }
	}

	function getControlUsuario($idPersona)
	{
		$data = $this->db->query("select uc.id_persona,p.nombres+' '+p.apellido_p+' '+p.apellido_m as nombres,u.usuario,uc.desde,uc.hasta,uc.periodo,uc.hora_acceso from USUARIO u inner join PERSONA p ON p.id_persona=u.id_persona inner join usuario_control uc on uc.id_persona=u.id_persona and uc.id_persona=$idPersona");
		return  $data->result()[0];

	}
}