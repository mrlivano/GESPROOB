<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FEformulacion_Modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function GetFormulacion($id_est_inve, $idPersona, $TipoUsuario)
    {
        $opcion        = "listar_estudio_formulacion";
        $id_est_inve   = 0;
        if($TipoUsuario==9) {
            $idPersona = 0;
        }

        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $FEformulacion=$this->db->query("execute sp_ListarEstudioFyE @id_estudio_inv='".$id_est_inve."', @opcion='".$opcion."', @id_persona='".$idPersona."',@ue=NULL");
            return $FEformulacion->result();
        }
        else
        {
            $FEformulacion=$this->db->query("execute sp_ListarEstudioFyE @id_estudio_inv='".$id_est_inve."' ,@opcion='".$opcion."', @id_persona='".$idPersona."', @ue=$ue");
            return $FEformulacion->result();
        }         
    }

    public function GetFEViabilizado($id_est_inve)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $ViabFE=$this->db->query("execute sp_ListarEstudioEtapas @id_estudio_inv=".$id_est_inve." , @desc_etapa='Viab%' , @etapa_en_seguimiento=1,@ue=NULL");
            return $ViabFE->result();
        }
        else
        {
            $ViabFE=$this->db->query("execute sp_ListarEstudioEtapas @id_estudio_inv=".$id_est_inve." , @desc_etapa='Viab%' , @etapa_en_seguimiento=1,@ue=$ue");
            return $ViabFE->result();
        }         
    }

    public function UFEstudioInversionFormulacion()
    {

        $opcion      = "listarEstudioFormulador";
        $FEAprobados = $this->db->query("execute sp_Gestionar_UFEstudioInversionF @opcion='" . $opcion . "'");
        return $FEAprobados->result();

    }
}
