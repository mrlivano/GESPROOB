<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_OficinaR extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function listaOficinaNivel1($id_ue)
    {
        $nivel1=$this->db->query("SELECT o1.id_oficina, o1.denom_oficina, count(o2.id_oficina) as n, o1.id_ue from oficinaR o1 left join oficinaR o2 on  o1.id_oficina=o2.id_oficiNaP WHERE o1.id_ue=".$id_ue." group by o1.id_oficina,o1.denom_oficina,o1.id_ue");
        return $nivel1->result();
    }
   function listaOficinaporNivel($id_oficina)
    {
        $data=$this->db->query("SELECT o1.id_oficina, o1.denom_oficina, count(o2.id_oficina) as n, o1.id_ue from oficinaR o1 left join oficinaR o2 on  o1.id_oficina=o2.id_oficiNaP where o1.id_oficinaP=".$id_oficina." group by o1.id_oficina, o1.denom_oficina, o1.id_ue");
        return $data->result();
    }

   function EliminarOficinaR($id_oficina){
        $this->db->where('id_oficina',$id_oficina);
        $this->db->delete('oficinaR');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

  function UpdateOficinaR($id_oficinaR, $denominacion_oficinaR)
    {
       $this->db->set('denom_oficina', $denominacion_oficinaR);
       $this->db->where('id_oficina', $id_oficinaR);
       $this->db->update('oficinaR');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

  function InsertarOficinaR($id_oficinaP, $denominacion_oficinaR,$id_ue)
    {
        if($id_oficinaP==NULL or $id_oficinaP==""){
          $lista = $this->db->query("SELECT * FROM OFICINAR WHERE denom_oficina='".$denominacion_oficinaR."' and id_ue='".$id_ue."'");
           if($lista->num_rows()>0){
            return false;
           }
           else
            {
             $data = array(
                'id_oficiNaP'=> NULL,
                'denom_oficina'=> $denominacion_oficinaR,
                'id_ue'=> $id_ue,
            );
            $this->db->insert('oficinar', $data);
                   if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
           }
        }
        else{
           $lista = $this->db->query("SELECT * FROM OFICINAR WHERE denom_oficina='".$denominacion_oficinaR."' and id_oficinaP='".$id_oficinaP."'");
           if($lista->num_rows()>0){
            return false;
           }
           else
            {
             $data = array(
                'id_oficiNaP'=> $id_oficinaP,
                'denom_oficina'=> $denominacion_oficinaR,
                'id_ue'=> NULL,
            );
            $this->db->insert('oficinar', $data);
                   if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
           }
        }
       
    }

 function insertarMeta($data)
    {
        $this->db->insert('META_OFICINAR',$data);
        return $this->db->insert_id(); 
    }

 public function listar_metas_oficina($id_oficina, $anio_meta)
    {
        $listar_metas_oficina = $this->db->query("select m.id_oficinaR_meta,m.sec_func,m.finalidad,m.act_proy,a.nombre from META_OFICINAR m INNER JOIN DBSIAF.dbo.act_proy_nombre a ON m.act_proy=a.act_proy and m.ano_eje=a.ano_eje WHERE id_oficinaR='".$id_oficina."'  and m.ano_eje='".$anio_meta."'");
        if ($listar_metas_oficina->num_rows() > 0) {
            return $listar_metas_oficina->result();
        } else {
            return false;
        }
    }

    
     function eliminarMeta($id_oficinameta)
    {
        $this->db->where('id_oficinaR_meta', $id_oficinameta);
        $this->db->delete('META_OFICINAR');
        return $this->db->affected_rows();
    }

    function listarMeta($anio_meta,$sec_ejec)
    {
        $funcion = $this->db->query("select m.sec_func,f.nombre,m.act_proy from DBSIAF.dbo.meta m LEFT JOIN DBSIAF.dbo.finalidad f on m.finalidad=f.finalidad and m.ano_eje=f.ano_eje LEFT JOIN Meta_oficinar mo on m.sec_func=mo.sec_func and m.ano_eje=mo.ano_eje and m.act_proy=mo.act_proy where sec_ejec=".$sec_ejec." and m.ano_eje='".$anio_meta."' and mo.sec_func is null order by sec_func asc");//listar meta
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    public function cargarMeta($sec_func,$anio_meta,$sec_ejec)
    {
        $data=$this->db->query("execute sp_CargarMeta @sec_func ='$sec_func', @anio_meta='$anio_meta', @sec_ejec=$sec_ejec");
        return $data->result();
    }
}