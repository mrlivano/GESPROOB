<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_TipoGastoFE extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ListarTipoGastoFE()
	{
		$tipoGasto=$this->db->query("execute sp_FETipoGasto_Listar"); 
		
		return $tipoGasto->result();
	} 


	function insertar($txtDescripcion)
  	{
		$sql = "insert into FE_TIPO_GASTO (desc_tipo_gasto) values(".$this->db->escape($txtDescripcion).")";		
		$error='1';
		if (!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
  	}

  	function TipoGastoFE($id)
	{
		$tipoGastoFE=$this->db->query("select * from FE_TIPO_GASTO where id_tipo_gasto='".$id."'");

		return $tipoGastoFE->result();
	}

	function TipoGastoFEPorDescripcion($descripcion)
	{
		$tipoGastoFE=$this->db->query("select * from FE_TIPO_GASTO where replace(desc_tipo_gasto, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $tipoGastoFE->result();
	}

	function TipoGastoFEPorDescripcionDiffId($id, $descripcion)
	{
		$tipoGastoFE=$this->db->query("select * from FE_TIPO_GASTO where id_tipo_gasto!='".$id."' and replace(desc_tipo_gasto, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $tipoGastoFE->result();
	}

  	function editar($id,$txtDescripcion)
  	{
	  	$sql="update FE_TIPO_GASTO set desc_tipo_gasto=".$this->db->escape($txtDescripcion)." where id_tipo_gasto=$id";
	  	$error="1";
	  	if (!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
  	}
  	function eliminar($id_tipo_gasto)
  	{
  		$this->db->where('id_tipo_gasto', $id_tipo_gasto);
        $this->db->delete('FE_TIPO_GASTO');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
       // return $this->db->affected_rows();
  	}
}