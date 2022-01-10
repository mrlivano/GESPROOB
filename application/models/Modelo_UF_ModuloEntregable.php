<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modelo_UF_ModuloEntregable extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }
    public function LitsraEntregable($id_estudio_inv)
    {
        $data = $this->db->query("select * from UF_MODULO_ENTREGABLE where UF_MODULO_ENTREGABLE.id_est_inv='$id_estudio_inv'");
        return $data->result();
    }



}
