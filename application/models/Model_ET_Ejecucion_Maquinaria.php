<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Ejecucion_Maquinaria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insertar($data)
    {
        $this->db->insert('ET_EJECUCION_MAQUINARIA', $data);

		return $this->db->insert_id();
    }

    public function EjecucionPorMaquinaria($idMaquinaria)
    {
        $data = $this->db->query("select * from ET_EJECUCION_MAQUINARIA where id_maquinaria='$idMaquinaria' order by fecha");

        return $data->result();
    }

    function eliminar($idEjecucion)
    {
        $this->db->where('id_ejecucion',$idEjecucion);

        $this->db->delete('ET_EJECUCION_MAQUINARIA');
        
		return $this->db->affected_rows();
    }

    function EjecucionPorMaquinariaMensual($maquinaria, $anio, $mes)
    {
        $data = $this->db->query("select trabajos_realizados,fecha, sum(num_horas_trabajadas) as acumuladomensual
        from ET_EJECUCION_MAQUINARIA where DATEPART(yy, fecha)='$anio' and DATEPART(mm, fecha)='$mes' and id_maquinaria='$maquinaria'
        group by trabajos_realizados,fecha order by fecha");

        return $data->result();
    }

    function EjecucionPorMaquinariaMensualAnterior($maquinaria, $anio, $mes)
    {
        $data = $this->db->query("select sum(num_horas_trabajadas) as acumuladoanterior from ET_EJECUCION_MAQUINARIA where DATEPART(yy, fecha)='$anio' and DATEPART(mm, fecha)<'$mes' and id_maquinaria='$maquinaria'");

        return (count($data)==0 ? 0 : $data->row()->acumuladoanterior);
    }

    function EjecucionPorMaquinariaMensualActual($maquinaria, $anio, $mes)
    {
        $data = $this->db->query("select sum(num_horas_trabajadas) as acumuladoanterior from ET_EJECUCION_MAQUINARIA where DATEPART(yy, fecha)='$anio' and DATEPART(mm, fecha)='$mes' and id_maquinaria='$maquinaria'");

        return (count($data)==0 ? 0 : $data->row()->acumuladoanterior);
    }
}