<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_FEsituacion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }
    /*añadir funcion*/
    public function get_FEsituacion()
    {
        $FEsituacion = $this->db->query("select id_situacion_fe,denom_situacion_fe from Situacion_FE"); //listar funcion
        if ($FEsituacion->num_rows() >= 0) {
            return $FEsituacion->result();
        } else {
            return false;
        }

    }
    public function add_FEsituacion($txt_SituacionFE)
    {

        $this->db->query("insert into SITUACION_FE(denom_situacion_fe) values ('$txt_SituacionFE')");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function update_FEsituacion($id_situacion_fe, $denom_situacion_fe)
    {
        $this->db->query("update SITUACION_FE set denom_situacion_fe='$denom_situacion_fe' where id_situacion_fe='$id_situacion_fe' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function AddSituacion($data)
    {
        $this->db->insert('SITUACION_ACTUAL',$data);
        return $this->db->affected_rows();
    }

    function EliminarSituacion($id_situacion_fe){
      $this->db->where('id_situacion_fe',$id_situacion_fe);
      $this->db->delete('SITUACION_FE');
      if($this->db->affected_rows()>0){
        return true;
      }
      else{
        return false;
      }
    }
}
