<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_EtapasFE extends CI_Model
{
           public function __construct()
          {
              parent::__construct();

          }
      /*LISTAR DENOMINACION FORMULACION Y EVALUACION*/
        function GetEtapasFE()
        {
            $EtapasFE=$this->db->query("select id_etapa_fe, denom_etapas_fe from ETAPAS_FE");//listar funcion
            if($EtapasFE->num_rows()>=0)
             {
              return $EtapasFE->result();
             }else
             {
              return false;
             }

        }
        /*LISTAR DENOMINACION FORMULACION Y EVALUACION*/
    //AGREGAR UNA ETAPA EN FORMULACION Y EVALUACION
         function AddEtapasFE($txt_EtapasFE)
        {
            $this->db->query("insert into ETAPAS_FE(denom_etapas_fe) values ('$txt_EtapasFE')");
            if ($this->db->affected_rows()> 0)
              {
                return true;
              }
              else
              {
                return false;
              }
        }
        FUNCTION UpdateEtapasFE($id_etapaDenominacion,$txt_etapaDenominacion){
              $this->db->query("update ETAPAS_FE set denom_etapas_fe='$txt_etapaDenominacion' where id_etapa_fe='$id_etapaDenominacion'");
              if ($this->db->affected_rows()> 0)
                {
                  return true;
                }
                else
                {
                  return false;
                }
        }

        function EliminarEtapa($id_etapa_fe) {
          $this->db->where('id_etapa_fe',$id_etapa_fe);
          $this->db->delete('ETAPAS_FE');
          if($this->db->affected_rows()>0){
            return true;
          }
          else{
            return false;
          }
        }
        //AGREGAR UNA ETAPA EN FORMULACION Y EVALUACION
}
