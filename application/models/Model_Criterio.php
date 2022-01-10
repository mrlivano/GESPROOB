<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Criterio extends CI_Model
{
  public function __construct(){
      parent::__construct();
  }     
  function getFactor($idFactor=false){
    if($idFactor==false){
      $query=$this->db->query("select * from FACTOR order by nombre_factor asc;");
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
    }
    else{
      $query=$this->db->query("select * from FACTOR where id_factor=".$idFactor);
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
    }
    
  }
   function getValorizacionPtje($criterio,$idValorizacion=false){
      if($idValorizacion==false)
        $query=$this->db->query("select * from VALORIZACION where id_criterio=".$criterio);
      else
        $query=$this->db->query("select * from VALORIZACION where id_valorizacion=".$idValorizacion);
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
    
    
  }
  function getPrioridad($proyecto){
      $query=$this->db->query("select sum(puntaje_total) as n
from EVALUACION where id_pi=".$proyecto);
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
  }
  function getCriterio($idCriterio=false){
    if($idCriterio==false){
      $query=$this->db->query("
select C.*,F.nombre_factor,CAST(C.peso as varchar)+' %' as denPeso,U.nombre_funcion
from CRITERIO C 
inner join FACTOR F on C.id_factor=F.id_factor
inner join FUNCION U on U.id_funcion=C.id_funcion;");
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
    }
    else{
      $query=$this->db->query("
select C.*,F.nombre_factor,CAST(C.peso as varchar)+' %' as denPeso,U.nombre_funcion
from CRITERIO C 
inner join FACTOR F on C.id_factor=F.id_factor
inner join FUNCION U on U.id_funcion=C.id_funcion 
where C.id_criterio=".$idCriterio);
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
    }
  }
  function getValorizacion($id_proyecto,$funcion){
/*    $query=$this->db->query("
select C.id_criterio,F.nombre_factor,CAST(C.peso as varchar)+'%' as denPeso,C.nombre_criterio,V.nombre_val,V.puntaje_val,V.id_valorizacion,C.peso
from VALORIZACION V
inner join CRITERIO C on C.id_criterio=V.id_criterio
inner join FACTOR F on F.id_factor=C.id_factor order by id_criterio asc;");*/
    $query=$this->db->query("
select C.id_criterio,F.nombre_factor,CAST(C.peso as varchar)+'%' as denPeso,C.nombre_criterio,V.nombre_val,V.puntaje_val,V.id_valorizacion,C.peso
,E.puntaje_val as  puntaje_valP,E.puntaje_total as  puntaje_totalP
from VALORIZACION V
inner join CRITERIO C on C.id_criterio=V.id_criterio AND C.id_funcion=".$funcion."
inner join FACTOR F on F.id_factor=C.id_factor 
LEFT JOIN EVALUACION E on E.id_valorizacion=V.id_valorizacion AND E.id_pi=".$id_proyecto."
order by id_criterio asc;");
    if($query){
      return $query->result_array();
    }
    else{
      return false;
    }
  }
  function addPrioridad($id_proyecto,$array){
    $query=$this->db->query("delete from EVALUACION where id_pi=".$id_proyecto);
    $sql='';
    foreach ($array as $item) {
      if($item[0]!='')
        $sql.="insert into EVALUACION(id_pi,id_valorizacion,puntaje_val,puntaje_total) values(".$id_proyecto.",".$item[0].",".$item[1].",".$item[2].");";
    }
    $query=$this->db->query($sql);
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function addFactor($tx_nombre_factor){
    $query=$this->db->query("execute sp_Factor_c '".$tx_nombre_factor."'");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function updateFactor($idFactor,$tx_nombre_factor){
    $query=$this->db->query("execute sp_Factor_u ".$idFactor.",'".$tx_nombre_factor."'");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function addValorizacion($criterio,$tx_nombre_val,$tx_puntaje_val){
    $query=$this->db->query("execute sp_Valorizacion_c ".$criterio.",'".$tx_nombre_val."','".$tx_puntaje_val."'");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function updateValorizacion($idValorizacion,$tx_nombre_val,$tx_puntaje_val){
    $query=$this->db->query("execute sp_Valorizacion_u ".$idValorizacion.",'".$tx_nombre_val."','".$tx_puntaje_val."'");
    
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function addCriterio($tx_nombre_criterio,$cbx_idFactor,$tx_peso_criterio,$tx_definicion_criterio,$cbx_idFuncion){
    $query=$this->db->query("execute sp_Criterio_c '".$tx_nombre_criterio."','".$cbx_idFactor."','".$tx_peso_criterio."','".$tx_definicion_criterio."','".$cbx_idFuncion."';");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function updateCriterio($idCriterio,$tx_nombre_criterio,$cbx_idFactor,$tx_peso_criterio,$tx_definicion_criterio,$cbx_idFuncion){
    $query=$this->db->query("execute sp_Criterio_u ".$idCriterio.",'".$tx_nombre_criterio."','".$cbx_idFactor."','".$tx_peso_criterio."','".$tx_definicion_criterio."','".$cbx_idFuncion."';");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
}