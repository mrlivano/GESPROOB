<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ET_Insumo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ETInsumoPorDescInsumo($valueSearch)
	{
		$data = $this->db->query("select CodInsumo, ETEJ_Insumo.Nivel, ETEJ_Insumo.Descripcion, ETEJ_Unidad.Descripcion Unidad, ETEJ_Unidad.Simbolo FROM ETEJ_Insumo LEFT OUTER JOIN ETEJ_Unidad ON ETEJ_Insumo.CodUnidad=ETEJ_Unidad.CodUnidad where replace(ETEJ_Insumo.Descripcion, ' ', '') like '%'+replace('".$valueSearch."', ' ', '')+'%'");

		return $data->result();
	}

	public function ETInsumoPorDescripcion($descripcion, $idUnidadMedida)
	{
		$descripcion=str_replace("'", "", $descripcion);
		
		$data=$this->db->query("select * from ET_INSUMO where id_unidad='".$idUnidadMedida."' and replace(desc_insumo, ' ', '')=replace('".$descripcion."', ' ', '')");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	public function insertar($data)
	{
		$this->db->insert('ET_INSUMO',$data);

		return $this->db->insert_id();
	}
}
?>