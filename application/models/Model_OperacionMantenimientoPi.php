<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_OperacionMantenimientoPi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('OPERACION_MANTENIMIENTO_PI',$data);
        return $this->db->insert_id(); 
    }

    function ListaOperacionMantenimiento($idProyecto)
    {
        $data = $this->db->query("select * FROM OPERACION_MANTENIMIENTO_PI where id_pi='$idProyecto' order by fecha_registro");

        return $data->result();
    }

    function eliminar($idOperacion)
    {
        $this->db->where('id_operacion_mantenimiento_pi', $idOperacion);
        $this->db->delete('OPERACION_MANTENIMIENTO_PI');
        return $this->db->affected_rows();
    }
    
    public function getOperacionyMantenimiento($id_operacion_mantenimiento_pi)
    {
        $this->db->select('OPERACION_MANTENIMIENTO_PI.*');
        $this->db->from('OPERACION_MANTENIMIENTO_PI');
        $this->db->where('OPERACION_MANTENIMIENTO_PI.id_operacion_mantenimiento_pi ',$id_operacion_mantenimiento_pi);
        $query = $this->db->get();
        return $query->result()[0];

    }

}
