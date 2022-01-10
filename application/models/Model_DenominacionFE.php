<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_DenominacionFE extends CI_Model
{
           public function __construct()
          {
              parent::__construct();

          }
      /*LISTAR DENOMINACION FORMULACION Y EVALUACION*/
        function GetDenominacionFE()
        {
            $DenominacionFE=$this->db->query("select id_denom_fe, denom_fe from DENOMINACIOM_FE");//listar funcion
            if($DenominacionFE->num_rows()>=0)
             {
              return $DenominacionFE->result();
             }else
             {
              return false;
             }

        }
        /*LISTAR DENOMINACION FORMULACION Y EVALUACION*/
        //AGREGAR UNA DENOMINACION EN FORMULACION Y EVALUACION
         function AddDenominacionFE($txt_DenominacionFE)
        {
            $mensaje=$this->db->query("execute sp_DenominacionFE_c'".$txt_DenominacionFE."'");

               if($mensaje->num_rows()>0)
             {
              return $mensaje->result();
             }else
             {
              return false;
             }
        }
        //AGREGAR UNA DENOMINACION EN FORMULACION Y EVALUACION
        function UpdateDenominacionFE($txt_IdDenominacionModiFE,$txt_DenominacionModiFE)
        {
           $this->db->query("update DENOMINACIOM_FE set denom_fe='$txt_DenominacionModiFE' where id_denom_fe='$txt_IdDenominacionModiFE' ");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }

        }

    function EliminarDeno($id_entidad){
        $this->db->query("DELETE FROM DENOMINACIOM_FE WHERE id_denom_fe = ".$id_entidad);
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
