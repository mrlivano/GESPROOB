<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_ModalidadE extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Insertar_modalidade($data)
    {
          $this->db->insert('modalidad_ejecucion_pi', $data);
          return $this->db->affected_rows() > 0;
    }

    public function AddModalidadE($txt_NombreModalidadE)
    {
        $this->db->query("execute sp_ModalidadE_c'" . $txt_NombreModalidadE . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetModalidadE()
    {
        $modalidade = $this->db->query("execute sp_ModalidadE_r"); //PROCEDIMIENTO DE LISTAR MODALIDAD DE EJECUCION
        if ($modalidade->num_rows() > 0) {
            return $modalidade->result();
        } else {
            return false;
        }
    }

    public function UpdateModalidadE($id_modalidad_ejec, $nombre_modalidad_ejec)
    {

        $this->db->query("execute sp_ModalidadE_u '" . $id_modalidad_ejec . "','" . $nombre_modalidad_ejec . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar($id_eli)
    {
        $this->db->where('id_modalidad_ejec', $id_eli);
        $this->db->delete('Modalidad_ejecucion');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function ListaModalidad()
    { 
        $data = $this->db->query("select * from MODALIDAD_EJECUCION order by nombre_modalidad_ejec");

        return $data->result();
    }
}
