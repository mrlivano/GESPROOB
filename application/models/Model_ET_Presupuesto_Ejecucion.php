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
    function listarPresupuesto($codigoProyecto){
        $selectPresupuesto=$this->db->query("select * from S10_PRESUPUESTO where Codigo_Proyecto='".$codigoProyecto."'");
        return $selectPresupuesto->result();
    }
    function listarComponente($codigoProyecto,$CodigoPresupuesto){
        $selectSubPresupuesto=$this->db->query("select * from S10_COMPONENTE where Codigo_Proyecto='".$codigoProyecto."' and Codigo_Presupuesto='".$CodigoPresupuesto."'");
        return $selectSubPresupuesto->result();
    }
    function listarComponentePresupuestoEj($Id_Presupuesto_Ej){
        $selectComponentePresupuesto=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej_padre = '".$Id_Presupuesto_Ej."'");
        return $selectComponentePresupuesto->result();
    }
    function listarMetaSubpresupuesto($id){
        $metaSubpresupuesto=$this->db->query("select * from S10_META_PARTIDA where Id_Subpresupuesto='".$id."' ");
        return $metaSubpresupuesto->result();
    }
    function totalSubpresupuesto($id){
        $sumSubpresupuesto=$this->db->query("select sum(parcial) as sum from S10_META_PARTIDA where  Cod_Partida!='999999999999' and Id_Subpresupuesto='".$id."' ");
        return $sumSubpresupuesto->result()[0]->sum;
    }
    function ListaPresupuestoEjecucion()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion  where id_presupuesto_ej_padre is NULL");

        return $presupuesto->result();
    }

    function ListaPresupuestoEjecucionAdmDirecta()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion  where id_presupuesto_ej = 16");

        return $presupuesto->result();
    }
    function ListaPresupuestoEjecucionCostosDirectos()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion where id_presupuesto_ej_padre = (select top 1 id_presupuesto_ej  from ET_PRESUPUESTO_EJECUCION where desc_presupuesto_ej like '%ADMINISTRACION DIRECTA - COSTOS INDIRECTOS%' or id_presupuesto_ej='16') ");

        return $presupuesto->result();
    }
    function ListaPresupuestoEjecucionCostoIndirecto()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion where id_presupuesto_ej_padre = (select top 1 id_presupuesto_ej  from ET_PRESUPUESTO_EJECUCION where desc_presupuesto_ej like '%ADMINISTRACION DIRECTA - COSTOS INDIRECTOS%' or id_presupuesto_ej='16') ");

        return $presupuesto->result();
    }
    function ListaPresupuestoEjecucionAdmIndCostoIndirecto()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion where id_presupuesto_ej_padre = (select top 1 id_presupuesto_ej  from ET_PRESUPUESTO_EJECUCION where desc_presupuesto_ej like '%ADMINISTRACION INDIRECTA - COSTOS INDIRECTOS%' or id_presupuesto_ej='2036') ");

        return $presupuesto->result();
    }
    function ListaPresupuestoEjecucionAdmInCostoDirecto()
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion where id_presupuesto_ej_padre = (select top 1 id_presupuesto_ej  from ET_PRESUPUESTO_EJECUCION where desc_presupuesto_ej like '%ADMINISTRACION INDIRECTA - COSTOS DIRECTOS TOTAL%') and (desc_presupuesto_ej like '%GASTOS GENERALES%'  or desc_presupuesto_ej like '%UTILIDAD%'  or desc_presupuesto_ej like '%IGV%')");

        return $presupuesto->result();
    }
    function siExiste($id_et,$descripcion)
    {
        $existe=$this->db->query("select count(*) as existe from ET_COMPONENTE where descripcion like '%".$descripcion."%' and id_et='".$id_et."'");

        return $existe->result();
    }

    function ListaPresupuestoEjecucionCostoDirecto($presupuesto)
    {
        $presupuesto=$this->db->query("select * from et_presupuesto_ejecucion  where id_presupuesto_ej_padre is NULL and (desc_presupuesto_ej like '%COSTOS DIRECTOS%' or desc_presupuesto_ej like '%COSTO DIRECTO%') and ((desc_presupuesto_ej like '%$presupuesto%' and '$presupuesto'!='ADMINISTRACION MIXTA') or '$presupuesto'='ADMINISTRACION MIXTA')");

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

    function editar($flat,$id,$txtDescripcion,$repositorio,$gasto)
    {
        $presupuestoejecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion_c  @Opcion='".$flat."',@id_presupuesto_ej='".$id."',@desc_presupuesto_ej='".$txtDescripcion."',@repositorio='".$repositorio."',@gasto='".$gasto."'");

        return true;
    }

    function EtPresupuestoEjecucionPorDescripcion($descripcion,$idPadre)
    {
        if($idPadre==''){
            $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where replace(desc_presupuesto_ej, ' ', '')=replace('".$descripcion."', ' ', '') and id_presupuesto_ej_padre is NULL");

        }
        else{
            $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where replace(desc_presupuesto_ej, ' ', '')=replace('".$descripcion."', ' ', '') and id_presupuesto_ej_padre='".$idPadre."'");

        }
      
        return $presupuestoejecucion->result();
    }
    function EtPresupuestoEjecucionPorDescripcionDiffId($id, $descripcion, $id_padre)
    {
        $presupuestoejecucion=$this->db->query("select * from ET_PRESUPUESTO_EJECUCION where id_presupuesto_ej!='".$id."' and id_presupuesto_ej_padre='".$id_padre."' and replace(desc_presupuesto_ej, ' ', '')=replace('".$descripcion."', ' ', '')");

        return $presupuestoejecucion->result();
    }
    
    function eliminar($flat,$id)
    {
        $presupuestoejecucion=$this->db->query("execute sp_Gestionar_ET_Presupuesto_Ejecucion_d  @Opcion='".$flat."',@id_presupuesto_ej='".$id."'");
        return $presupuestoejecucion->result();
    }

}