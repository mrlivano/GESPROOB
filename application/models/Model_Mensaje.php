<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Mensaje extends CI_Model
{
  public function __construct(){
      parent::__construct();
  }     
  function enviar($mensaje,$destino){
    $query=$this->db->query("insert into MENSAJE(mensaje,id_persona,fecha) values('".$mensaje."','".$this->session->userdata('idPersona')."','".date('Y-m-d H:i:s')."')");
      if($query){
        $idMensaje=$this->db->insert_id();
        if($destino!=''){
            $array=explode("-",$destino);
            for($i=0;$i<count($destino);$i++){
                $this->db->close();
                $this->db->query("insert into MENSAJE_DESTINATARIO(id_persona,id_mensaje) values(".$array[$i].",".$idMensaje.");");
            }
        }
        return true;
      } 
      else{
        return false;
      }
  }
  function eliminarMensaje($id){
    $query=$this->db->query("delete from  MENSAJE where id_mensaje=".$id);
      if($query){
        return true;
      }
      else{
        return false;
      }
  }
  function listarMensaje(){
      $query=$this->db->query("select M.*,P.nombres+' '+P.apellido_p+' '+P.apellido_m as procedencia
from MENSAJE M
inner join MENSAJE_DESTINATARIO D on M.id_mensaje=D.id_mensaje
inner join PERSONA P on M.id_persona=P.id_persona
where D.id_persona=".$this->session->userdata('idPersona')." order by fecha desc;");
      if($query){
        return $query->result();
      }
      else{
        return false;
      }
  }
}