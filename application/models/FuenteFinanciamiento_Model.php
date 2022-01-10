<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FuenteFinanciamiento_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
   
    public function BuscarFuenteF($txt_NombreFuenteFinanciamiento){
        $resultado=$this->db->select('*')->from('FUENTE_FINANCIAMIENTO')
        ->where('nombre_fuente_finan',$txt_NombreFuenteFinanciamiento)
        ->get();
        if($resultado->num_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    public function BuscarFuenteFU($id_fuente_finan,$txt_NombreFuenteFinanciamiento){
        $resultado=$this->db->select('*')->from('FUENTE_FINANCIAMIENTO')
        ->where('nombre_fuente_finan',$txt_NombreFuenteFinanciamiento)
        ->where('id_fuente_finan !=',$id_fuente_finan)
        ->get();
        if($resultado->num_rows()>0){
            return true;
        }
        else
        {
            return false;
        }
    }


    public function get_FuenteFinanciamiento()
    {
        $get_FuenteFinanciamiento = $this->db->query("select id_fuente_finan,nombre_fuente_finan,acronimo_fuente_finan
             FROM FUENTE_FINANCIAMIENTO");
        if ($get_FuenteFinanciamiento->num_rows() > 0) {
            return $get_FuenteFinanciamiento->result();
        } else {
            return false;
        }
    }

    public function AddFuenteFinanciamiento($data)
    {
        $this->db->insert('FUENTE_FINANCIAMIENTO',$data);
        return $this->db->insert_id();
    }

    public function EliminarFuenteFinanciamiento($id_fuente_finan)
    {
      $this->db->where('id_fuente_finan',$id_fuente_finan);
      $this->db->delete('FUENTE_FINANCIAMIENTO');
      if($this->db->affected_rows()>0){
      return true;
      } 
      else{
        return false;
      } 

    }
    public function UpdateFuenteFinanciamiento($id_fuente_finan,$data)
    {
      $this->db->where('id_fuente_finan',$id_fuente_finan);
      $this->db->update('FUENTE_FINANCIAMIENTO',$data);
      if($this->db->affected_rows()>0){
        return true;
      }
      else{
        return false;
      }     

    }

    public function getFuenteFinanciamientoDesc($descripcion)
    {
        $data=$this->db->query("select * from fuente_financiamiento where nombre_fuente_finan like '$descripcion'");
        return count($data->result())>0 ? $data->result()[0] : false;
    }

}
