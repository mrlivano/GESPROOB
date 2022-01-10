<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_MetaPresupuestal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function ListaMetaPresupuestal()
    {
        $data=$this->db->query("select * from META_PRESUPUESTAL order by nombre_meta_pres");
        return $data->result();
    }

    function AddMetaP($txt_NombreMetaP,$date_AnioMetaP,$text_Pim,$text_NumeroMeta,$text_Devengado)
    {
        $this->db->query("execute sp_MetaPresupuestal_c'".$txt_NombreMetaP."','".$date_AnioMetaP."','".$text_Pim."','".$text_NumeroMeta."','".$text_Devengado."'");
        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function GetMetaP()
    {
        $metap=$this->db->query("execute sp_MetaPresupuestal_r");
        if($metap->num_rows()>0)
        {
            return $metap->result();
        }
        else
        {
            return false;
        }
    } 

    function UpdateMetaP($id_meta_pres,$txt_NombreMetaP,$date_AnioMetaP,$text_Pim,$text_NumeroMeta,$text_Devengado)
    {
        $this->db->query("execute sp_MetaPresupuestal_u '".$id_meta_pres."','".$txt_NombreMetaP."','".$date_AnioMetaP."','".$text_Pim."','".$text_NumeroMeta."','".$text_Devengado."'");
        if ($this->db->affected_rows() > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}