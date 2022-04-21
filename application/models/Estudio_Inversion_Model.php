<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Estudio_Inversion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function UsuarioPersona($idUsuario)
    {
        $listarPersonaUsuario = $this->db->query("select top 1 USUARIO.id_persona, USUARIO.usuario, PERSONA.id_persona, CONCAT(PERSONA.nombres, ' ', PERSONA.apellido_p, ' ', PERSONA.apellido_m) AS  nombresCompleto, USUARIO_TIPO.desc_usuario_tipo, USUARIO_TIPO.cod_usuario_tipo FROM   PERSONA inner join USUARIO on PERSONA.id_persona = usuario.id_persona INNER JOIN USUARIO_TIPO ON USUARIO.id_usuario_tipo = USUARIO_TIPO.id_usuario_tipo WHERE  USUARIO.id_persona='".$idUsuario."' ");
         return $listarPersonaUsuario ->result()[0];

    }

    public function get_EstudioInversion($anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $idPersona=$this->session->userdata('idPersona');
        if($tipoUsuario==9)
        {
            $q=$this->db->query("EXEC sp_ListarEstudioInversionAnio @opcion= 'listar_estudio_completo',@ue=NULL, @anio=$anio");
            return $q->result();
        }
        else
        {
            $q=$this->db->query("EXEC sp_ListarEstudioInversionAnio @opcion='listar_estudio_persona' , @ue=$ue, @id_persona=$idPersona, @anio=$anio");
            return $q->result();
        }
    }

    public function get_EstudioInversionR()
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        $idPersona=$this->session->userdata('idPersona');
        if($tipoUsuario==9)
        {
            $q=$this->db->query("EXEC sp_ListarEstudioInversion @opcion= 'listar_estudio_completo',@ue=NULL");
            return $q->result();
        }
        else
        {
            $q=$this->db->query("EXEC sp_ListarEstudioInversion @opcion='listar_estudio_persona' , @ue=$ue, @id_persona=$idPersona");
            return $q->result();
        }
    }

    public function getEstudioInversionF($id_persona, $id_et, $idTipoUsuario)
  	{
  		if ($idTipoUsuario == 9) {
  			$data=$this->db->query("select * from ESTUDIO_INVERSION where codigo_unico_est_inv=".$id_et);
  			return $data->result();
  		} else {
  			$data=$this->db->query("select codigo_unico_est_inv from ESTUDIO_INVERSION where codigo_unico_est_inv=".$id_et);
  			if($data->num_rows()>0){
  	   		return $data->result();
  			} else {
  			   return 0;
  			}
  		}
  	}

    public function get_listaproyectos($NombreEstadoFormulacionEvalu)
    {
        $data = $this->db->query("select MAX(id_prog)as id_prog, año_apertura_cartera as anio_apertura,
        nombre_tipo_inversion,ESTADO_CICLO.id_estado_ciclo, nombre_estado_ciclo, PROYECTO_INVERSION.id_pi,
        nombre_pi,PROYECTO_INVERSION.codigo_unico_pi  FROM ESTADO_CICLO inner join ESTADO_CICLO_PI ON ESTADO_CICLO.id_estado_ciclo=ESTADO_CICLO_PI.id_estado_ciclo
        INNER JOIN PROYECTO_INVERSION on ESTADO_CICLO_PI.id_pi=PROYECTO_INVERSION.id_pi INNER JOIN PROGRAMACION on
        PROYECTO_INVERSION.id_pi=PROGRAMACION.id_pi INNER JOIN CARTERA_INVERSION ON CARTERA_INVERSION.id_cartera=PROGRAMACION.id_cartera
        inner join TIPO_INVERSION ON PROYECTO_INVERSION.id_tipo_inversion=TIPO_INVERSION.id_tipo_inversion
        where  TIPO_INVERSION.nombre_tipo_inversion='PIP'
        AND nombre_estado_ciclo='".$NombreEstadoFormulacionEvalu."' AND PROYECTO_INVERSION.id_pi not in (select id_pi from ESTUDIO_INVERSION) GROUP BY año_apertura_cartera, nombre_tipo_inversion,PROYECTO_INVERSION.codigo_unico_pi,
        ESTADO_CICLO.id_estado_ciclo, nombre_estado_ciclo, PROYECTO_INVERSION.id_pi, nombre_pi");
        
        return $data->result();
    }

    public function get_UnidadFormuladora()
    {
        $unidadformuladora = $this->db->query("select id_uf,nombre_uf from UNIDAD_FORMULADORA");
        return $unidadformuladora->result();
    }

    public function get_estado_PI($txtCodigoUnico)
    {
        $estado_pi = $this->db->query("select estado_pi from PROYECTO_INVERSION where codigo_unico_pi='$txtCodigoUnico'");
        return $estado_pi->result();
    }

    public function getCoordinadorEstudio($idEstudioInversion)
    {
        $listaCoordinador = $this->db->query("select r.id_est_inv, r.id_persona, p.nombres+' '+p.apellido_p+' '+p.apellido_m as nombres,r.fecha from RESPONSABLE_ESTUDIO r inner join PERSONA p on r.id_persona=p.id_persona where id_est_inv=$idEstudioInversion");
        return $listaCoordinador->result();
    }

    public function eliminarCoordinadorEstudio($idEstudioInversion,$idPersona)
    {

        $this->db->query("delete from RESPONSABLE_ESTUDIO where id_persona='$idPersona' and id_est_inv='$idEstudioInversion'");
        return $this->db->affected_rows();
    }

    public function get_UnidadEjecutora()
    {
        $unidadejecutora = $this->db->query("select id_ue,nombre_ue from UNIDAD_EJECUTORA");
        return $unidadejecutora->result();
    }

    public function get_persona($idPersona)
    {
        $opcion='listar_persona_exepto';
        $persona = $this->db->query("EXEC sp_Gestionar_Persona @opcion='".$opcion."', @id_persona='".$idPersona."' ");
        return $persona->result();
    }

    public function listaPersona()
    {
        $persona = $this->db->query("select PERSONA.id_persona, CONCAT(PERSONA.nombres, ' ', PERSONA.apellido_p) AS nombres_apell
           FROM   PERSONA");
        return $persona->result();
    }

    public function get_TipoEstudio()
    {
        $TipoEstudio = $this->db->query("select id_tipo_est,nombre_tipo_est from TIPO_ESTUDIO");
        return $TipoEstudio->result();
    }

    public function get_NivelEstudio()
    {
        $NivelEstudio = $this->db->query("select id_nivel_estudio, denom_nivel_estudio from NIVEL_ESTUDIO");
        return $NivelEstudio->result();
    }

    public function get_etapasFE()
    {
        $etapa = $this->db->query("select id_etapa_fe,denom_etapas_fe from ETAPAS_FE");
        return $etapa->result();
    }
    public function get_cargo()
    {
        $cargo = $this->db->query("select id_cargo,desc_cargo from Cargo");
        return $cargo->result();
    }

    public function AddEtapaEstudio($data)
    {
        $this->db->set('en_seguimiento',0);
        $this->db->where('id_est_inv',$data['id_est_inv']);
        $this->db->update('ETAPA_ESTUDIO');
        $this->db->insert('ETAPA_ESTUDIO',$data);
        return $this->db->affected_rows();
    }

    public function AddEstudioInversion($flat, $id_est_inv, $txtCodigoUnico, $txtnombres, $listaFuncionC, $listaTipoInversion, $listaNivelEstudio, $lista_unid_form, $lista_unid_ejec, $txadescripcion, $txtMontoInversion, $txtcostoestudio)
    {
        $EstudioInversion = $this->db->query("execute sp_Gestionar_EstudioInversion_c'"
            . $flat . "','"
            . $id_est_inv . "','"
            . $txtCodigoUnico . "','"
            . $txtnombres . "', '"
            . $listaFuncionC . "', '"
            . $listaTipoInversion . "', '"
            . $listaNivelEstudio . "', '"
            . $lista_unid_form . "', '"
            . $lista_unid_ejec . "', '"
            . $txadescripcion . "', '"
            . $txtMontoInversion . "', '"
            . $txtcostoestudio . "' "

        );

        if ($EstudioInversion->num_rows() > 0) {
            return $EstudioInversion->result();
        } else {
            return false;
        }
    }
    public function AddResponsableEstudio($flat, $id_est_inv, $listaResponsables, $dateFechaAsig)
    {
        //  $EstadoCicloInversion = $this->db->query("execute get");
        $ResponsableEstudio = $this->db->query("execute sp_Gestionar_RespondableEstudio_c'"
            . $flat . "','"
            . $id_est_inv . "', '"
            . $listaResponsables . "', '"
            . $dateFechaAsig . "' ");
        if ($ResponsableEstudio->num_rows() > 0) {
            return $ResponsableEstudio->result();
        } else {
            return false;
        }
    }

    public function AddAsignarPersona($data)
    {
        $this->db->set('estado',0);
        $this->db->where('id_etapa_estudio',$data['id_etapa_estudio']);
        $this->db->update('ASIGNACION_PERSONA');

        $this->db->insert('ASIGNACION_PERSONA',$data);
        return $this->db->affected_rows();
    }
    public function AddCoordinadorEstudio($flat, $Cbx_Persona, $Cbx_Cargo, $txt_IdEtapa_Estudio_p, $txadescripcion)
    {
        //  $EstadoCicloInversion = $this->db->query("execute get");
        $coordinadorEstudio = $this->db->query("execute sp_Gestionar_AsignarPersona_c'"
            . $flat . "','"
            . $Cbx_Persona . "', '"
            . $Cbx_Cargo . "', '"
            . $txt_IdEtapa_Estudio_p . "', '"
            . $txadescripcion . "' ");
        if ($coordinadorEstudio->num_rows() > 0) {
            return $coordinadorEstudio->result();
        } else {
            return false;
        }
    }

    public function AddEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_c'" . $flat . "','" . $txt_IdEstadoCicloInversion . "', '" . $txt_NombreEstadoCicloInversion . "','" . $txt_DescripcionEstadoCicloInversion . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function EliminarEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_d'" . $flat . "','" . $txt_IdEstadoCicloInversion . "', '" . $txt_NombreEstadoCicloInversion . "','" . $txt_DescripcionEstadoCicloInversion . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function UpdateEstadoCicloInversion($flat, $txt_IdEstadoCicloInversionM, $txt_NombreEstadoCicloInversionM, $txt_DescripcionEstadoCicloInversionM)
    {

        $this->db->query("execute SP_Gestionar_EstadoCiclo_c'" . $flat . "','" . $txt_IdEstadoCicloInversionM . "', '" . $txt_NombreEstadoCicloInversionM . "','" . $txt_DescripcionEstadoCicloInversionM . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function AddDocumentosEstudio($data)
    {
        $this->db->insert('DOCUMENTOS_INVERSION',$data);
        return $this->db->affected_rows();
    }
    public function AddDocumentosEstudio2($id_estudio_inv, $txtNombreDocumento, $txtDescripcionDocumento, $url)
    {
        $query= $this->db->query("insert into DOCUMENTOS_INVERSION values(".$id_estudio_inv.",'".$txtNombreDocumento."','".$txtDescripcionDocumento."','".$url."');");

        return true;


    }
    public function get_obtener_ultimo_id()
    {
        $data=$this->db->query("SELECT IDENT_CURRENT('DOCUMENTOS_INVERSION') as idultimo;");
        return $data->result()[0];
    }

    //ver las etpas de estudio
    public function get_etapas_estudio($txtIdEtapaEstudio_v)
    {
        $veretapasestudio = $this->db->query("execute sp_ListarEtapasEstudio '"
            . $txtIdEtapaEstudio_v . "'");
        return $veretapasestudio->result();
    }



    public function eliminarEtapaEstado($idEtapaEstado,$idEstudioInversion)
    {

        $this->db->where('id_etapa_estudio',$idEtapaEstado);
        $this->db->delete('ETAPA_ESTUDIO');

        $this->db->select_max('id_etapa_estudio');
        $this->db->where('id_est_inv',$idEstudioInversion);
        $query = $this->db->get('ETAPA_ESTUDIO')->result();

        $this->db->set('en_seguimiento',1);
        $this->db->where('id_etapa_estudio', $query[0]->id_etapa_estudio);
        $this->db->update('ETAPA_ESTUDIO');
        return $this->db->affected_rows();
    }

    public function GetDocumentosEstudio($id_est_inv)
    {
        $documentos = $this->db->query("select id_documento,id_est_inv,nombre_documento,desc_documento,url_documento from DOCUMENTOS_INVERSION where id_est_inv=$id_est_inv");
        if ($documentos->num_rows() > 0) {
            return $documentos->result();
        } else {
            return false;
        }
    }

    public function GetProyectosEstudio()
    {
        $datos = $this->db->query("select uf.id_est_inv, py.id_pi, py.codigo_unico_pi, uf.nombre_estudio_inv, f.nombre_funcion, uf.costo_estudio, p.nombres+' '+p.apellido_p+' '+p.apellido_m as coordinador from uf_estudio_inversion_2 uf inner join proyecto_inversion py on py.id_pi = uf.id_pi
inner join grupo_funcional gf on py.id_grupo_funcional= gf.id_grup_funcional
inner join division_funcional df on df.id_div_funcional = gf.id_div_funcional
inner join funcion f on f.id_funcion = df.id_funcion
inner join persona p on p.id_persona = uf.id_persona
");
        if ($datos->num_rows() > 0)
        {
            return $datos->result();
        }
        else
        {
            return false;
        }
    }

    public function GetProyectosparaEstudio($anio)
    {
        $datos = $this->db->query("exec sp_Gestionar_UfEstudioInversion @opcion = 'listar_pip_programados',
        @anio_cartera = '$anio'");

        if ($datos->num_rows() > 0)
        {
            return $datos->result();
        }
        else
        {
            return false;
        }
    }

    public function get_coordinador()
    {
        $datos = $this->db->query("exec sp_Gestionar_UsuarioTipo 'listar_usuarios_por_tipo', 'coordinador'");

        if ($datos->num_rows() > 0)
        {
            return $datos->result();
        }
        else
        {
            return false;
        }

    }

    public function GetProyectoParaEstudioInversion($anio, $id_pi)
    {
        $datos = $this->db->query("exec sp_Gestionar_UfEstudioInversion @opcion = 'listar_pip_programados', @anio_cartera= '$anio', @id_pi = '$id_pi'");

        if ($datos->num_rows() > 0)
        {
            return $datos->result()[0];
        }
        else
        {
            return false;
        }
    }

    public function RegistrarEstudioInversion($idPersona,$nombreEstudio,$idPi,$idTipoEstudio,$idNivelEstudio,$idUnidadFormuladora,$idUnidadEjecutora,$descripcionEstudio,$montoInversion,$costoEstudio)
    {
        $this->db->query("exec sp_Gestionar_UfEstudioInversion_c @opcion = 'C',
        @id_persona = '$idPersona',
        @nombre_estudio_inv = '$nombreEstudio',
        @id_pi = '$idPi',
        @id_tipo_est = '$idTipoEstudio',
        @id_nivel_estudio = '$idNivelEstudio',
        @id_uf='$idUnidadFormuladora',
        @id_ue = '$idUnidadEjecutora',
        @des_est_inv = '$descripcionEstudio',
        @monto_inv = '$montoInversion',
        @costo_estudio ='$costoEstudio' ,
        @etapa_estu = NULL,
        @fecha_etapa = NULL ,
        @monto_etapa = NULL,
        @avance = NULL");
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public function get_listaproyectosCargar($id_Pi)
    {
          $opcion="obtenerdatosporpipdelabusquedaproyectoinversion";
          $EstudioInversionCargar = $this->db->query("execute  sp_Gestionar_ProyectoInversion @Opcion='".$opcion."',@id_pi='".$id_Pi."'");
            if ($EstudioInversionCargar->num_rows() > 0)
          {
              return $EstudioInversionCargar->result();
          }
    }

    public function EstudioCoordinadorF()
    {
        $opcion="listarEstudioCoordinador";
        $data=$this->db->query("execute sp_Gestionar_UFEstudioInversionF @opcion='".$opcion."'");

        return $data->result();
    }
}
