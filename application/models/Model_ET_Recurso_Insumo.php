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

	function listaInsumoPorRecursoMeta($idRecurso,$idEt)
	{
		$data=$this->db->query("select r.id_relacion_insumo,i.desc_insumo,u.descripcion, ri.*,p.id_meta
		from ET_RELACION_INSUMO r inner join ET_INSUMO i 
				on r.id_insumo=i.id_insumo inner join UNIDAD_MEDIDA u on i.id_unidad=u.id_unidad
				inner join et_recurso_insumo ri on r.id_recurso=ri.id_recurso and r.id_insumo=ri.id_insumo and r.id_et=ri.id_et
				inner join ET_DETALLE_ANALISIS_UNITARIO dau on ri.id_detalle_analisis_u=dau.id_detalle_analisis_u
				inner join ET_ANALISIS_UNITARIO au on dau.id_analisis = au.id_analisis
				inner join ET_DETALLE_PARTIDA dp on au.id_detalle_partida=dp.id_detalle_partida
				inner join ET_PARTIDA p on dp.id_partida=p.id_partida
				where  r.id_et='$idEt' and r.id_recurso='$idRecurso'");
		return $data->result();
	}

	function listaInsumoTipoEjecucion($idMeta)
	{
		$data=$this->db->query("with Meta_Padre AS ( 
			SELECT  *  FROM ET_META WHERE  id_meta = '$idMeta'
			UNION ALL
			SELECT ET_META.* FROM  ET_META JOIN Meta_Padre ON ET_META.id_meta = Meta_Padre.id_meta_padre)
			SELECT top 1 tipo_ejecucion FROM Meta_Padre m inner join et_componente c on m.id_componente=c.id_componente where m.id_componente is not NULL");
		return $data->result();
	}

	// function eliminar($idRecursoInsumo)
	// {
	// 	$this->db->where('id_recurso_insumo',$idRecursoInsumo);

	// 	$this->db->delete('et_recurso_insumo');

	// 	return $this->db->affected_rows();
	// }
}