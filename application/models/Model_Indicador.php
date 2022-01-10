<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Indicador extends CI_Model
{
           public function __construct()
          {
              parent::__construct();

          }

//------------------METODOS DEL INDICADOR----------------------
//AGREGAR UN INDICADOR
      function AddIndicador($txt_NombreIndicador,$txtArea_DefIndicador,$txt_UnidadMedida)
        {
          $mensaje1= $this->db->query("execute sp_Indicador_c'".$txt_NombreIndicador."','".$txtArea_DefIndicador."','".$txt_UnidadMedida."'");
            if($mensaje1->num_rows()>0)
             {
              return $mensaje1->result();
             }else
             {
              return false;
             }
        }
//FIN AGREGAR UN INDICADOR
//LISTAR UN INDICADOR
      function GetIndicador()
        {
            $indicador=$this->db->query("execute sp_Indicador_r"); //PROCEDIMIENTO DE LISTAR INDICADORES
            if($indicador->num_rows()>0)
             {
              return $indicador->result();
             }else
             {
              return false;
             }
   
        } 
//FIN LISTAR UN INDICADOR
//MODIFICAR UNA INDICADOR
         function UpdateIndicador($id_indicador,$nombre_indicador,$definicion_indicador,$unidad_medida_indicador)
        {
           $this->db->query("execute sp_Indicador_u'".$id_indicador."','".$nombre_indicador."','".$definicion_indicador."', '".$unidad_medida_indicador."'");
            if ($this->db->affected_rows() > 0) 
              {
                return true;
              }
              else
              {
                return false;
              }
        }
//FIN MODIFICAR INDICADOR
        //ELIMINAR UN INDICADOR
         function DeleteIndicador($id_indicador)
        {
           $this->db->query("execute sp_Indicador_d '".$id_indicador."' ");
            if ($this->db->affected_rows() > 0) 
              {
                return true;
              }
              else
              {
                return false;
              }

        }
//FIN ELIMINAR UN INDICADOR
//------------------FIN METODOS DEL INDICADOR----------------------
    
}