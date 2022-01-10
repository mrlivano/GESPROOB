<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Recurso_Insumo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('ET_RECURSO_INSUMO',$data);

		return $this->db->affected_rows();
	}

	// function editar($data,$idRecursoInsumo)
	// {
	// 	$this->db->set($data);
	// 	$this->db->where('id_recurso_insumo',$idRecursoInsumo);
	// 	$this->db->update('et_recurso_insumo');
	// 	return $this->db->affected_rows();
	// }

	function listaInsumoPorRecurso($idRecurso,$idEt)
	{
		$data=$this->db->query("select r.*,i.desc_insumo,u.descripcion from ET_RELACION_INSUMO r inner join ET_INSUMO i 
		on r.id_insumo=i.id_insumo inner join UNIDAD_MEDIDA u on i.id_unidad=u.id_unidad
		where r.id_et='$idEt' and r.id_recurso='$idRecurso'");
		return $data->result();
	}

	// function eliminar($idRecursoInsumo)
	// {
	// 	$this->db->where('id_recurso_insumo',$idRecursoInsumo);

	// 	$this->db->delete('et_recurso_insumo');

	// 	return $this->db->affected_rows();
	// }
}