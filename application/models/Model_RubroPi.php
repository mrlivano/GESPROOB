<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_RubroPi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('RUBRO_PI',$data);
        return $this->db->insert_id(); 
    }
    function ListaRubroProyecto($idProyecto)
    {
        $data = $this->db->query("select * from RUBRO_PI rp inner join RUBRO r on rp.id_rubro=r.id_rubro where id_pi='$idProyecto' order by fecha_rubro_pi ");

        return $data->result();
    }

    function eliminarRubroPi($idRubro)
    {
        $this->db->where('id_rubro_pi', $idRubro);
        $this->db->delete('RUBRO_PI');
        return $this->db->affected_rows();
    }

}
