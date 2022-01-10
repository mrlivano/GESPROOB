<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cargo_Modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getcargo()
    {
        $cargo = $this->db->query("select id_cargo,Desc_cargo from cargo order by desc_cargo");
        return $cargo->result();
    }

    public function EliminarCargo($id_cargo)
    {
        $this->db->where('id_cargo',$id_cargo);
        $this->db->delete('CARGO');
        if($this->db->affected_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addcargo($flat, $idcargo, $txt_nombrecargo)
    {
        $Cargo = $this->db->query("execute sp_Gestionar_Cargo_c'"
            . $flat . "','"
            . $idcargo . "','"
            . $txt_nombrecargo . "' "
        );
        if ($Cargo->num_rows() > 0)
        {
            return $Cargo->result();
        } 
        else 
        {
            return false;
        }
    }
    
    public function updatecargo($flat, $txt_idcargo_m, $txt_nombrecargo_m)
    {
        $Cargo = $this->db->query("execute sp_Gestionar_Cargo_c'"
            . $flat . "','"
            . $txt_idcargo_m . "','"
            . $txt_nombrecargo_m . "' "
        );
        if ($Cargo->num_rows() > 0) 
        {
            return $Cargo->result();
        } 
        else 
        {
            return false;
        }
    }
}
