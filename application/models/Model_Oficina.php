<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Oficina extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();
    }

    /*añadir funcion*/
    function GetOficina()
    {
        $sql = "sp_GetOficina";
        $funcion = $this->db->query($sql);//listar funcion
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    function AddOficina($id_sub_gerencia, $denominacion_oficina)
    {
        $this->db->query("sp_Oficina_c '" . $id_sub_gerencia . "','" . $denominacion_oficina . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function UpdateOficina($id_oficina, $id_subgerencia, $denominacion_gerencia)
    {
        $this->db->query("sp_Oficina_u '" . $id_oficina . "','" . $id_subgerencia . "','" . $denominacion_gerencia . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function EliminarOficina($id_oficina){
        $this->db->where('id_oficina',$id_oficina);
        $this->db->delete('OFICINA');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    function GetOficinaId($id_subgerencia){
            $Oficina=$this->db->query("execute sp_OficinaPorSubgerencia'".$id_subgerencia."' ");
            //listar de division funcional
            return $Oficina->result();

          }

    function OficinaPorSubGerencia($id_subgerencia)
      {
        $data = $this->db->query("select * from OFICINA where id_subgerencia='$id_subgerencia'");

        return $data->result();
      }

       function listarMeta($anio_meta,$sec_ejec)
    {
        $funcion = $this->db->query("select sec_func,f.nombre,m.act_proy from DBSIAF.dbo.meta m LEFT JOIN DBSIAF.dbo.finalidad f on m.finalidad=f.finalidad and m.ano_eje=f.ano_eje where sec_ejec=".$sec_ejec." and m.ano_eje='".$anio_meta."' order by sec_func asc");//listar meta
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    public function listar_metas_oficina($id_oficina, $anio_meta)
    {
        $listar_metas_oficina = $this->db->query("select m.id_oficinameta,m.sec_func,m.finalidad,m.act_proy,a.nombre from META_OFICINA m INNER JOIN DBSIAF.dbo.act_proy_nombre a ON m.act_proy=a.act_proy and m.ano_eje=a.ano_eje WHERE id_oficina='".$id_oficina."'  and m.ano_eje='".$anio_meta."'");
        if ($listar_metas_oficina->num_rows() > 0) {
            return $listar_metas_oficina->result();
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
        $this->db->insert('META_OFICINA',$data);
        return $this->db->insert_id(); 
    }
    
     function eliminarMeta($id_oficinameta)
    {
        $this->db->where('id_oficinameta', $id_oficinameta);
        $this->db->delete('META_OFICINA');
        return $this->db->affected_rows();
    }
}