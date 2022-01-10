<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Tipo_Responsable extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
   
    function insertar($flat,$txtDescripcion)
    {
        
        $TipoResponsable=$this->db->query("execute sp_Gestionar_ET_Tipo_Responsable_c @Opcion='".$flat."',@desc_tipo_responsable_et='".$txtDescripcion."'");

        return true;
    }

    function TipoResponsableListar($flat)
    {
        $data=$this->db->query("execute sp_Gestionar_ET_Tipo_Responsable'".$flat."'");

        return $data->result();
    }

    function TipoResponsable($id)
    {
        $data=$this->db->query("select * from ET_TIPO_RESPONSABLE where id_tipo_responsable_et='".$id."' ");

        return $data->result();
    }

    function editar($flat,$id,$txtDescripcion)
    {
        $presupuestoejecucion=$this->db->query("execute sp_Gestionar_ET_Tipo_Responsable_c  @Opcion='".$flat."',@id_tipo_responsable_et='".$id."',@desc_tipo_responsable_et='".$txtDescripcion."'");

        return true;
    }

    function NombreTipoResponsable($desc_tipo_responsable_et)
    {
        $data=$this->db->query("select * from ET_TIPO_RESPONSABLE where codigo_tipo_responsable_et='".$desc_tipo_responsable_et."'");

        return $data->result();
    }
}