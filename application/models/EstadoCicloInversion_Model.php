<?php
defined('BASEPATH') or exit('No direct script access allowed');
class EstadoCicloInversion_MOdel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }
    public function get_EstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion)
    {
        //  $EstadoCicloInversion = $this->db->query("execute get");
        $EstadoCicloInversion = $this->db->query("execute SP_Gestionar_EstadoCiclo'" . $flat . "','" . $txt_IdEstadoCicloInversion . "', '" . $txt_NombreEstadoCicloInversion . "','" . $txt_DescripcionEstadoCicloInversion . "' ");
        if ($EstadoCicloInversion->num_rows() > 0) {
            return $EstadoCicloInversion->result();
        } else {
            return false;
        }
    }

    public function AddEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_c'" . $flat . "','" . $txt_IdEstadoCicloInversion . "', '" . $txt_NombreEstadoCicloInversion . "','" . $txt_DescripcionEstadoCicloInversion . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function EliminarEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_d'" . $flat . "','" . $txt_IdEstadoCicloInversion . "', '" . $txt_NombreEstadoCicloInversion . "','" . $txt_DescripcionEstadoCicloInversion . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function UpdateEstadoCicloInversion($flat, $txt_IdEstadoCicloInversionM, $txt_NombreEstadoCicloInversionM, $txt_DescripcionEstadoCicloInversionM)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_c'" . $flat . "','" . $txt_IdEstadoCicloInversionM . "', '" . $txt_NombreEstadoCicloInversionM . "','" . $txt_DescripcionEstadoCicloInversionM . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function listarEstadoCicloNombre()
    {

        $EstadoCicloInversion = $this->db->query("SELECT * FROM ESTADO_CICLO where nombre_estado_ciclo='IDEA' or nombre_estado_ciclo='FORMULACION Y EVALUACION'");
         return $EstadoCicloInversion->result();

    }

}
