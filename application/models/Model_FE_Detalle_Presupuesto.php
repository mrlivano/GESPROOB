<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_FE_Detalle_Presupuesto extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function Insertar($idPresupuestoFE, $idsTipoGasto)
    {
        $this->db->query("execute sp_DetallePresupuesto_c '".$idPresupuestoFE."','".$idsTipoGasto."'");

        return true;
    }

    function ObtenerUltimoIdDetallePresupuesto()
    {
    	return $this->db->query('select max(id_detalle_presupuesto) as idDetallePresupuesto from FE_DETALLE_PRESUPUESTO')->result()[0]->idDetallePresupuesto;
    }

    function ListarPorIdPresupuestoFE($idPresupuestoFE)
    {
        $data=$this->db->query("select * from FE_DETALLE_PRESUPUESTO as FEDP inner join FE_TIPO_GASTO as FETG on FEDP.id_tipo_gasto=FETG.id_tipo_gasto where id_presupuesto_fe=".$idPresupuestoFE);

        return $data->result();
    }

    function EliminarPorIdPresupuestoFE($idPresupuestoFE)
    {
        $this->db->query("delete from FE_DETALLE_PRESUPUESTO where id_presupuesto_fe=".$idPresupuestoFE);

        return true;
    }
}