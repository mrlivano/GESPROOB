<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Entidad extends CI_Model
{
           public function __construct()
          {
              parent::__construct();
            // $this->db->free_db_resource();

          }
        //fin modificar sector
        //Inicio Entidad
        function GetEntidad()
        {
            $sector=$this->db->query("execute sp_Entidad_r");//listar entidad
            if($sector->num_rows()>0)
             {
              return $sector->result();
             }else
             {
              return false;
             }
   
        }
        //añadir una nueva entidad

        function AddEntidad($listaSector,$txt_NombreEntidad,$txt_DenominacionEntidad)
        {
            $mensaje1=$this->db->query("execute sp_Entidad_c '".$listaSector."','".$txt_NombreEntidad."','".$txt_DenominacionEntidad."'");
           	if($mensaje1->num_rows()>0)
            {
               return $mensaje1->result();
           
            }
            else
              {
                return false;
              }

        }
         //fin añadir nueva entidad
        function UpdateEntidad($txt_IdModificarEntidar,$id_sector,$txt_NombreEntidadM,$txt_DenominacionEntidadM)
        {
          $this->db->query("execute sp_Entidad_u '".$txt_IdModificarEntidar."','".$id_sector."','".$txt_NombreEntidadM."','".$txt_DenominacionEntidadM."'");
            if ($this->db->affected_rows() > 0) 
              {
                return true;
              }
              else
              {
                return false;
              }

        }
        function EliminarEntidad($id_entidad){
           $this->db->query("execute sp_Entidad_d '".$id_entidad."'");
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