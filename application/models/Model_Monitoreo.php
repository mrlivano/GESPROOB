<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Monitoreo extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    function ListarTipoUsuarioMenu($tipo){
        $query=$this->db->query("   select M2.id_modulo,M2.id_menu,M.id_menu as id_submenu,M2.nombre,M2.url,M2.class_icono,M.nombre as nombreSubmenu, M.url as urlSubmenu
			    from USUARIO U
			    inner join ACCESS_MENU A on U.id_persona=A.id_persona
			    inner join MENU M on M.id_menu=A.id_menu
			    inner join MENU M2 on M.id_menu_padre=M2.id_menu
			    left join USARIO_MENU UM on UM.id_menu=M.id_menu
			    where UM.id_usuario_tipo=".$tipo."
			    order by M2.posicion asc");
            if($query){

              return  $query->result_array();
            }
            else{
              return false;
            }
    }
    function getUsuario($idPersona=FALSE){
        if($idPersona==FALSE){
            $Usuario=$this->db->query("execute sp_usuario_r");
            if($Usuario->num_rows()>0){
              return $Usuario->result();
            }
            else{
              return false;
            }
        }
        else{
            $Usuario=$this->db->query("select * from USUARIO where id_persona=".$idPersona.";");
            if($Usuario->num_rows()>0){
                return $Usuario->result();
            }
            else{
                return false;
            }
        }
    }
    function AddUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino)
    {
	        $query=$this->db->query("execute sp_usuario_c'".$id_persona."','".$txt_usuario."','".$txt_contrasenia."','".$cbb_TipoUsuario."'");
            if($query){
                if($cbb_listaMenuDestino!=''){
                    $arrayMenuUsuario=explode("-",$cbb_listaMenuDestino);
                    for($i=0;$i<count($arrayMenuUsuario);$i++){
                        $this->db->close();
                        $this->db->query("insert into ACCESS_MENU(id_menu,id_persona) values(".$arrayMenuUsuario[$i].",".$id_persona.");");
                    }
                }
                return true;
	        }
            else {
	            return false;
	        }
    }
    function editUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino,$cbb_estado)
    {
        if($txt_contrasenia=='')
            $query=$this->db->query("update USUARIO set id_persona='".$id_persona."',usuario='".$txt_usuario."',id_usuario_tipo='".$cbb_TipoUsuario."',activo=".$cbb_estado." WHERE id_persona='".$id_persona."'");
        else
            $query=$this->db->query("update USUARIO set id_persona='".$id_persona."',contrasenia='".$txt_contrasenia."',usuario='".$txt_usuario."',id_usuario_tipo='".$cbb_TipoUsuario."',activo=".$cbb_estado." WHERE id_persona='".$id_persona."'");
        if($query){
            $this->db->close();
            $this->db->query("delete from ACCESS_MENU where id_persona=".$id_persona.";");
            if($cbb_listaMenuDestino!=''){
                $arrayMenuUsuario=explode("-",$cbb_listaMenuDestino);
                for($i=0;$i<count($arrayMenuUsuario);$i++){
                    $this->db->close();
                    $this->db->query("insert into ACCESS_MENU(id_menu,id_persona) values(".$arrayMenuUsuario[$i].",".$id_persona.");");
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
    function ListarTipoUsuario()
    {
    	$ListarTipoUsuario=$this->db->query("select* from USUARIO_TIPO");
        if($ListarTipoUsuario->num_rows()>0)
         {
          return $ListarTipoUsuario->result();
         }else
         {
          return false;
         }
    }
    function listaUrlAsignado($idPersona)
    {
        $data = $this->db->query("select * from MENU m inner join ACCESS_MENU am on m.id_menu = am.id_menu where am.id_persona = $idPersona");
        return $data->result();
    }
    function listaUsuario()
    {
        $this->db->select('*');
        $this->db->from('USUARIO');
        $this->db->join('USUARIO_TIPO', 'USUARIO.id_usuario_tipo = USUARIO_TIPO.id_usuario_tipo');
        $this->db->join('PERSONA', 'USUARIO.id_persona = PERSONA.id_persona');
        return $this->db->get()->result();
    }
    function listaModulo()
    {
        $data = $this->db->query("select * from MENU where id_modulo = 'HOME'");
        return $data->result();
    }
    function listaSubModulo($idModulo)
    {
        $data = $this->db->query("select * from MENU where id_padre_home = $idModulo and url is not null");
        return $data->result();
    } 

}
