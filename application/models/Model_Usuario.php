<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Usuario extends CI_Model
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
            $Usuario=$this->db->query("select u.*,p.*,ue.* from USUARIO as u inner join PERSONA as p on u.id_persona=p.id_persona inner join USUARIO_UE as ue on p.id_persona = ue.id_persona where p.id_persona=".$idPersona.";");
            if($Usuario->num_rows()>0){
                return $Usuario->result();
            }
            else{
                return false;
            }
        }
    }
    function AddUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino,$tipoAcceso)
    {
	        $query=$this->db->query("execute sp_usuario_c'".$id_persona."','".$txt_usuario."','".$txt_contrasenia."','".$cbb_TipoUsuario."','".$tipoAcceso."'");
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
		function UsuarioUE($currentDate, $id_persona, $cbb_UnidadEjecutora) {

			$data = array(
        'fecha_registro' => $currentDate,
        'id_persona' => $id_persona,
        'id_ue' => $cbb_UnidadEjecutora
			);

			$this->db->insert('USUARIO_UE', $data);

		}
		function UsuarioUE_Update($currentDate, $id_persona, $cbb_UnidadEjecutora) {

			$data = array(
        'fecha_registro' => $currentDate,
        'id_persona' => $id_persona,
        'id_ue' => $cbb_UnidadEjecutora
			);

			$this->db->where('id_persona', $id_persona);
			$this->db->update('USUARIO_UE', $data);

		}
    function editUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino,$cbb_estado,$tipoAcceso)
    {
        if($txt_contrasenia=='')
            $query=$this->db->query("update USUARIO set id_persona='".$id_persona."',usuario='".$txt_usuario."',id_usuario_tipo='".$cbb_TipoUsuario."',activo=".$cbb_estado.",tipo_acceso='".$tipoAcceso."' WHERE id_persona='".$id_persona."'");
        else
            $query=$this->db->query("update USUARIO set id_persona='".$id_persona."',contrasenia='".$txt_contrasenia."',usuario='".$txt_usuario."',id_usuario_tipo='".$cbb_TipoUsuario."',activo=".$cbb_estado.", tipo_acceso='".$tipoAcceso."' WHERE id_persona='".$id_persona."'");
        if($query){
            if($cbb_listaMenuDestino!=0) {
								$this->db->query("delete from ACCESS_MENU where id_persona=".$id_persona.";");
                $arrayMenuUsuario=explode("-",$cbb_listaMenuDestino);
                for($i=0;$i<count($arrayMenuUsuario);$i++){
                    $this->db->query("insert into ACCESS_MENU(id_menu,id_persona) values(".$arrayMenuUsuario[$i].",".$id_persona.");");
                }
            }
						$this->db->close();
            return true;
        }
        else {
            return false;
        }
    }
		function editUsuarioProyecto($id_persona, $cbb_listaMenuDestino){
			if ($cbb_listaMenuDestino) {
                $residente = $this->db->query("select * from usuario where id_usuario_tipo=7 and id_persona='$id_persona'");
				$this->db->query("delete from USUARIO_PROYECTO where id_persona=".$id_persona.";");
				$id_proyecto = explode("-", $cbb_listaMenuDestino);
				for ($i=0; $i < count($id_proyecto) ; $i++) {
                    $this->db->query("insert into USUARIO_PROYECTO(id_persona,id_pi) values(".$id_persona.",".$id_proyecto[$i].");");
                    if($residente->num_rows()>0){
                        $this->db->query("delete r from ET_RESPONSABLE r inner join ET_EXPEDIENTE_TECNICO et on r.id_et=et.id_et where id_cargo=7 and r.id_tipo_responsable_et=3 and id_pi='".$id_proyecto[$i]."'");
                        $this->db->query("insert into et_responsable (id_et,id_persona,id_tipo_responsable_et,id_cargo,estado_responsable_et) select id_et, up.id_persona,'3' as id_tipo_responsable_et, '7' as id_cargo, '1' as estado_responsable_et  from usuario_proyecto up inner join ET_EXPEDIENTE_TECNICO et on up.id_pi=et.id_pi where up.id_pi='".$id_proyecto[$i]."' and id_persona='$id_persona'");
                    }
				}
			} elseif ($cbb_listaMenuDestino == 0) {
				$this->db->query("delete from USUARIO_PROYECTO where id_persona=".$id_persona.";");
			}
		}
		function addTipoUsuario($cod_usuario_tipo,$desc_usuario_tipo)
        {
			$data = array(
                'cod_usuario_tipo' => $cod_usuario_tipo,
                'desc_usuario_tipo' => $desc_usuario_tipo
			);
			$result=$this->db->insert('USUARIO_TIPO', $data);
            return $result;
		}
		function updateTipoUsuario($id_usuario_tipo,$cod_usuario_tipo,$desc_usuario_tipo)
		{
			$data = array(
				'cod_usuario_tipo' => $cod_usuario_tipo,
				'desc_usuario_tipo' => $desc_usuario_tipo
			);

			$this->db->where('id_usuario_tipo', $id_usuario_tipo);
			$this->db->update('USUARIO_TIPO', $data);
		}
		function deleteTipoUsuario($id_usuario_tipo)
		{
			$this->db->where('id_usuario_tipo',$id_usuario_tipo);
			$this->db->delete('USUARIO_TIPO');
			if($this->db->affected_rows()>0){
				return true;
			}
			else{
				return false;
			}
		}
    function ListarTipoUsuario()
    {
    	$ListarTipoUsuario=$this->db->query("select * from USUARIO_TIPO");
        if($ListarTipoUsuario->num_rows()>0)
         {
          return $ListarTipoUsuario->result();
         }else
         {
          return false;
         }
    }
		function ListarUnidadEjecutora()
    {
    	$ListarTipoUsuario=$this->db->query("select * from UNIDAD_EJECUTORA");
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
        $ue=$this->session->userdata('idUnidadEjecutora');
        $idPersona=$this->session->userdata('idPersona');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $q=$this->db->query("exec sp_Gestionar_Persona @opcion='lista_usuario_ue',@ue=NULL");
            return $q->result();
        }
        if($tipoUsuario==1)
        {
            $q=$this->db->query("exec sp_Gestionar_Persona @opcion='lista_usuario_ue',@ue=$ue");
            return $q->result();
        }
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
    function cambiarContrasenia($idPersona,$contraseniaNueva)
    {
        $this->db->set('contrasenia',$contraseniaNueva);
        $this->db->where('id_persona',$idPersona);
        $this->db->update('usuario');
        return $this->db->affected_rows();
    }
    function verificarUsername($username)
    {
        $this->db->select('usuario.*');
        $this->db->from('usuario');
        $this->db->where('usuario.usuario',$username);
        return $this->db->get()->result();
    }

    function getUsuarioUE($idPersona)
    {
        $this->db->select('usuario_ue.*');
        $this->db->from('usuario_ue');
        $this->db->where('usuario_ue.id_persona',$idPersona);
        return $this->db->get()->result()[0];
    }
}
