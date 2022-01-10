<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ESTADO_CICLO_PI_MODEL extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();
        $this->load->helper('file');


    }
    public function Insertar_ciclo($data)
    {
          $this->db->insert('ESTADO_CICLO_PI', $data);
          return $this->db->affected_rows() > 0;
    }


}
