<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_EstadoEtapa_FE extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function GetEstadoEtapa_FE($flat, $id_estado, $txt_IdEtapa_Estudio_FE)
    {
        $EstadoEtapa = $this->db->query("execute sp_Gestionar_Estado_Etapa'"
            . $flat . "','"
            . $id_estado . "', '"
            . $txt_IdEtapa_Estudio_FE . "' ");
        return $EstadoEtapa->result();
    }
    public function AddEstadoEtapa_FE($data)
    {
        $this->db->insert('ESTADO_ETAPA',$data);
        return $this->db->affected_rows();
    }

}
