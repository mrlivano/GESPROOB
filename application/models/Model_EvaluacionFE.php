<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_EvaluacionFE extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function GetDetallesituacionActual($codigo_unico_est_inv)
    {
        $detSitAcPipEval = $this->db->query("execute sp_detalleSitActPipEvaluacion1'" . $codigo_unico_est_inv . "'");
        return $detSitAcPipEval->result();
    }

    public function GetEvaluacionFE($id_est_inve)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $EvaluacionFE=$this->db->query("execute sp_ListarEstudioEtapas @id_estudio_inv=".$id_est_inve." , @desc_etapa='Eval%' , @etapa_en_seguimiento=1, @ue=NULL");
            return $EvaluacionFE->result();
        }
        else
        {
            $EvaluacionFE=$this->db->query("execute sp_ListarEstudioEtapas @id_estudio_inv=".$id_est_inve." , @desc_etapa='Eval%' , @etapa_en_seguimiento=1,@ue=$ue");
            return $EvaluacionFE->result();
        }           
    }

    public function GetEvaluadores($desc_cargo)
    {
        $Evaluador = $this->db->query("execute sp_ListarEvaluadoresFE_r'" . $desc_cargo. "'");
        if ($Evaluador->num_rows() >= 0) {
            return $Evaluador->result();
        } else {
            return false;
        }

    }
}
