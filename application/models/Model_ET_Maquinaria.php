<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Maquinaria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function MaquinariaPorIdEt($idExpedienteTecnico)
    {
        $query = $this->db->query("select * from ET_MAQUINARIA where id_et='$idExpedienteTecnico' order by tipo");

        return $query->result();
    }

    function MaquinariaPorDescripcion($idExpedienteTecnico, $placa)
    {
        $query = $this->db->query("select * from ET_MAQUINARIA where id_et='".$idExpedienteTecnico."' and nro_placa_motor='$placa'");

        return (count($query)>0 ? $query->result() : null);
    }

    function insertar($data)
    {
        $this->db->insert('ET_MAQUINARIA', $data);

		return $this->db->insert_id();
    }

    function editar($data, $idMaquinaria)
    {
        $this->db->set($data);

        $this->db->where('id_maquinaria', $idMaquinaria);
        
        $this->db->update('ET_MAQUINARIA');
        
		return $this->db->affected_rows();
    }

    function eliminar($idMaquinaria)
    {
        $this->db->where('id_maquinaria',$idMaquinaria);

        $this->db->delete('ET_MAQUINARIA');
        
		return $this->db->affected_rows();
    }

    function MaquinariaPorId($idMaquinaria)
    {
        $query = $this->db->query("select * from ET_MAQUINARIA where id_maquinaria='$idMaquinaria'");

        return $query->result();
    }

    function MaquinariaPorTipo($idExpedienteTecnico, $tipo)
    {
        $query = $this->db->query("select * from ET_MAQUINARIA where id_et='$idExpedienteTecnico' and tipo='$tipo'");

        return $query->result();
    }

}