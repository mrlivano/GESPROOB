<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_FEActividadEntregable extends CI_Model
{
           public function __construct()
          {
              parent::__construct();
            // $this->db->free_db_resource();

          }

       function get_Actividades($id_entregable)
        {
            $Actividades=$this->db->query("execute sp_Actividad_r'".$id_entregable."' ");
            return $Actividades->result();
   
        }
        function Add_Actividades($data)
        {
            $this->db->insert('ACTIVIDAD_CRONOGRAMA',$data);
            return $this->db->affected_rows();
        }
        /*
        function Add_Actividades($opcion,$id_act,$txt_id_entregable,$txt_nombre_act,$txt_fechaActividadI,$txt_fechaActividadf,$txt_valoracionEAc,$txt_AvanceEAc,$txt_observacio_EntreAc,$txt_ActividadColor)
        {

            $mensaje=$this->db->query("EXECUTE sp_Gestionar_Actividad_Entregable'".$opcion."','".$id_act."', '" . $txt_id_entregable."','".$txt_nombre_act."','".$txt_fechaActividadI."','".$txt_fechaActividadf."',".$txt_valoracionEAc.",'".$txt_AvanceEAc."','".$txt_observacio_EntreAc."','".$txt_ActividadColor."'");
            return $mensaje->result();

        }*/
        function Update_Actividades($opcion,$tx_IdActividad,$txt_idEntregable,$txt_NombreActividadAc,$txt_fechaActividadIAc,$txt_fechaActividadfAc,$txt_valorizacionEAct,$txt_avanceEAct,$txt_observacio_EntreAct,$txt_ActividadColorAc)
        {
          $this->db->query("EXECUTE sp_Gestionar_Actividad_Entregable_c'".$opcion."','".$tx_IdActividad."','" . $txt_idEntregable."','".$txt_NombreActividadAc."','".$txt_fechaActividadIAc."','".$txt_fechaActividadfAc."',".$txt_valorizacionEAct.",'".$txt_avanceEAct."','".$txt_observacio_EntreAct."','".$txt_ActividadColorAc."'");
            if ($this->db->affected_rows()> 0) 
              {
                return true;
              }
              else
              {
                return false;
              }
        }

      function CalcularAvanceActividad($tx_IdActividad,$txt_idEntregable)
        {
           $actividad=$this->db->query("select id_entregable,Avance,Valoracion from ACTIVIDAD_CRONOGRAMA where id_entregable='".$txt_idEntregable."'");
              if($actividad->num_rows()>=0)
             {
              return $actividad->result();
             }else
             {
              return false;
             }

        }
        //fin funcion
       
        //fin division funciona
        //grupo funcional*/
        //
        //PARA ALA ASIGNACION DE PERSONAL A LA ACTIVIDAD 
        function   AsignacionPersonalActividad($Opcion,$txt_idActividadCronograma ,$txt_idPersonaActividad,$txt_AsigPersonalActividad)
        {
          $this->db->query("EXECUTE sp_Gestionar_Responsable_Actividad_c'".$Opcion."','".$txt_idActividadCronograma."','".$txt_idPersonaActividad."','".$txt_AsigPersonalActividad."' ");
            if ($this->db->affected_rows()> 0) 
              {
                return true;
              }
              else
              {
                return false;
              }
        }      
        //FIN ASIGNACION DE PERSONAL   DE ACTIVIDAD AL  LA ACTIVIDAD
        function VerValoracionRestanteActividad($txt_id_entregable)
        {
          $ValoracionReActividad=$this->db->query("select id_entregable,SUM(valoracion) as valoracion from ACTIVIDAD_CRONOGRAMA where id_entregable='".$txt_id_entregable."' group by id_entregable");
          return $ValoracionReActividad->result();
        }

        function ObservacionActividad($tx_IdActividadObser,$txt_desco_obs,$txt_fechaLevantaminetoObse,$doc_observacio)
        {
          $Opcion="INSERTAR";
          $this->db->query("EXECUTE sp_Gestionar_Actividad_Obsevacion_c @Opcion='".$Opcion."',@desc_obsrevacion='".$txt_desco_obs."',@fecha_observacion='".$txt_fechaLevantaminetoObse."',@doc_observacion='".$doc_observacio."',@id_act='".$tx_IdActividadObser."' ");
            if ($this->db->affected_rows()> 0) 
              {
                return true;
              }
              else
              {
                return false;
              }
        }

        function LevantaminetoObservacionActividad($tx_IdActividadObser,$txt_descoLevantamiento,$txt_fechaLevantamiento,$doc_observacioLevanta)
        {
          $Opcion="ACTUALIZAR";
          $this->db->query("EXECUTE sp_Gestionar_Actividad_Obsevacion_c @Opcion='".$Opcion."',@desc_levantamiento='".$txt_descoLevantamiento."',@fecha_levantamiento='".$txt_fechaLevantamiento."',@doc_levantamiento='".$doc_observacioLevanta."',@id_act_observacion='".$tx_IdActividadObser."' ");
            if ($this->db->affected_rows()> 0) 
              {
                return true;
              }
              else
              {
                return false;
              }
        }

        function  listadoObservacion($idActividad)
        {
          $data=$this->db->query("select * from ACTIVIDAD_OBSERVACION where id_act='".$idActividad."' ");
              if($data->num_rows()>=0)
             {
              return $data->result();
             }else
             {
              return null;
             }
        }
     


}