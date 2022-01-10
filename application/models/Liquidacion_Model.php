<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Liquidacion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cargarMetaPi($anio,$codigoUnico)
    {
        $data=$this->db->query("execute sp_ListarMontosProyectoAnio @anio_meta ='$anio', @codigo_unico='$codigoUnico'");
        return $data->result();
    }
    public function correlativoMeta($correlativo)
    {
        $data=$this->db->query("select * from correlativo_meta where cod_correlativo='".$correlativo."'");
        return $data->result()[0];
    }

    public function editarLiquidacion($id_descripcion,$m_data)
    {
        $this->db->set($m_data);
        $this->db->where('id_descripcion', $id_descripcion);
        $this->db->update('Liq_pre_descripcion');
        return $this->db->affected_rows();
    }
    //Add meta presupuestal
    public function AddLiquidacion($data)
    {
        $this->db->insert('Liq_pre_descripcion',$data);
        return $this->db->affected_rows();

    }
    public function listar_liquidacion()
    {
      $this->db->select('id_descripcion, descripcion');
      $listar_liquidacion = $this->db->get('Liq_pre_descripcion');
      if ($listar_liquidacion->num_rows() > 0) {
          return $listar_liquidacion->result();
      } else {
          return false;
      }
    }

    //eliminar meta presupuestal
    public function Eliminar_liquidacion($id_descripcion)
    {
      $this->db->delete('Liq_pre_descripcion', array('id_descripcion' => $id_descripcion));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    /*Listar Correlativo*/
    public function listar_correlativo()
    {
        $listar_correlativo = $this->db->query("SELECT * FROM CORRELATIVO_META");
        if ($listar_correlativo->num_rows() > 0) {
            return $listar_correlativo->result();
        } else {
            return false;
        }
    }
    /*Listar meta presupuestal*/
    public function listar_meta_presupuestal()
    {
        $listar_meta_presupuestal = $this->db->query("SELECT * FROM META_PRESUPUESTAL");
        if ($listar_meta_presupuestal->num_rows() > 0) {
            return $listar_meta_presupuestal->result();
        } else {
            return false;
        }
    }

    //PRE LIQUIDACION
    public function listar_pre_liquidacion($id_pl)
    {
      $flag = false;
      $id_pl_exists = $this->db->query("SELECT id_liq_proyecto FROM Liq_det_preliquidacion");

      foreach ($id_pl_exists->result() as $row)
      {
        if ($row->id_liq_proyecto == $id_pl) {
          $flag = true;
          break;
        }
      }
      if ($flag) {

      } else {
        $listar_correlativo = $this->db->query("INSERT INTO Liq_det_preliquidacion (id_descripcion, id_liq_proyecto) SELECT id_descripcion, ".$id_pl." FROM Liq_pre_descripcion");
      }

      $this->db->select('Liq_det_preliquidacion.id_liq_det_preliquidacion, Liq_det_preliquidacion.id_descripcion, Liq_pre_descripcion.descripcion, Liq_det_preliquidacion.estado');
      $listar_liquidacion = $this->db->from('Liq_det_preliquidacion');
      $listar_liquidacion = $this->db->join('Liq_pre_descripcion', 'Liq_pre_descripcion.id_descripcion = Liq_det_preliquidacion.id_descripcion');
      $listar_liquidacion = $this->db->where('id_liq_proyecto', $id_pl);
      $listar_liquidacion = $this->db->get();

        if ($listar_liquidacion->num_rows() > 0) {
            return $listar_liquidacion->result();
        } else {
            return false;
        }
    }

    public function updatePreliquidacionDoc($id_d_pl, $estado)
    {

      $data = array(
        'estado' => $estado
      );

      $this->db->where('id_liq_det_preliquidacion', $id_d_pl);
      $this->db->update('Liq_det_preliquidacion', $data);

    }

}
