<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_DetSegOrden extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarAcumuladoMeta($codigo_unico)
	{
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='listar_acumulado_meta', @codigo_snip ='".$codigo_unico."'");
        return $data->result();    
	}
	public function buscarOrden($anio,$ultimaMeta,$txtOrden)
	{
        $data = $this->db->query("execute sp_Gestionar_SIGA @opcion='listar_orden_proyecto', @anio_meta=$anio, @correlativo_meta=$ultimaMeta, @num_orden = $txtOrden");
        return $data->result();
	}

	public function listarOrdenPorPartida($idPartida)
	{
		$data = $this->db->query("select * from DET_SEG_ORDEN where id_partida=$idPartida");
		return $data->result();
	}

	public function insertar($etapa, $fecha, $cantidad, $subtotal, $fechadia, $idDetallePartida,$descripcion)
	{
		$data = array(
			'fecha' => $fecha,
			'cantidad' => $cantidad,
			'sub_total' => $subtotal,
			'fecha_dia' => $fechadia,
			'id_detalle_partida' => $idDetallePartida,
			'etapa_valorizacion' => $etapa,
			'descripcion' => $descripcion
		);

		$this->db->insert('DET_SEG_VALORIZACION',$data);
		return $this->db->insert_id();
	}

	public function sumatoriaAcumuladoValorizado($idDetallePartida, $estado)
	{
		$data = $this->db->query("select sum(cantidad) as acumulado from det_seg_valorizacion where id_detalle_partida = '$idDetallePartida' and etapa_valorizacion='$estado'");
		
		return $data->result();
	}

	public function sumatoriaValorizacionPartida($idDetallePartida)
	{
		$data = $this->db->query("select ds.id_detalle_partida, sum(ds.cantidad) as acumulado, dp.cantidad from ET_DETALLE_PARTIDA dp inner join DET_SEG_VALORIZACION ds on dp.id_detalle_partida=ds.id_detalle_partida where dp.id_detalle_partida='$idDetallePartida' group by ds.id_detalle_partida, dp.cantidad");
		
		return $data->result();
	}

	public function listarValorizacionPorDetallePartida($idDetallePartida)
	{
		$data = $this->db->query("select * from DET_SEG_VALORIZACION where id_detalle_partida = $idDetallePartida");
		return $data->result();
	}

	public function eliminar($id_detSegValorizacion)
	{
		$this->db->where('id_det_seg_valorizacion',$id_detSegValorizacion);
        $this->db->delete('DET_SEG_VALORIZACION');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
	}

	public function valorizadaActual($idDetallePartida, $mesActual, $anioActual, $etapa)
	{
		$data= $this->db->query("select Datepart(mm,dv.fecha_dia) as mesActual,dv.id_detalle_partida,sum(dv.cantidad) as metrado, sum(dv.sub_total) as valorizado from DET_SEG_VALORIZACION dv where dv.id_detalle_partida = '$idDetallePartida' and Datepart(mm,dv.fecha_dia)= '$mesActual' and Datepart(YY,dv.fecha_dia) = '$anioActual' and etapa_valorizacion ='$etapa'  group by Datepart(mm,dv.fecha_dia),dv.id_detalle_partida");
		return $data->result();
	}

	public function valorizadoAnterior($idDetallePartida, $mesActual, $anioActual, $etapa)
	{
		$data = $this->db->query("select dv.id_detalle_partida,sum(dv.cantidad) as metradoAnterior, sum(dv.sub_total) as valorizadoAnterior from DET_SEG_VALORIZACION dv where Datepart(mm,dv.fecha_dia) < '$mesActual' and Datepart(YY,dv.fecha_dia) <= '$anioActual' and dv.id_detalle_partida ='$idDetallePartida' and etapa_valorizacion ='$etapa' group by dv.id_detalle_partida");
		return $data->result();
	}

	public function sumatoriaValorizacion()
	{
		$data = $this->db->query("select ds.id_detalle_partida, sum(ds.cantidad) as cantidad from ET_DETALLE_PARTIDA dp inner join DET_SEG_VALORIZACION ds on dp.id_detalle_partida=ds.id_detalle_partida group by(ds.id_detalle_partida)");
		return $data->result();
	}

	public function valorizacionDescripcion($idDetallePartida, $mesActual, $anioActual, $etapa)
	{
		$data = $this->db->query("select id_detalle_partida, STUFF((SELECT ', ' + valorizacion.descripcion from (select Datepart(mm,dv.fecha_dia) as mesActual,dv.id_detalle_partida,dv.descripcion FROM DET_SEG_VALORIZACION dv WHERE dv.id_detalle_partida='$idDetallePartida' and Datepart(mm,dv.fecha_dia)= '$mesActual' and Datepart(YY,dv.fecha_dia) = '$anioActual' and etapa_valorizacion ='$etapa' group by Datepart(mm,dv.fecha_dia),dv.id_detalle_partida,dv.descripcion) as valorizacion FOR XML PATH ('')), 1,2, '') as descripcion from DET_SEG_VALORIZACION where id_detalle_partida = '$idDetallePartida' group by id_detalle_partida");
		return $data->result();
	}

	public function PartidasEjecutadasPeriodo($mesActual)
	{
		$data =  $this->db->query("select p.numeracion, dp.id_detalle_partida, p.desc_partida,um.descripcion, sum( ds.cantidad) as cantidad from DET_SEG_VALORIZACION ds inner join ET_DETALLE_PARTIDA dp on ds.id_detalle_partida=dp.id_detalle_partida inner join ET_PARTIDA p on dp.id_partida = p.id_partida inner join UNIDAD_MEDIDA um on dp.id_unidad = um.id_unidad where Datepart(mm,ds.fecha_dia) = $mesActual group by p.numeracion, dp.id_detalle_partida, p.desc_partida,um.descripcion");
		return $data->result();
	}

	public function PartidasEjecutadasPeriodo2($fecha,$idPartida)
	{
		$data = $this->db->query("select p.numeracion, dp.id_detalle_partida, p.desc_partida,um.descripcion, sum( ds.cantidad) as cantidad from DET_SEG_VALORIZACION ds inner join ET_DETALLE_PARTIDA dp on ds.id_detalle_partida=dp.id_detalle_partida inner join ET_PARTIDA p on dp.id_partida = p.id_partida inner join UNIDAD_MEDIDA um on dp.id_unidad = um.id_unidad where Datepart(mm,ds.fecha_dia) =Datepart(mm,'$fecha')  and Datepart(yy,ds.fecha_dia) = Datepart(yy,'$fecha') and p.id_partida=$idPartida group by p.numeracion, dp.id_detalle_partida, p.desc_partida,um.descripcion");
		return $data->result();
	}

	public function partidaEjecutada($idDetallePartida, $anio)
	{
		$data = $this->db->query("select DATEPART(MONTH, fecha_dia) as mes,sum(sub_total) as precio
		from det_seg_valorizacion where id_detalle_partida='$idDetallePartida' and DATEPART(year, fecha_dia)='$anio' 
		and (etapa_valorizacion='valorizacion' or etapa_valorizacion='mayor metrado') group by DATEPART(MONTH, fecha_dia)");
		
		return $data->result();
	}
}
