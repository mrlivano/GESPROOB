<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Preliquidacion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();
    }

    /*añadir funcion*/
    function GetPreliquidacion()
    {
        $sql = "select * from Liq_pre_descripcion";
        $funcion = $this->db->query($sql);//listar funcion
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }
    function GetPreliquidacionDescripcion($id_doc)
    {
        $sql = "select * from Liq_pre_descripcion where id_descripcion=".$id_doc;
        $funcion = $this->db->query($sql);//listar funcion
        if ($funcion->num_rows() > 0) {

            $record=$funcion->row();
            return $record->descripcion;
            //return $funcion->result();
        } else {
            return false;
        }
    }

    function Get_liq_preliquidacion()
    {
        $sql = "select * from Liq_det_preliquidacion";
        $funcion = $this->db->query($sql);//listar funcion
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }


    function AddPreliquidacion($id_sub_gerencia, $denominacion_oficina)
    {
        $this->db->query("sp_Oficina_c '" . $id_sub_gerencia . "','" . $denominacion_oficina . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function UpdatePreliquidacion($id_oficina, $id_subgerencia, $denominacion_gerencia)
    {
        $this->db->query("sp_Oficina_u '" . $id_oficina . "','" . $id_subgerencia . "','" . $denominacion_gerencia . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function EliminarPreliquidacion($id_oficina){
        $this->db->where('id_oficina',$id_oficina);
        $this->db->delete('OFICINA');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
}