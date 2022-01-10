<?php
defined('BASEPATH') or exit('No direct script access allowed');
class NaturalezaInversion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }

    public function get_NaturalezaInversion($flat, $ID, $txt_NombreNaturaleza)
    {
        $NaturalezaInversion = $this->db->query("execute sp_Gestionar_NaturalezaInversion'" . $flat . "','" . $ID . "', '" . $txt_NombreNaturaleza . "' ");
        if ($NaturalezaInversion->num_rows() > 0) {
            return $NaturalezaInversion->result();
        } else {
            return false;
        }
    }

    public function AddNaturalezaInversion($flat, $ID, $txt_NombreNaturaleza)
    {

        $this->db->query("execute sp_Gestionar_NaturalezaInversion_c'" . $flat . "','" . $ID . "', '" . $txt_NombreNaturaleza . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function UpdateNaturalezaInversion($flat, $txt_IdNaturalezaM, $txt_NombreNaturalezaM)
    {

        $this->db->query("execute sp_Gestionar_NaturalezaInversion_c'" . $flat . "','" . $txt_IdNaturalezaM . "', '" . $txt_NombreNaturalezaM . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function EliminarNaturalezaInversion($flat, $txt_IdNaturaleza, $txt_NombreNaturaleza)
    {

        $this->db->query("execute sp_Gestionar_NaturalezaInversion_d'" . $flat . "','" . $txt_IdNaturaleza . "', '" . $txt_NombreNaturaleza . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function ListaNaturalezaInversion()
    {
        $data = $this->db->query("select * from NATURALEZA_INVERSION order by nombre_naturaleza_inv");

        return $data->result();
    }

}
