<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PipProgramados_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetPipProgramadosFormulacionEvaluacion($flat, $anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GetPipProgramadosFormulacionEvaluacion = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=NULL");
            return $GetPipProgramadosFormulacionEvaluacion->result();
        }
        else
        {
            $GetPipProgramadosFormulacionEvaluacion = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=$ue");
            return $GetPipProgramadosFormulacionEvaluacion->result();
        }        
    }
    public function GetPipProgramadosEjecucion($flat, $anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GetPipProgramadosEjecucion = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=NULL");
            return $GetPipProgramadosEjecucion->result();
        }
        else
        {
            $GetPipProgramadosEjecucion = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=$ue");
            return $GetPipProgramadosEjecucion->result();
        }
    }
    public function GetPipOperacionMantenimiento($flat, $anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GetPipOperacionMantenimiento = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=NULL");
            return $GetPipOperacionMantenimiento->result();
        }
        else
        {
            $GetPipOperacionMantenimiento = $this->db->query("execute sp_ListarProyectoInversionProgramado '".$flat."', '".$anio."', @ue=$ue");
            return $GetPipOperacionMantenimiento->result();
        }
        
    }

}
