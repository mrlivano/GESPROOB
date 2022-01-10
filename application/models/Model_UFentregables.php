<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_UFentregables extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }
    public function LitarEntregable()
    {
        $data = $this->db->query("select * from UF_ENTREGABLE");
        return $data->result();
    }

     public function insertarEntregable($id_est_inv, $id_modulo, $id_entregable,$ValorEntregable)
    {
        $data = $this->db->query("select * from UF_ENTREGABLE");
        return $data->result();
    }



}
