<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Unidad_Medida extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function UnidadMedidad_Listar()
	{
		$unidadMedida=$this->db->query("execute sp_UnidadMedida_Listar");

	    return $unidadMedida->result();
	}

	public function insertarUnidadMedida($data)
	{
		$this->db->insert('UNIDAD_MEDIDA',$data);

		return $this->db->insert_id();
	}

	function insertar($txtDescripcion, $txtAbreviatura)
	{
		$sql = "insert into UNIDAD_MEDIDA (descripcion,abreviatura) values(".$this->db->escape($txtDescripcion).", '".$txtAbreviatura."')";
		$error='1';
		if (!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
	}
	
	function insertarUM($txtDescripcion, $txtAbreviatura)
	{
		$sql = "insert into UNIDAD_MEDIDA (descripcion,abreviatura) values(".$this->db->escape($txtDescripcion).", '".$txtAbreviatura."')";
		return $this->db->insert_id();
	}
	function UnidadMedida($id)
	{
		$unidadMedida=$this->db->query("select * from UNIDAD_MEDIDA where id_unidad='".$id."' ");

		return $unidadMedida->result();
	}

	function UnidadMedidaPorDescripcion($descripcion)
	{
		$unidadMedida=$this->db->query("select * from UNIDAD_MEDIDA where replace(descripcion, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $unidadMedida->result();
	}

	function UnidadMedidaPorDescripcionDiffId($id, $descripcion)
	{
		$unidadMedida=$this->db->query("select * from UNIDAD_MEDIDA where id_unidad!='".$id."' and replace(descripcion, ' ', '')=replace('".$descripcion."', ' ', '')");

		return $unidadMedida->result();
	}

	function editar($id, $txtDescripcion, $txtAbreviatura)
	{
		$sql="update UNIDAD_MEDIDA  set  descripcion='".$txtDescripcion."', abreviatura='".$txtAbreviatura."' where id_unidad='".$id."'";
		$error="1";
		if(!$this->db->simple_query($sql))
		{
			$error = $this->db->error();
		}
		return $error;
	}
	function insertarInsumo($idUnidad, $descripcion)
	{
		$unidadMedida=$this->db->query("execute sp_Gestionar_EtInsumo_c @Opcion = 'C', @id_unidad = $idUnidad, @desc_insumo = '$descripcion'");
		return true;
	}
	function listaInsumoNivel1()
	{
		$nivel1=$this->db->query("exec sp_gestionar_insumopartida @opcion = 'listar_insumos_nivel' ,  @CodInsumoPartida = '', @NivelInsumoPartida = '0'");
		return $nivel1->result();
	}
	function listaInsumoporNivel($codigoInsumo,$nivel)
	{
		$data=$this->db->query("exec sp_gestionar_insumopartida @opcion = 'listar_insumos_nivel' ,  @CodInsumoPartida = '$codigoInsumo', @NivelInsumoPartida = $nivel");
		return $data->result();
	}

	function validarUnidadMedida($descripcion)
	{
		$data=$this->db->query("select * from UNIDAD_MEDIDA where descripcion = '$descripcion'");
		return $data->result();
	}

	function validarInsumo($descripcion)
	{
		$data=$this->db->query("select * from UNIDAD_MEDIDA where descripcion = '$descripcion'");
		return $data->result()[0];
	}
	function validarInsumoS($descripcion)
	{
		$data=$this->db->query("select * from UNIDAD_MEDIDA where descripcion = '$descripcion'");
		return $data->result();
	}
	function listaPartidaNivel1()
	{
		$nivel1=$this->db->query("exec sp_Gestionar_InsumoPartida @opcion = 'listar_partidas_nivel', @CodInsumoPartida='',@NivelInsumoPartida='2'");
		return $nivel1->result();
	}
	function listaPartidaporNivel($codigoPartida,$nivel)
	{
		$data=$this->db->query("exec sp_gestionar_insumopartida @opcion = 'listar_partidas_nivel' ,  @CodInsumoPartida = '$codigoPartida', @NivelInsumoPartida = $nivel");
		return $data->result();
	}

	public function ETListaUnidadPorDescripcion($valueSearch)
	{
		$data=$this->db->query("select * from UNIDAD_MEDIDA where replace(descripcion, ' ', '') like '%'+replace('".$valueSearch."', ' ', '')+'%'");

		return $data->result();
	}

    function eliminar($id_eli)
    {
        $this->db->where('id_unidad', $id_eli);
        $this->db->delete('unidad_medida');

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
        // return $this->db->affected_rows();
    }

}
