<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_NoPip extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('NOPIP',$data);
        return $this->db->insert_id(); 
    }

    function editar($data, $idNoPip)
    {
        $this->db->set($data);
		$this->db->where('id_nopip',$idNoPip);
		$this->db->update('NOPIP');
		return $this->db->affected_rows();
    }

}
