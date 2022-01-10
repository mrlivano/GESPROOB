<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UsuarioProyecto_model extends CI_Model {

    public function __construct()	
    {
        $this->load->database();
    }

    public function get_usuario_proyecto($id)
    {
        $data = $this->db->query("select * from USUARIO_PROYECTO where id_persona = $id");
        return $data->result();
    }

    public function ProyectoAsignado($idPi)
    {
        $idPersona=$this->session->userdata('idPersona');
        $data=$this->db->query("select * from USUARIO_PROYECTO where id_pi=$idPi and id_persona=$idPersona");
        return $data->result();
    }
}
