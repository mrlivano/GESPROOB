<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_FE_Presupuesto_Inv extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function ListarPresupuesto($idEstInv)
    {
        $presupuestoInv=$this->db->query("execute sp_FEPresupuestoInv_Listar ".$idEstInv.""); 

        return $presupuestoInv->result();
    }

    function insertar($cbx_estudioInversion , $txtSector , $txtPliego)
    {
        $this->db->query("execute sp_FEPresupuestoInv_c '".$cbx_estudioInversion."','".$txtSector."','".$txtPliego."'");
        
        return true;
    }

    function EditarPorcentajeImprevistos($idPresupuestoFE , $porcentajeImprevistos)
    {
        $this->db->query("update FE_PRESUPUESTO_INV set porcentaje_imprevistos='".$porcentajeImprevistos."' where id_presupuesto_fe=".$idPresupuestoFE);
        
        return true;
    }

    function FEPresupuestoInvParaEditar($id)
    {
        $fePresupuestoInv=$this->db->query("select FEPI.id_est_inv, FEPI.id_presupuesto_fe, EI.nombre_est_inv, S.id_sector, FEPI.pliego from FE_PRESUPUESTO_INV as FEPI inner join SECTOR as S on FEPI.id_sector=S.id_sector inner join ESTUDIO_INVERSION as EI on FEPI.id_est_inv=EI.id_est_inv where id_presupuesto_fe='".$id."'");

        return $fePresupuestoInv->result()[0];
    }

    function FEPresupuestoInvPorIdPresupuestoFE($id)
    {
        $fePresupuestoInv=$this->db->query("select FEPI.id_est_inv, FEPI.porcentaje_imprevistos, FEPI.monto_imprevistos, FEPI.sub_total_presupuesto, FEPI.total_presupuesto, FEPI.id_presupuesto_fe, EI.nombre_est_inv, S.id_sector, FEPI.pliego from FE_PRESUPUESTO_INV as FEPI inner join SECTOR as S on FEPI.id_sector=S.id_sector inner join ESTUDIO_INVERSION as EI on FEPI.id_est_inv=EI.id_est_inv where id_presupuesto_fe='".$id."'");

        return $fePresupuestoInv->result()[0];
    }

    function editar($idPresupuestoFE, $idSector, $txtPliego)
    {
        $fePresupuestoInv=$this->db->query("update FE_PRESUPUESTO_INV set id_sector='".$idSector."', pliego='".$txtPliego."' where id_presupuesto_fe='".$idPresupuestoFE."'");

        return true;
    }

    function FEPresupuestoFuenteEliminarPorIdPresupuestoFE($idPresupuestoFE)
    {
        $this->db->query("delete from FE_PRESUPUESTO_FUENTE where id_presupuesto_fe='".$idPresupuestoFE."'");

        return true;
    }

    function insertarPresupuestoFuente($id_presupuesto_fe,$id_fuente_finan,$hdCorrelativoMeta,$hdAnio)
    {
        $this->db->query("execute sp_FEPrespuestoFuente_c '".$id_presupuesto_fe."','".$id_fuente_finan."','".$hdCorrelativoMeta."','".$hdAnio."'");
        
        return true;
    }

    function ultimoIdPresupuestoInv()
    {
        $presupuestoInv=$this->db->query("SELECT MAX(id_presupuesto_fe) AS id FROM FE_PRESUPUESTO_INV");
        
        return $presupuestoInv->result()[0];
    }

    function listarSector()
    {
        $listarSector=$this->db->query("execute sp_Sector_r");
        
        return $listarSector->result();            
    }

    function listarFEPresupuestoFuente($idPresupuestoFE)
    {

        $listaFEPresupuestoFuente=$this->db->query("select id_presupuesto_fe,FEPF.id_fuente_finan, FEPF.correlativo_meta, FEPF.anio_pres_fuen, FF.nombre_fuente_finan from  FUENTE_FINANCIAMIENTO as FF inner join FE_PRESUPUESTO_FUENTE as FEPF on FEPF.id_fuente_finan=FF.id_fuente_finan where id_presupuesto_fe='".$idPresupuestoFE."'");

        return $listaFEPresupuestoFuente->result();
    }

    function listarFuenteFinanciamiento()
    {

        $listarFuenteFinanciamiento=$this->db->query("SELECT id_fuente_finan,nombre_fuente_finan,acronimo_fuente_finan FROM FUENTE_FINANCIAMIENTO");

        return $listarFuenteFinanciamiento->result();
    }

    function SectorPliego($id_est_inv)
    {
        $SectorPliego=$this->db->query("select nombre_sector, pliego from SECTOR INNER JOIN FE_PRESUPUESTO_INV ON SECTOR.id_sector=FE_PRESUPUESTO_INV.id_sector  INNER JOIN ESTUDIO_INVERSION ON ESTUDIO_INVERSION.id_est_inv=FE_PRESUPUESTO_INV.id_est_inv WHERE ESTUDIO_INVERSION.id_est_inv='".$id_est_inv."' ");
        
        return $SectorPliego->result();
    }

    function TipoGastoDetallePresupuesto($id_detalle_presupuesto)
    {   
        $TipoGasto=$this->db->query("select FE_DETALLE_PRESUPUESTO.id_detalle_presupuesto,FE_TIPO_GASTO.id_tipo_gasto, desc_tipo_gasto, id_est_inv from FE_TIPO_GASTO INNER JOIN FE_DETALLE_PRESUPUESTO ON FE_DETALLE_PRESUPUESTO.id_tipo_gasto=FE_TIPO_GASTO.id_tipo_gasto INNER JOIN FE_PRESUPUESTO_INV ON FE_DETALLE_PRESUPUESTO.id_presupuesto_fe=FE_PRESUPUESTO_INV.id_presupuesto_fe where FE_DETALLE_PRESUPUESTO.id_presupuesto_fe='".$id_detalle_presupuesto."' ");
        
        return $TipoGasto->result();
    }

    function DetalleGasto($id_est_inv)
    {
        $DetalleGasto=$this->db->query("select FE_TIPO_GASTO.id_tipo_gasto, desc_tipo_gasto, id_est_inv, desc_detalle_gasto, cantidad_detalle_gasto, costo_uni_detalle_gasto, sub_total_detalle_gasto from FE_TIPO_GASTO INNER JOIN FE_DETALLE_PRESUPUESTO ON FE_DETALLE_PRESUPUESTO.id_tipo_gasto=FE_TIPO_GASTO.id_tipo_gasto INNER JOIN FE_PRESUPUESTO_INV ON FE_DETALLE_PRESUPUESTO.id_presupuesto_fe=FE_PRESUPUESTO_INV.id_presupuesto_fe INNER JOIN FE_DETALLE_GASTO  ON FE_DETALLE_PRESUPUESTO.id_detalle_presupuesto=FE_DETALLE_GASTO.id_detalle_presupuesto where id_est_inv='".$id_est_inv."'order by id_tipo_gasto");
        
        return $DetalleGasto->result();
    }
    
    function nombreProyectoInvPorId($id)
    {

        $nombreProyectoInv=$this->db->query("select ESI.id_est_inv, ESI.nombre_est_inv from ESTUDIO_INVERSION ESI where ESI.id_est_inv=".$id);

        return $nombreProyectoInv->result()[0];
    }


     function listarPresupuestoInverAfe($id_presupuesto_fe)
    {
        $nombreProyectoInv=$this->db->query("execute sp_FEPresupuestoInv_ListarAfectacionP '".$id_presupuesto_fe."'");

        return $nombreProyectoInv->result();
    }
      function listarDetalleGasto($id_presupuesto_fe,$subInten)
    {
        $listarDetalleGasto=$this->db->query("execute sp_FEPresupuestoInv_ListarDetalleGasto '".$id_presupuesto_fe."','".$subInten."'");

        return $listarDetalleGasto->result_array();
    }
     function listarDetalleGastoPadres($id_presupuesto_fe)
    {
        $listarDetalleGasto=$this->db->query("execute sp_FEPresupuestoInv_ListarDetalleAfectacionP '".$id_presupuesto_fe."'");

        return $listarDetalleGasto->result_array();
    }

    function ListarFuente($id_presupuesto_fe)
    {

        $fuente=$this->db->query("select nombre_fuente_finan, correlativo_meta, anio_pres_fuen FROM FE_PRESUPUESTO_FUENTE INNER JOIN FUENTE_FINANCIAMIENTO ON FE_PRESUPUESTO_FUENTE.id_fuente_finan=FE_PRESUPUESTO_FUENTE.id_fuente_finan INNER JOIN FE_PRESUPUESTO_INV ON FE_PRESUPUESTO_INV.id_presupuesto_fe=FE_PRESUPUESTO_FUENTE.id_presupuesto_fe where FE_PRESUPUESTO_INV.id_presupuesto_fe=".$id_presupuesto_fe);

        return $fuente->result();
    }

}