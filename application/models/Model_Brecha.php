<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Brecha extends CI_Model
{
           public function __construct()
          {
              parent::__construct();

          }
//------------------METODOS DE LA BRECHA-------------------
//AGREGAR UNA BRECHA
      function AddBrecha($cbxServPubAsoc,$txt_NombreBrecha, $txtArea_DescBrecha)
        {
          $mensaje=$this->db->query("execute sp_Brecha_c '".$cbxServPubAsoc."','".$txt_NombreBrecha."','".$txtArea_DescBrecha."'");
           /* if ($this->db->affected_rows() > 0) 
              {
                return true;
              }*/
              if($mensaje->num_rows()>0)
             {
              return $mensaje->result();
              }
              else
              {
                return false;
              }
        }
//FIN AGREGAR UNA BRECHA
//LISTAR UNA BRECHA
      function GetBrecha()
        {
            $brecha=$this->db->query("execute sp_Brecha_r"); //PROCEDIMIENTO DE LISTAR BRECHAS
            if($brecha->num_rows()>0)
             {
              return $brecha->result();
             }else
             {
              return false;
             }
   
        } 
//FIN LISTAR UNA BRECHA

//MODIFICAR UNA BRECHA
         function UpdateBrecha($id_brecha,$id_ser_pub_asoc,$nombre_brecha,$desc_brecha)
        {
           $this->db->query("execute sp_Brecha_u '".$id_brecha."','".$id_ser_pub_asoc."','".$nombre_brecha."','".$desc_brecha."' ");
            if ($this->db->affected_rows() > 0) 
              {
                return true;
              }
              else
              {
                return false;
              }

        }
//FIN MODIFICAR UNA BRECHA  

//ELIMINAR UNA BRECHA
         function DeleteBrecha($id_brecha)
        {
           $this->db->query("execute sp_Brecha_d '".$id_brecha."' ");
            if ($this->db->affected_rows() > 0) 
              {
                return true;
              }
              else
              {
                return false;
              }

        }
//FIN ELIMINAR UNA BRECHA 
//------------------FIN METODOS DE LA BRECHA-------------------          
}