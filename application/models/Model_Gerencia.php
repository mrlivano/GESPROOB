<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Gerencia extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();
    }

    /*añadir funcion*/
    function GetGerencia()
    {
        $funcion = $this->db->query("select id_gerencia,u.id_ue, denom_gerencia, u.nombre_ue, u.codigo_ue from GERENCIA g, UNIDAD_EJECUTORA u where g.id_ue=u.id_ue");//listar funcion
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }

    }
    function GetListaGerencia()
    {
        $data=$this->db->query("select id_gerencia,denom_gerencia from GERENCIA  order by denom_gerencia");
        return $data->result();
    }
    
    function AddGerencia($denominacion_gerencia,$denominacion_unidad_ejecutora)
    {

        $this->db->query("sp_Gerencia_c '" . $denominacion_gerencia . "','".$denominacion_unidad_ejecutora."'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    function UpdateGerencia($id_gerencia, $denominacion_gerencia,$id_unidad_ejecutora)
        {
            $this->db->query("sp_Gerencia_u '" . $id_gerencia . "','" . $denominacion_gerencia .  "','" . $id_unidad_ejecutora ."'");
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }

        }

    function EliminarGerencia($id_gerencia){
        $this->db->where('id_gerencia',$id_gerencia);
        $this->db->delete('GERENCIA');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
       }

    public function GerenciaPorUnidadE($idUnidadE)
    {
      $data=$this->db->query("select * from GERENCIA where id_ue='$idUnidadE' order by denom_gerencia");

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

    public function listar_metas_gerencia($id_gerencia, $anio_meta)
    {
        $listar_metas_gerencia = $this->db->query("select m.id_gerenciameta,m.sec_func,m.finalidad,m.act_proy,a.nombre from META_GERENCIA m INNER JOIN DBSIAF.dbo.act_proy_nombre a ON m.act_proy=a.act_proy and m.ano_eje=a.ano_eje WHERE id_gerencia='".$id_gerencia."'  and m.ano_eje='".$anio_meta."'");
        if ($listar_metas_gerencia->num_rows() > 0) {
            return $listar_metas_gerencia->result();
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
        $this->db->insert('META_GERENCIA',$data);
        return $this->db->insert_id(); 
    }

     function eliminarMeta($id_gerenciameta)
    {
        $this->db->where('id_gerenciameta', $id_oficinameta);
        $this->db->delete('META_GERENCIA');
        return $this->db->affected_rows();
    }

    //fin division funciona
    //grupo funcional

}