<?php
defined('BASEPATH') or exit('No direct script access allowed');
class NoPipProgramados_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetNoPipProgramados($flat, $anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GetNoPipProgramados = $this->db->query("execute sp_ListarProyectoInversionNoPipProgramado '".$flat."', '"
            .$anio."', @ue=NULL");
            return $GetNoPipProgramados->result();
        }
        else
        {
           $GetNoPipProgramados = $this->db->query("execute sp_ListarProyectoInversionNoPipProgramado '".$flat."', '"
            .$anio."', @ue=$ue");
            return $GetNoPipProgramados->result();
        }  
    }

    public function ListarPipProgramados()
    {
       $ListarPipProgramados = $this->db->query("SELECT * FROM  TIPO_NOPIP"); 
       return $ListarPipProgramados->result();
    }

    public function  listarNopip($desc_tipo_nopip)
    {
       $opcion='listar_nopip_programados_por_tiponopip';
       $ListarPipProgramados = $this->db->query("execute sp_Gestionar_ProyectoInversion @opcion='". $opcion."', @desc_tipo_nopip='".$desc_tipo_nopip."' "); 
       return $ListarPipProgramados->result();
    }

    public function AddEstudioInversionNoPIP($id_pi,$TipoNoPip)
    {
       $opcion='insertar';
       $ListarNoPipProgramados = $this->db->query("execute sp_Gestionar_NOPIP_FE_c @opcion='". $opcion."', @nombre_est_inv='".$TipoNoPip."',@id_pi='".$id_pi."' "); 
       return true;
    }

    public function NoPipFormulacionEvaluacionListar()
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $data=$this->db->query("select id_est_inv, codigo_unico_pi, nombre_est_inv, TIPO_NOPIP.desc_tipo_nopip from ESTUDIO_INVERSION INNER JOIN PROYECTO_INVERSION ON ESTUDIO_INVERSION.id_pi=PROYECTO_INVERSION.id_pi INNER JOIN NOPIP ON PROYECTO_INVERSION.id_pi=NOPIP.id_pi INNER JOIN TIPO_NOPIP ON NOPIP.id_tipo_nopip=TIPO_NOPIP.id_tipo_nopip");

            return $data->result();
        }
        else
        {
            $data=$this->db->query("select id_est_inv, codigo_unico_pi, nombre_est_inv, TIPO_NOPIP.desc_tipo_nopip from ESTUDIO_INVERSION INNER JOIN PROYECTO_INVERSION ON ESTUDIO_INVERSION.id_pi=PROYECTO_INVERSION.id_pi INNER JOIN NOPIP ON PROYECTO_INVERSION.id_pi=NOPIP.id_pi INNER JOIN TIPO_NOPIP ON NOPIP.id_tipo_nopip=TIPO_NOPIP.id_tipo_nopip where PROYECTO_INVERSION.id_ue=$ue");

            return $data->result();
        }               
    }

     public function listarUltimoEstudioInversion()
    {
        $data=$this->db->query("select MAX (id_est_inv)as id_est_inv from ESTUDIO_INVERSION");

        return $data->result()[0];
    }

    public function listarUltimoDocumentoInversion()
    {
        $data=$this->db->query("select MAX (id_documento)as id_documento from DOCUMENTOS_INVERSION");

        return $data->result()[0];
    }

    public function NoPip($id)
    {

        $data=$this->db->query("select * from ESTUDIO_INVERSION where id_est_inv='".$id."'");

        return $data->result()[0];
    }
    
    function editar($id, $txtNombreNoPip)
    {
        $data=$this->db->query(" update ESTUDIO_INVERSION SET nombre_est_inv='".$txtNombreNoPip."' where id_est_inv='".$id."'");

        return true;
    }
}
