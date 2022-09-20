<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Recurso extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function RecursoListar($flat)
    {
        $ListarRecurso=$this->db->query("execute sp_Gestionar_Recurso'".$flat."'");

        return $ListarRecurso->result();
    }

    function insertar($flat,$txtDescripcion,$modalidad)
    {
        $recurso=$this->db->query("execute sp_Gestionar_Recurso_c @Opcion='".$flat."',@desc_recurso='".$txtDescripcion."',@modalidad='".$modalidad."'");
        return true;
    } 

    function Recurso($id)
    {
        $recurso=$this->db->query("select * from ET_RECURSO where id_recurso='".$id."' ");

        return $recurso->result();
    }

    function editar($flat,$id, $txtDescripcion,$modalidad)
    {
        $recurso=$this->db->query("execute sp_Gestionar_Recurso_c  @Opcion='".$flat."',@id_recurso='".$id."',@desc_recurso='".$txtDescripcion."',@modalidad='".$modalidad."'");

        return true;
    }

    function RecursoPorDescripcion($descripcion)
    {
        $recurso=$this->db->query("select * from ET_RECURSO where replace(desc_recurso, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $recurso->result();
    }

    function EtRecursoPorDescripcionDiffId($id, $descripcion)
    {
        $recurso=$this->db->query("select * from ET_RECURSO where id_recurso!='".$id."' and replace(desc_recurso, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $recurso->result();
    }

    function eliminar($flat,$id)
    {
        $recurso=$this->db->query("execute sp_Gestionar_Recurso_d  @Opcion='".$flat."',@id_recurso='".$id."'");
        return $recurso->result();
    }

}