<?php
defined('BASEPATH') or exit('No direct script access allowed');
class NivelGobierno_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_NivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno)
    {
        //  $NivelGobierno = $this->db->query("execute get");
        $NivelGobierno = $this->db->query("execute sp_Gestionar_NivelGobierno'" . $flat . "','" . $txt_IdNivelGobierno . "','" . $txt_NombreNivelGobierno . "' ");
        if ($NivelGobierno->num_rows() > 0) {
            return $NivelGobierno->result();
        } else {
            return false;
        }
    }

    public function AddNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno)
    {

        $this->db->query("execute sp_Gestionar_NivelGobierno_c'" . $flat . "','" . $txt_IdNivelGobierno . "', '" . $txt_NombreNivelGobierno . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function EliminarNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno)
    {

        $this->db->query("execute sp_Gestionar_NivelGobierno_d'" . $flat . "','" . $txt_IdNivelGobierno . "', '" . $txt_NombreNivelGobierno . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function UpdateNivelGobierno($flat, $txt_IdNivelGobiernoM, $txt_NombreNivelGobiernoM)
    {

        $this->db->query("execute sp_Gestionar_NivelGobierno_c'" . $flat . "','" . $txt_IdNivelGobiernoM . "', '" . $txt_NombreNivelGobiernoM . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function ListaNivelGobierno()
    {
        $data = $this->db->query("select * from NIVEL_GOBIERNO order by nombre_nivel_gob");

        return $data->result();
    }

}
