<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Menu extends CI_Model
{
	      public function __construct()
	      {
	          parent::__construct();
	      }
    function getMenu($idMenu=false){
        if($idMenu==false){
          $query=$this->db->query("select * from MENU order by nombre asc;");
          if($query){
            return $query->result();
          }
          else{
            return false;
          }
        }
        else{
          $query=$this->db->query("select * from MENU where id_menu=".$idMenu);
          if($query){
            return $query->result();
          }
          else{
            return false;
          }
        }

    }
		function getMenuAll($idPersona){
          //$query=$this->db->query("select * from ACCESS_MENU INNER JOIN MENU ON MENU.id_menu = ACCESS_MENU.id_menu WHERE ACCESS_MENU.id_menu = ".$idPersona);

					$this->db->select("m.*,am.*");
				  $this->db->from("MENU m");
				  $this->db->join("ACCESS_MENU am", "am.id_menu = m.id_menu",'left');
				  $this->db->where('am.id_persona',$idPersona);
				  $query = $this->db->get();
				  return $query->result();

					/*
          if($query){
            return $query->result();
          }
          else{
            return false;
          }*/

    }
     function addMenu($tx_nombre,$tx_url,$tx_posicion, $cbx_menuPadre,$cbx_nivel,$cbx_modulo,$tx_class_icono){
    $query=$this->db->query("execute sp_Menu_c '".$tx_nombre."','".$tx_url."',".$tx_posicion.",". $cbx_menuPadre.",".$cbx_nivel.",".$cbx_modulo.",'".$tx_class_icono."'");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }
  function updateMenu($idMenu,$tx_nombre,$tx_url,$tx_posicion, $cbx_menuPadre,$cbx_nivel,$cbx_modulo,$tx_class_icono){
    $query=$this->db->query("execute sp_Menu_u ".$idMenu.",'".$tx_nombre."','".$tx_url."',".$tx_posicion.",". $cbx_menuPadre.",".$cbx_nivel.",".$cbx_modulo.",'".$tx_class_icono."';");
    if($query){
      return true;
    }
    else{
      return false;
    }
  }


}
