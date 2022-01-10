<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_SubGerencia extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();
    }

    /*añadir funcion*/
    function GetSubGerencia()
    {
        $funcion = $this->db->query("SELECT g.denom_gerencia, s.id_subgerencia, s.id_gerencia, s.denom_subgerencia, u.codigo_ue, u.nombre_ue FROM GERENCIA g INNER JOIN SUB_GERENCIA s ON g.id_gerencia = s.id_gerencia INNER JOIN UNIDAD_EJECUTORA u ON u.id_ue = g.id_ue");//listar
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    function AddSubGerencia($id_gerencia, $denominacion)
    {

        $this->db->query("sp_SubGerencia_c '" . $id_gerencia . "','" . $denominacion . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function UpdateSubGerencia($id_subgerencia, $id_gerencia, $denominacion)
    {
        $this->db->query("sp_SubGerencia_u '" . $id_subgerencia . "','" . $id_gerencia . "','" . $denominacion . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function EliminarSubGerencia($id_subgerencia){
        $this->db->where('id_subgerencia',$id_subgerencia);
        $this->db->delete('SUB_GERENCIA');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
     public function SubGerenciaPorGerencia($idGerencia)
    {
      $data=$this->db->query("select * from SUB_GERENCIA where id_gerencia='$idGerencia' order by denom_subgerencia");

      return $data->result();
    }

     function listarMeta($anio_meta,$sec_ejec)
    {
        $funcion = $this->db->query("select sec_func,f.nombre from DBSIAF.dbo.meta m LEFT JOIN DBSIAF.dbo.finalidad f on m.finalidad=f.finalidad and m.ano_eje=f.ano_eje where sec_ejec=".$sec_ejec." and m.ano_eje='".$anio_meta."' order by sec_func asc");//listar meta
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    public function listar_metas_subgerencia($id_subgerencia, $anio_meta)
    {
        $listar_metas_subgerencia = $this->db->query("select m.id_subgerenciameta,m.sec_func,m.finalidad,m.act_proy,a.nombre from META_SUBGERENCIA m INNER JOIN DBSIAF.dbo.act_proy_nombre a ON m.act_proy=a.act_proy and m.ano_eje=a.ano_eje WHERE id_subgerencia='".$id_subgerencia."'  and m.ano_eje='".$anio_meta."'");
        if ($listar_metas_subgerencia->num_rows() > 0) {
            return $listar_metas_subgerencia->result();
        } else {
            return false;
        }
    }

      public function cargarMeta($sec_func,$anio_meta,$sec_ejec)
    {
        $data=$this->db->query("execute sp_CargarMeta @sec_func ='$sec_func', @anio_meta='$anio_meta', @sec_ejec=$sec_ejec");
        return $data->result();
    }

     function insertarMeta($data)
    {
        $this->db->insert('META_SUBGERENCIA',$data);
        return $this->db->insert_id(); 
    }

     function eliminarMeta($id_subgerenciameta)
    {
        $this->db->where('id_subgerenciameta', $id_oficinameta);
        $this->db->delete('META_SUBGERENCIA');
        return $this->db->affected_rows();
    }

}