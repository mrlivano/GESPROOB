<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_CostosReferenciales extends CI_Model 
{
    function lista()
    {
        $query=$this->db->query("select GRUPO_BIEN+FAMILIA_BIEN+CLASE_BIEN+ITEM_BIEN AS CODIGO,NOMBRE_ITEM,PRECIO_COMPRA,TIPO_BIEN from [SIGA_300251].dbo.CATALOGO_BIEN_SERV where estado='A' AND ESTADO_MEF='A' AND PRECIO_COMPRA!=0 ORDER BY TIPO_BIEN,CODIGO");
        return $query->result();
    }

    function insertar($data)
    {
        $this->db->insert('REPOSITORIO_EXPEDIENTE',$data);
		return $this->db->insert_id();
    }
}
