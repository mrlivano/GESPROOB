<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Mo_Producto extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function buscarProyecto($codigoUnico)
	{
		$this->db->select('PROYECTO_INVERSION.*');
		$this->db->from('PROYECTO_INVERSION');
		$this->db->where('PROYECTO_INVERSION.codigo_unico_pi',$codigoUnico);
		return $this->db->get()->result();
	}

	function ProyectoPorId($idPi)
	{
		$this->db->select('PROYECTO_INVERSION.*');
		$this->db->from('PROYECTO_INVERSION');
		$this->db->where('PROYECTO_INVERSION.id_pi',$idPi);
		return $this->db->get()->result();
	}

	function insertar($data)
	{
		$this->db->insert('MO_PRODUCTO',$data);
		return $this->db->insert_id();
	}

	function editar($producto,$idProducto)
	{
		$this->db->set($producto);
		$this->db->where('id_producto', $idProducto);
		$this->db->update('MO_PRODUCTO');
		return $this->db->affected_rows();
	}

	function listadoProyectosAdmin()
	{
		$this->db->select('PROYECTO_INVERSION.id_pi, PROYECTO_INVERSION.codigo_unico_pi, PROYECTO_INVERSION.nombre_pi, PROYECTO_INVERSION.costo_pi');
		$this->db->from('MO_PRODUCTO');
		$this->db->join('PROYECTO_INVERSION','MO_PRODUCTO.id_pi = PROYECTO_INVERSION.id_pi');
		$this->db->group_by('PROYECTO_INVERSION.id_pi, PROYECTO_INVERSION.codigo_unico_pi, PROYECTO_INVERSION.nombre_pi, PROYECTO_INVERSION.costo_pi');
		$query = $this->db->get();
		return $query->result();
	}

	function listaProyecto()
	{
		$idPersona=$this->session->userdata('idPersona');

        $data = $this->db->query("
			select PROYECTO_INVERSION.id_pi,PROYECTO_INVERSION.codigo_unico_pi,PROYECTO_INVERSION.nombre_pi,PROYECTO_INVERSION.costo_pi 
            from  PROYECTO_INVERSION,USUARIO_PROYECTO 
            where PROYECTO_INVERSION.id_pi=USUARIO_PROYECTO.id_pi and id_persona =".$idPersona."
            GROUP BY PROYECTO_INVERSION.id_pi, PROYECTO_INVERSION.codigo_unico_pi,PROYECTO_INVERSION.nombre_pi, PROYECTO_INVERSION.costo_pi");
        return $data->result();
    }

	function ReporteAvanceFisico($anio,$idPi)
	{
		$this->db->select('sum(MO_EJECUCION_ACTIVIDAD.ejec_fisic_prog) as EProg, sum(MO_EJECUCION_ACTIVIDAD.ejec_fisic_real) as EReal ');
		$this->db->from('MO_EJECUCION_ACTIVIDAD');
		$this->db->join('MO_ACTIVIDAD','MO_EJECUCION_ACTIVIDAD.id_actividad=MO_ACTIVIDAD.id_actividad');
		$this->db->join('MO_PRODUCTO','MO_ACTIVIDAD.id_producto=MO_PRODUCTO.id_producto');
		$this->db->where('MO_EJECUCION_ACTIVIDAD.anio_ejec',$anio);
		$this->db->where('MO_PRODUCTO.id_pi',$idPi);
		$query = $this->db->get();
		return $query->result();
	}

	function listaProducto($idpi)
	{
		$this->db->select('MO_PRODUCTO.*');
		$this->db->from('MO_PRODUCTO');
		$this->db->where('MO_PRODUCTO.id_pi',$idpi);
		return $this->db->get()->result();
	}

	function ProductoId($idProducto)
	{
		$this->db->select('MO_PRODUCTO.*');
		$this->db->from('MO_PRODUCTO');
		$this->db->where('MO_PRODUCTO.id_producto',$idProducto);
		return $this->db->get()->result()[0];
	}

	function listaProductoGantt($id_pi)
	{		
		$data = $this->db->query("
			select        dbo.MO_PRODUCTO.id_producto, dbo.MO_PRODUCTO.desc_producto, SUM(MO_ACTIVIDA.avance_fisico_actividad) 
			                         * dbo.MO_PRODUCTO.valoracion_producto AS avance_fisico_producto, MIN(MO_ACTIVIDA.fecha_inicio) AS fecha_inicio_producto, MAX(MO_ACTIVIDA.fecha_fin) 
			                         AS fecha_fin_producto, SUM(MO_ACTIVIDA.costo_total) AS costo_total_producto
							    FROM            dbo.MO_PRODUCTO LEFT OUTER JOIN
							    (select       MO_ACTIVIDAD.id_producto, dbo.MO_ACTIVIDAD.desc_actividad, SUM(dbo.MO_EJECUCION_ACTIVIDAD.ejec_fisic_real)/ dbo.MO_ACTIVIDAD.meta * dbo.MO_ACTIVIDAD.valoracion_actividad AS avance_fisico_actividad, dbo.MO_ACTIVIDAD.fecha_inicio, 
												    dbo.MO_ACTIVIDAD.fecha_fin, dbo.MO_ACTIVIDAD.id_actividad, dbo.MO_ACTIVIDAD.costo_total
							    FROM            dbo.MO_ACTIVIDAD LEFT OUTER JOIN
												    dbo.MO_EJECUCION_ACTIVIDAD ON dbo.MO_ACTIVIDAD.id_actividad = dbo.MO_EJECUCION_ACTIVIDAD.id_actividad
							    GROUP BY dbo.MO_ACTIVIDAD.id_actividad, dbo.MO_ACTIVIDAD.valoracion_actividad, dbo.MO_ACTIVIDAD.meta, dbo.MO_ACTIVIDAD.fecha_inicio, 
												    dbo.MO_ACTIVIDAD.fecha_fin, dbo.MO_ACTIVIDAD.id_producto, dbo.MO_ACTIVIDAD.desc_actividad, dbo.MO_ACTIVIDAD.costo_total) AS MO_ACTIVIDA ON 
			                         dbo.MO_PRODUCTO.id_producto = MO_ACTIVIDA.id_producto
			WHERE MO_PRODUCTO.id_pi = ".$id_pi."
			GROUP BY dbo.MO_PRODUCTO.desc_producto, dbo.MO_PRODUCTO.id_producto, dbo.MO_PRODUCTO.valoracion_producto");
		return $data->result();	
	}

	function existeProyecto($codigoUnico)
	{
		$this->db->select('PROYECTO_INVERSION.codigo_unico_pi,MO_PRODUCTO.id_pi ');
        $this->db->from('PROYECTO_INVERSION');
        $this->db->join('MO_PRODUCTO', 'MO_PRODUCTO.id_pi = PROYECTO_INVERSION.id_pi');
        $this->db->where('PROYECTO_INVERSION.codigo_unico_pi',$codigoUnico);
        $query = $this->db->get();
        return $query->result();
	}

	function verificarProducto($producto,$idPi)
	{
		$this->db->select('MO_PRODUCTO.*');
		$this->db->from('MO_PRODUCTO');
		$this->db->where('MO_PRODUCTO.desc_producto',$producto);
		$this->db->where('MO_PRODUCTO.id_pi',$idPi);
		return $this->db->get()->result();
	}

	function eliminarMonitoreo($idPi)
	{
		$this->db->where('id_pi', $idPi);
		$this->db->delete('MO_PRODUCTO');
		return $this->db->affected_rows();
	}

	function eliminarProducto($idProducto)
	{
		$this->db->where('id_producto', $idProducto);
		$this->db->delete('MO_PRODUCTO');
		return $this->db->affected_rows();
	}

	function sumarValoracion($idPi)
	{
		$data = $this->db->query("select sum(valoracion_producto) as sumatoria from mo_producto where id_pi = $idPi");
		return $data->result()[0];
	}

	function graficoEjecucion($idPi)
	{
		$data = $this->db->query("exec sp_ListarMonitoreoReporte @opcion='avance_fisico_financiero_por_proyecto', @id_proyecto=$idPi");
		return $data->result();
	}

	function graficoProgramacion($idPi)
	{
		$data = $this->db->query("exec sp_ListarMonitoreoReporte @opcion = 'avance_fisico_financiero_programado_por_proyecto', @id_proyecto=$idPi");
		return $data->result();
	}

	function getProyecto($idPi)
	{
		$data = $this->db->query("select * from proyecto_inversion where id_pi=$idPi");
		return $data->result()[0];
	}

	function editarVistoBueno($idProducto,$valor)
	{
		$this->db->set('visto_bueno',$valor);
		$this->db->where('id_producto', $idProducto);
		$this->db->update('MO_PRODUCTO');
		return $this->db->affected_rows();
	}	
}