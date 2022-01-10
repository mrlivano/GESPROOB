<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_UnidadF extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

//----------------------MANTENIMIENTOS DE UNIDAD EJECUTORA-------------------------------------------
    //AGREGAR UNA UNIDAD DE EJECUTORA

    public function AddUnidadF($flat, $ID, $txt_NombreUnidadF)
    {
        $Cargo = $this->db->query("execute sp_Gestionar_UnidadFormuladora_c '" . $flat . "','" . $ID . "','" . $txt_NombreUnidadF . "' ");
        if ($Cargo->num_rows() > 0) {
            return $Cargo->result();
        } else {
            return false;
        }
    }
    //FIN AGREGAR UNA UNIDAD DE EJECUTORA

    //LISTAR UNIDAD DE EJECUCION
    public function GetUnidadF()
    {
        $UnidadF = $this->db->query("Select id_uf,Nombre_uf from Unidad_Formuladora"); //PROCEDIMIENTO DE LISTAR UNIDAD DE EJECUCION
        if ($UnidadF->num_rows() > 0) {
            return $UnidadF->result();
        } else {
            return false;
        }

    }
    //FIN LISTAR UNIDAD DE EJECUCION

    //MODIFICAR DATOS DE UNIDAD EJECUTORA
    public function UpdateUnidadF($flat, $txt_IdUnidadFModif, $txt_NombreUnidadF)
    {
        $UnidadF = $this->db->query("execute sp_Gestionar_UnidadFormuladora_c '" . $flat . "','" . $txt_IdUnidadFModif . "','" . $txt_NombreUnidadF . "' ");
        if ($UnidadF->num_rows() > 0) {
            return $UnidadF->result();
        } else {
            return false;
        }
    }
    //FIN MODIFICAR DATOS DE UNIDAD EJECUTORA
    //----------------------FIN MANTENIMIENTOS DE UNIDAD EJECUTORA------------

    public function UnidadFormuladoraPipListar()
    {
        $ListarPipUnidadFormuladora=$this->db->query("select  UNIDAD_FORMULADORA.nombre_uf ,count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from proyecto_inversion INNER JOIN UNIDAD_FORMULADORA  ON proyecto_inversion.id_uf=UNIDAD_FORMULADORA.id_uf group by UNIDAD_FORMULADORA.nombre_uf");

        return $ListarPipUnidadFormuladora->result();
    }
    public function UnidadFormuladoraMontoTotal()
    {
         $data=$this->db->query("select  count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from proyecto_inversion INNER JOIN UNIDAD_FORMULADORA  ON proyecto_inversion.id_uf=UNIDAD_FORMULADORA.id_uf");

        return $data->result()[0];
    }
    function eliminar($id_uf)
    {
        $this->db->where('id_uf',$id_uf);
        $this->db->delete('UNIDAD_FORMULADORA');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function ListaUnidadFormuladora()
    {
        $data = $this->db->query("select * from UNIDAD_FORMULADORA order by nombre_uf");

        return $data->result();
    }
}
