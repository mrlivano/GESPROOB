<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_MetaPresupuestalPi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('META_PRESUPUESTAL_PI',$data);
        return $this->db->insert_id(); 
    }

    function eliminar($idMetaPresupuestal)
    {
        $this->db->where('id_meta_pi', $idMetaPresupuestal);
        $this->db->delete('META_PRESUPUESTAL_PI');
        return $this->db->affected_rows();
    }

    function editar($data, $idMetaPresupuestal)
    {
        $this->db->set($data);
		$this->db->where('id_meta_pi', $idMetaPresupuestal);
		$this->db->update('META_PRESUPUESTAL_PI');
		return $this->db->affected_rows();
    }

    function MetaPresupuestalPorId($idMetaPresupuestal)
    {
        $query=$this->db->query("select * from META_PRESUPUESTAL_PI where id_meta_pi='$idMetaPresupuestal'");        
        return $query->result();
    }

    function MetaPresupuestalPorAnioIdPi($anio,$idPi)
    {
        $query=$this->db->query("select * from META_PRESUPUESTAL_PI where id_pi='$idPi' and DATEPART(year,anio_meta_pres)='$anio'");        
        return $query->result();
    }
}
