<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Preliquidacion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listPreliquidacion() {
      $data = $this->db->get('Liq_proyecto');
      return $data->result();
    }

    public function listPreliquidacionById($id_liq_proyecto) {
      $this->db->select('*');
      $this->db->from('Liq_proyecto');
      $this->db->where('id_liq_proyecto', $id_liq_proyecto);
      $data = $this->db->get();
      return $data->result();
    }

    public function getNameProject($codigo_unico) {
      $this->db->select('*');
      $this->db->from('PROYECTO_INVERSION');
      $this->db->join('UNIDAD_EJECUTORA', 'UNIDAD_EJECUTORA.id_ue = PROYECTO_INVERSION.id_ue');
      $this->db->where('codigo_unico_pi', $codigo_unico);
      $data = $this->db->get();
      return $data->result();
    }

    public function getCodigoUnico($id_pi) {
      $this->db->select('codigo_unico_pi');
      $this->db->from('PROYECTO_INVERSION');
      $this->db->where('id_pi', $id_pi);
      $data = $this->db->get();
      return $data->result();
    }

    public function insertarPreLiq($data)
    {
      $this->db->insert('Liq_proyecto', $data);
      return $insert_id = $this->db->insert_id();
    }

    public function updatePreLiq($data, $id_liq_proyecto)
    {
      $this->db->where('id_liq_proyecto', $id_liq_proyecto);
      $this->db->update('Liq_proyecto', $data);
    }

    public function insertarPersonal($data2)
    {
      $this->db->insert('Liq_pre_personal', $data2);
      return $this->db->affected_rows();
    }

    public function updatePersonal($data2, $id_pre_persona)
    {
      $this->db->where('id_pre_persona', $id_pre_persona);
      $this->db->update('Liq_pre_personal', $data2);
    }

    public function listarPersonal($id_liq_proyecto)
    {
      $this->db->select('liq_pre_personal.*, persona.*');
      $this->db->from('liq_pre_personal');
      $this->db->join('persona', 'persona.id_persona = liq_pre_personal.id_persona');
      $this->db->where('liq_pre_personal.id_liq_proyecto', $id_liq_proyecto);

      $query = $this->db->get();

      if($query->num_rows() > 0) {
        $results = $query->result();
      }
      return $results;
    }

    public function eliminar($id_liq_proyecto)
    {
      $this->db->trans_start();
      $this->db->query("DELETE FROM Liq_pre_personal WHERE id_liq_proyecto='$id_liq_proyecto';");
      $this->db->query("DELETE FROM Liq_proyecto WHERE id_liq_proyecto='$id_liq_proyecto';");
      $this->db->trans_complete();
      return $this->db->affected_rows();
    }
}
