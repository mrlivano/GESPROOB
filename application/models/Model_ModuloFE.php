<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ModuloFE extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function ListarModulo()
	{
		$modulo=$this->db->query("select * from UF_MODULO"); 		
		return $modulo->result();
	} 

	function insertar($txtNombre)
  	{
	  	$sql = "insert into UF_MODULO (nombre_modulo) values(".$this->db->escape($txtNombre).")";
		$error='1';
		if (!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
  	}

  	function EditarModuloFE($id)
	{
		$moduloFE=$this->db->query("select * from UF_MODULO where id_modulo='".$id."'");
		return $moduloFE->result();
	}

	function ModuloPorNombre($nombre)
	{
		$modulo=$this->db->query("select * from UF_MODULO where replace(nombre_modulo, ' ', '')=replace('".$nombre."', ' ', '')");
		return $modulo->result();
	}

	function ModuloPorNombreDifId($id, $nombre)
	{
		$modulo=$this->db->query("select * from UF_MODULO where id_modulo!='".$id."' and replace(nombre_modulo, ' ', '')=replace('".$nombre."', ' ', '')");
		return $modulo->result();
	}

  	function editar($id,$txtNombre)
  	{
  		$sql="update UF_MODULO set nombre_modulo=".$this->db->escape($txtNombre)." where id_modulo=$id";
	  	$error="1";
	  	if (!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
  	}

  	function eliminar($idModulo)
  	{
  		$this->db->query("delete from UF_MODULO where id_modulo = '".$idModulo."'");
  		return "1";
  	}
}