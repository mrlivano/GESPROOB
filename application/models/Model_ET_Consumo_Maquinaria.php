<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Consumo_Maquinaria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function insertar($data)
    {
        $this->db->insert('ET_CONSUMO_MAQUINARIA', $data);

		return $this->db->insert_id();
    }

    function listaConsumoDiario($idMaquinaria)
    {
        $data =$this->db->query("select c.*, u.descripcion as unidad_medida, u.abreviatura from ET_CONSUMO_MAQUINARIA c inner join UNIDAD_MEDIDA  u 
        on c.id_unidad=u.id_unidad where id_maquinaria='$idMaquinaria' order by fecha desc");

        return $data->result();
    }

    function eliminar($idConsumo)
    {
        $this->db->where('id_consumo_maquinaria', $idConsumo);
		$this->db->delete('ET_CONSUMO_MAQUINARIA');
		return $this->db->affected_rows();
    }

    function ListaFechaConsumo($idMaquinaria, $mes, $anio)
    {
        $data =$this->db->query("select c.*, u.descripcion as unidad_medida, u.abreviatura from ET_CONSUMO_MAQUINARIA c inner join UNIDAD_MEDIDA  u 
        on c.id_unidad=u.id_unidad where id_maquinaria='$idMaquinaria' and DATEPART(month,fecha)='$mes' and DATEPART(year,fecha)='$anio' order by fecha desc");

        return $data->result();
    }
}