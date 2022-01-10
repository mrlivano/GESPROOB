<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Presupuesto_Ejecucion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertar($data)
    {
        $this->db->insert('ET_PRESUPUESTO_EJECUCION',$data);

		return $this->db->insert_id();
    }

    function PresupuestoEjecucionListar($flat)
    {
        $ListarPresupuestoEjecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion'".$flat."'");

        return $ListarPresupuestoEjecucion->result();
    }

    function ListaPresupuestoEjecucion()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion  where id_presupuesto_ej_padre is NULL");

        return $presupuesto->result();
    }

     function PresupuestoEjPorIdPadre($id_presupuesto_ej_padre)
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion  where id_presupuesto_ej_padre=$id_presupuesto_ej_padre");

        return $presupuesto->result();
    }

    // function insertar($flat,$txtDescripcion)
    // {
        
    //     $PresupuestoEjecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion_c @Opcion='".$flat."',@desc_presupuesto_ej='".$txtDescripcion."'");

    //     return true;
    // }

    function PresupuestoEjecucion($id)
    {
        $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej='".$id."' ");

        return $presupuestoejecucion->result();
    }

    function editar($flat,$id,$txtDescripcion)
    {
        $presupuestoejecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion_c  @Opcion='".$flat."',@id_presupuesto_ej='".$id."',@desc_presupuesto_ej='".$txtDescripcion."'");

        return true;
    }

    function EtPresupuestoEjecucionPorDescripcion($descripcion)
    {
        $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where replace(desc_presupuesto_ej, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $presupuestoejecucion->result();
    }
    function EtPresupuestoEjecucionPorDescripcionDiffId($id, $descripcion)
    {
        $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej!='".$id."' and replace(desc_presupuesto_ej, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $presupuestoejecucion->result();
    }
    
    function eliminar($flat,$id)
    {
        $presupuestoejecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion_d  @Opcion='".$flat."',@id_presupuesto_ej='".$id."'");
        return $presupuestoejecucion->result();
    }

}