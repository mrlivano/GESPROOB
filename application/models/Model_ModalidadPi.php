<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_ModalidadPi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('MODALIDAD_EJECUCION_PI',$data);
        return $this->db->insert_id(); 
    }
    
    function ListaModalidadProyecto($idProyecto)
    {
        $data = $this->db->query("select * from MODALIDAD_EJECUCION_PI  me inner join MODALIDAD_EJECUCION m on me.id_modalidad_ejec=m.id_modalidad_ejec where me.id_pi='$idProyecto'");

        return $data->result();
    }

    function eliminar($idModalidad)
    {
        $this->db->where('id_modalidad_ejec_pi', $idModalidad);
        $this->db->delete('MODALIDAD_EJECUCION_PI');
        return $this->db->affected_rows();
    }

    function modalidadPorId($idModalidad)
    {
        $data = $this->db->query("select * from MODALIDAD_EJECUCION_PI where id_modalidad_ejec_pi='$idModalidad'");

        return $data->result();
    }

    function editar($data, $idModalidad)
    {
        $this->db->set($data);
		$this->db->where('id_modalidad_ejec_pi', $idModalidad);
		$this->db->update('MODALIDAD_EJECUCION_PI');
		return $this->db->affected_rows();
    }

}
