<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_FE_Detalle_Gasto extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function ListarPorIdDetallePresupuesto($idDetallePresupuesto)
    {
        $DetalleGasto=$this->db->query("select FE_DETALLE_GASTO.id_unidad, UNIDAD_MEDIDA.descripcion as descripcionUnidadMedida, FE_TIPO_GASTO.id_tipo_gasto, desc_tipo_gasto, id_est_inv, desc_detalle_gasto, cantidad_detalle_gasto, costo_uni_detalle_gasto, sub_total_detalle_gasto from FE_TIPO_GASTO INNER JOIN FE_DETALLE_PRESUPUESTO ON FE_DETALLE_PRESUPUESTO.id_tipo_gasto=FE_TIPO_GASTO.id_tipo_gasto INNER JOIN FE_PRESUPUESTO_INV ON FE_DETALLE_PRESUPUESTO.id_presupuesto_fe=FE_PRESUPUESTO_INV.id_presupuesto_fe INNER JOIN FE_DETALLE_GASTO  ON FE_DETALLE_PRESUPUESTO.id_detalle_presupuesto=FE_DETALLE_GASTO.id_detalle_presupuesto INNER JOIN UNIDAD_MEDIDA  ON FE_DETALLE_GASTO.id_unidad=UNIDAD_MEDIDA.id_unidad where FE_DETALLE_PRESUPUESTO.id_detalle_presupuesto='".$idDetallePresupuesto."'order by id_tipo_gasto");
        
        return $DetalleGasto->result();
    }
    
    function Insertar($idDetallePresupuesto, $descripcioDetalleGastoTemp, $idUnidadMedidaTemp, $cantidadDetalleGastoTemp, $costoUnitarioDetalleGastoTemp)
    {
        $DetalleGasto=$this->db->query("execute sp_FedetalleGasto_c ".$idDetallePresupuesto.", ".$idUnidadMedidaTemp.", '".$descripcioDetalleGastoTemp."', ".$cantidadDetalleGastoTemp.", ".$costoUnitarioDetalleGastoTemp);
        
        return $DetalleGasto->result();
    }
}