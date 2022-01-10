<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_ProgramaPresupuestal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
//----------------------METODOS PARA EL MANTENIMIENTO DE RUBRO DE EJECUCION--------------------------------------------
    //AGREGAR UN PROGRAMA PRESUPUESTAL
   public function BuscarProgramaP($txt_CodigoProgramaP){
        $resultado=$this->db->select('*')->from('PROGRAMA_PRESUPUESTAL')
        ->where('cod_programa_pres',$txt_CodigoProgramaP)
        ->get();
        if($resultado->num_rows()>0){
            return true;
        }
        else{
            return false;
        }

   }
   public function BuscarProgramaPU($id_programa_pres,$nombre_programa_pres){
        $resultado=$this->db->select('*')->from('PROGRAMA_PRESUPUESTAL')
        ->where('nombre_programa_pres',$nombre_programa_pres)
        ->where('id_programa_pres!=',$id_programa_pres)
        ->get();
        if($resultado->num_rows()>0){
            return true;
        }
        else{
            return false;
        }
   }
    public function AddProgramaP($data)
    {
        $this->db->insert('PROGRAMA_PRESUPUESTAL',$data);
        return $this->db->insert_id();
    }
    //FIN AGREGAR UN PROGRAMA PRESUPUESTAL
    //LISTAR PROGRAMA PRESUPUESTAL
    public function GetProgramaP($flat)
    {
        $programap = $this->db->query("execute sp_Gestionar_ProgramaPresupuestal'" . $flat . "'"); //PROCEDIMIENTO DE LISTAR PROGRAMA PRESUPUESTAL
        if ($programap->num_rows() > 0) {
            return $programap->result();
        } else {
            return false;
        }
    }
    //FIN LISTAR UN PROGRAMA PRESUPUESTAL
    //MODIFICAR DATOS DE PROGRAMA PRESUPUESTAL
    public function UpdateProgramaP($id_programa_pres,$data)
    {
        $this->db->where('id_programa_pres',$id_programa_pres);
        $this->db->update('PROGRAMA_PRESUPUESTAL',$data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    //FIN MODIFICAR DATOS DE PROGRAMA PRESUPUESTAL
    function EliminarProgramaP($id_programa_pres){
        $this->db->where('id_programa_pres',$id_programa_pres);
      $this->db->delete('programa_presupuestal');
      if($this->db->affected_rows()>0){
      return true;
      }
      else{
        return false;
      }
    }

    function ListaProgramaPresupuestal()
    {
        $data = $this->db->query("select * from PROGRAMA_PRESUPUESTAL order by nombre_programa_pres");

        return $data->result();
    }
    //--------------FIN DE METODOS PARA EL MANTENIMIENTO DE PROGRAMA PRESUPUESTAL--------------------------------------------
}
