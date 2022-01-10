<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_FEnivelEstudio extends CI_Model
{
           public function __construct()
          {
              parent::__construct();
            // $this->db->free_db_resource();

          }
      /*añadir funcion*/
        function get_FEnivelEstudio()
        {
            $FEnivelEstudio=$this->db->query("select* from NIVEL_ESTUDIO");//listar funcion
            if($FEnivelEstudio->num_rows()>=0)
             {
              return $FEnivelEstudio->result();
             }else
             {
              return false;
             }

        }
        function add_NivelEstudio($denom_nivel_estudio)
        {

            $this->db->query("insert into NIVEL_ESTUDIO(denom_nivel_estudio) values ('$denom_nivel_estudio')");
            if ($this->db->affected_rows()> 0)
              {
                return true;
              }
              else
              {
                return false;
              }

        }
        function updateNivelEstudio($Id_denom_nivel_estudioA,$txt_denom_nivel_estudioA)
        {
           $this->db->query("update NIVEL_ESTUDIO  set denom_nivel_estudio='$txt_denom_nivel_estudioA' where id_nivel_estudio='$Id_denom_nivel_estudioA' ");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }

        }
        //fin funcion

       function EliminarNivelEstudios($id_nivel_estudio){
         $this->db->where('id_nivel_estudio',$id_nivel_estudio);
         $this->db->delete('NIVEL_ESTUDIO');
         if($this->db->affected_rows()>0){
           return true;
         }
         else{
           return false;
         }
       }
        //fin division funciona
        //grupo funcional*/

}
