<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expediente_Repositorio_Model extends CI_Model 
{
    function listaExpediente()
    {
        $query=$this->db->query("select * from REPOSITORIO_EXPEDIENTE order by codigo_unico");
        return $query->result();
    }

    function insertar($data)
    {
        $this->db->insert('REPOSITORIO_EXPEDIENTE',$data);
		return $this->db->insert_id();
    }
}
