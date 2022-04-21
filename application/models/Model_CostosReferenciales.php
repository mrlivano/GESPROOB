<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_CostosReferenciales extends CI_Model 
{
    function lista()
    {
        $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
        $query=$$db_sedecentral->query("select GRUPO_BIEN+CLASE_BIEN+FAMILIA_BIEN+ITEM_BIEN as codigo,NOMBRE_ITEM,PRECIO_COMPRA,um.ABREVIATURA,TIPO_BIEN from CATALOGO_BIEN_SERV cbs inner join UNIDAD_MEDIDA um
        on cbs.UNIDAD_MEDIDA=um.UNIDAD_MEDIDA 
        where cbs.ESTADO='A' and cbs.ESTADO_MEF='A' and cbs.PRECIO_COMPRA!=0 order by cbs.TIPO_BIEN,codigo");
        return $query->result();
    }

    function insertar($data)
    {
        $this->db->insert('REPOSITORIO_EXPEDIENTE',$data);
		return $this->db->insert_id();
    }
}
