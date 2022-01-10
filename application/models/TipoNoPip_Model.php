<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TipoNoPip_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_tipo_no_pip()
    {
        $data = $this->db->query("select * FROM TIPO_NOPIP ORDER BY desc_tipo_nopip");
        return $data->result();
    }

    public function AddTipoNoPip($flat, $ID, $txt_DescripcionTipoNoPipa)
    {

        $this->db->query("execute sp_Gestionar_TipoNoPIP_c'"
            . $flat . "','"
            . $ID . "', '"
            . $txt_DescripcionTipoNoPipa . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function UpdateTipoNoPip($flat, $txt_IdTipoNoPipM, $txt_DescripcionTipoNoPipM)
    {

        $this->db->query("execute sp_Gestionar_TipoNoPIP_c'" . $flat . "','" . $txt_IdTipoNoPipM . "', '" . $txt_DescripcionTipoNoPipM . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function EliminarTipoNoPip($flat, $id_tipo_nopip)
    {

        $this->db->query("execute sp_Gestionar_TipoNoPIP_d'" . $flat . "',@id_tipo_nopip='"
            . $id_tipo_nopip . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

}
