<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Actividad extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function insertar($data)
	{
		$this->db->insert('MO_ACTIVIDAD',$data);
		return $this->db->affected_rows();
	}

	function listaActividad($idProducto)
	{
		$this->db->select('MO_ACTIVIDAD.*');
		$this->db->from('MO_ACTIVIDAD');
		$this->db->where('MO_ACTIVIDAD.id_producto',$idProducto);
		return $this->db->get()->result();
	}

	function listaActividadGantt($idProducto)
	{
		//avance_fisico_actividad,fecha_inicio, fecha_fin,id_actividad,id_producto
		$query = $this->db->query("select        dbo.MO_ACTIVIDAD.desc_actividad, SUM(dbo.MO_EJECUCION_ACTIVIDAD.ejec_fisic_real) 
                         / dbo.MO_ACTIVIDAD.meta * dbo.MO_ACTIVIDAD.valoracion_actividad * 100 AS avance_fisico_actividad, dbo.MO_ACTIVIDAD.fecha_inicio, 
                         dbo.MO_ACTIVIDAD.fecha_fin, dbo.MO_ACTIVIDAD.id_actividad, dbo.MO_ACTIVIDAD.costo_total
FROM            dbo.MO_ACTIVIDAD LEFT OUTER JOIN
                         dbo.MO_EJECUCION_ACTIVIDAD ON dbo.MO_ACTIVIDAD.id_actividad = dbo.MO_EJECUCION_ACTIVIDAD.id_actividad
WHERE        (dbo.MO_ACTIVIDAD.id_producto = ".$idProducto.")
GROUP BY dbo.MO_ACTIVIDAD.id_actividad, dbo.MO_ACTIVIDAD.valoracion_actividad, dbo.MO_ACTIVIDAD.meta, dbo.MO_ACTIVIDAD.fecha_inicio, 
                         dbo.MO_ACTIVIDAD.fecha_fin, dbo.MO_ACTIVIDAD.id_producto, dbo.MO_ACTIVIDAD.desc_actividad, dbo.MO_ACTIVIDAD.costo_total");
		return  $query->result();
	}

	function verificarActividad($idProducto,$actividad)
	{
		$this->db->select('MO_ACTIVIDAD.*');
		$this->db->from('MO_ACTIVIDAD');
		$this->db->where('MO_ACTIVIDAD.desc_actividad',$actividad);
		$this->db->where('MO_ACTIVIDAD.id_producto',$idProducto);
		return $this->db->get()->result();
	}

	function eliminar($idActividad)
	{
		$this->db->where('id_actividad',$idActividad);
		$this->db->delete('MO_ACTIVIDAD');
		return $this->db->affected_rows();
	}

	function editar($actividad,$idActividad)
	{
		$this->db->set($actividad);
		$this->db->where('id_actividad', $idActividad);
		$this->db->update('MO_ACTIVIDAD');
		return $this->db->affected_rows();
	}

	function actividadId($idActividad)
	{
		$this->db->select('MO_ACTIVIDAD.*');
		$this->db->from('MO_ACTIVIDAD');
		$this->db->where('MO_ACTIVIDAD.id_actividad',$idActividad);
		return $this->db->get()->result()[0];
	}

	function verificarActividadDiferente($idProducto,$idActividad,$actividad)
	{
		$this->db->select('MO_ACTIVIDAD.*');
		$this->db->from('MO_ACTIVIDAD');
		$this->db->where('MO_ACTIVIDAD.desc_actividad',$actividad);
		$this->db->where('MO_ACTIVIDAD.id_producto',$idProducto);
		$this->db->where('MO_ACTIVIDAD.id_actividad !=',$idActividad);
		return $this->db->get()->result();
	}


	function listaActividadProducto($idPi)
	{
		$query = $this->db->query("select p.desc_producto,a.id_actividad, a.desc_actividad, a.uni_medida, a.meta, a.costo_total from mo_producto p inner join mo_actividad a on p.id_producto= a.id_producto where p.id_pi=$idPi ORDER BY P.ID_PRODUCTO");
		return  $query->result();
	}

	function sumatoriaEjecucionProgramada($idActividad)
	{
		$query = $this->db->query("select sum(cantidad_ejecucion_programada) as cantidad,sum(ejec_finan_programada) as monto from mo_actividad_programacion where  id_actividad=$idActividad");
		return  $query->result();
	}

	function sumatoriaEjecucionReal($idActividad)
	{
		$query = $this->db->query("select sum(ejec_fisic_real) as cantidad,sum(ejec_finan_real) as monto from MO_EJECUCION_ACTIVIDAD where  id_actividad=$idActividad");
		return  $query->result();
	}

	function sumarValoracion($idProducto)
	{
		$data = $this->db->query("select sum(valoracion_actividad)*100 as sumatoria from mo_actividad where id_producto = $idProducto");
		return $data->result()[0];
	}

	function editarEstado($idActividad,$valor)
	{
		$this->db->set('culminado',$valor);
		$this->db->where('id_actividad', $idActividad);
		$this->db->update('MO_ACTIVIDAD');
		return $this->db->affected_rows();
	}	

	function editarVistoBueno($idActividad,$valor)
	{
		$this->db->set('visto_bueno',$valor);
		$this->db->where('id_actividad', $idActividad);
		$this->db->update('MO_ACTIVIDAD');
		return $this->db->affected_rows();
	}	
}