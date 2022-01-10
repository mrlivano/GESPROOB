<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_EstadoPi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('ESTADO_CICLO_PI',$data);
        return $this->db->insert_id(); 
    }

    function ListaEstadoProyecto($idProyecto)
    {
        $data = $this->db->query("select * FROM ESTADO_CICLO c inner join ESTADO_CICLO_PI e on c.id_estado_ciclo=e.id_estado_ciclo where e.id_pi='$idProyecto' order by e.fecha_estado_ciclo_pi");

        return $data->result();
    }

    function eliminar($idEstado)
    {
        $this->db->where('id_estado_ciclo_pi', $idEstado);
        $this->db->delete('ESTADO_CICLO_PI');
        return $this->db->affected_rows();
    }

}
