<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_UnidadE extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function AddUnidadE($txt_NombreUnidadE, $txtCodigoUE)
    {
        $this->db->query("execute sp_UnidadEjecutora_c '".$txt_NombreUnidadE."', '".$txtCodigoUE."'");
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function GetUnidadE()
    {
        $unidade=$this->db->query("execute sp_UnidadEjecutora_r");
        if($unidade->num_rows()>0)
        {
            return $unidade->result();
        }
        else
        {
            return false;
        }
    }

    function getUnidadEjecutoraOpciones()
    {
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $ue=$this->session->userdata('idUnidadEjecutora');
        if($tipoUsuario==9)
        {
            $q=$this->db->query("execute sp_UnidadEjecutora_r");
            return $q->result();
        }
        else
        {
            $q=$this->db->query("select * from Unidad_EJECUTORA where id_ue=$ue");
            return $q->result();
        }
    }

    //FIN LISTAR UNIDAD DE EJECUCION

    //MODIFICAR DATOS DE UNIDAD EJECUTORA
         function UpdateUnidadE($id_ue, $nombre_ue, $txtCodigoUE_M)
        {
           $this->db->query("execute sp_UnidadEjecutora_u '".$id_ue."','".$nombre_ue."','".$txtCodigoUE_M."'");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }
        }

    function eliminar($id_eli)
    {
        $this->db->where('id_ue', $id_eli);
        $this->db->delete('unidad_ejecutora');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
        // return $this->db->affected_rows();
    }
    //FIN MODIFICAR DATOS DE UNIDAD EJECUTORA
//----------------------FIN MANTENIMIENTOS DE UNIDAD EJECUTORA------------

        function UnidadEjecutoraPipListar()
        {
            $listaPipUnidadEjecutora=$this->db->query("select  nombre_ue ,count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from proyecto_inversion inner JOIN unidad_ejecutora ON proyecto_inversion.id_ue=unidad_ejecutora.id_ue group by nombre_ue ");

            return $listaPipUnidadEjecutora->result();
        }
        function UnidadEjecutoraPipListarResumen()
        {
           $data=$this->db->query("select  count (nombre_pi)as TotalPip, sum(costo_pi)as CostoTotal from proyecto_inversion inner JOIN unidad_ejecutora ON proyecto_inversion.id_ue=unidad_ejecutora.id_ue");

            return $data->result()[0];
        }

        function UnidadEjecutoraId($unidadEjecutora)
        {
            $this->db->select('UNIDAD_EJECUTORA.*');
            $this->db->from('UNIDAD_EJECUTORA');
            $this->db->where('UNIDAD_EJECUTORA.id_ue',$unidadEjecutora);
            return $this->db->get()->result()[0];
        }
    
    public function ListaUnidadEjecutora()
    {
        $data = $this->db->query("select * from UNIDAD_EJECUTORA order by nombre_ue");

        return $data->result();
    }


    public function cargarSiaf($anio)
    {
       
        $data=$this->db->query("execute Consulta_SiafImportado   @anio ='".$anio."'");
        return $data->result();
    }
}
