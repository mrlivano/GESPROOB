<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Tipo_Gasto extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function TipoGastoAnaliticoListar($flat)
    {
        $ListarTipoGastoAnalitico=$this->db->query("sp_Gestionar_Et_Tipo_Gasto'".$flat."'");

        return $ListarTipoGastoAnalitico->result();
    }

    function insertar($flat,$txtDescripcion)
    {
        $tipogastoanalitico=$this->db->query("sp_Gestionar_Et_Tipo_Gasto_c @Opcion='".$flat."',@desc_tipo_gasto='".$txtDescripcion."'");

        return true;
    } 

    function TipoGastoAnalitico($id)
    {
        $tipogastoanalitico=$this->db->query("select * from ET_TIPO_GASTO where id_tipo_gasto='".$id."' ");

        return $tipogastoanalitico->result();
    }

    function editar($flat,$id,$txtDescripcion)
    {
        $tipogastoanalitico=$this->db->query("sp_Gestionar_Et_Tipo_Gasto_c  @Opcion='".$flat."',@id_tipo_gasto='".$id."',@desc_tipo_gasto='".$txtDescripcion."'");

        return true;
    }
    
    function EtTipoGastoPorDescripcion($descripcion)
    {
        $tipogastoanalitico=$this->db->query("select * from ET_TIPO_GASTO where replace(desc_tipo_gasto, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $tipogastoanalitico->result();
    }

    function EtTipoGastoPorDescripcionDiffId($id, $descripcion)
    {
        $tipogastoanalitico=$this->db->query("select * from ET_TIPO_GASTO where id_tipo_gasto!='".$id."' and replace(desc_tipo_gasto, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $tipogastoanalitico->result();
    }

}