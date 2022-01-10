<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Clasificador extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function clasificador_Listar($opcion)
	{
		$ETClasificador=$this->db->query("execute sp_Gestionar_ET_Clasificador @Opcion='".$opcion."'");
	    return $ETClasificador->result();
	}
	function ETListaClasificador($valueSearch)
	{	
		$opcion='BUSCARCLASIFICADOR1';
		$data=$this->db->query("execute sp_Gestionar_ET_Clasificador @Opcion='".$opcion."',@buscar='".$valueSearch."' ");

		return $data->result();
	}

	function insertar($opcion,$txtNumeroClasi,$txtDescripcionClasi,$txtDetalleClasi)
	{
		$ETClasificador=$this->db->query("execute sp_Gestionar_ET_Clasificador_c @Opcion='".$opcion."',@num_clasificador='".$txtNumeroClasi."',@desc_clasificador='".$txtDescripcionClasi."',@detalle_clasificador='".$txtDetalleClasi."'");
		return true;
	} 
	function nombreClasificador($id_clasificador)
	{
		$ETClasificador=$this->db->query("SELECT id_clasificador,num_clasificador,desc_clasificador,detalle_clasificador
		 								  FROM   ET_CLASIFICADOR WHERE id_clasificador='".$id_clasificador."'");
	    return $ETClasificador->result()[0];
	}
	function editar($opcion,$hdIdClasificadro,$txtNumeroClasi,$txtDescripcionClasi,$txtDetalleClasi)
	{
		$ETClasificador=$this->db->query("execute sp_Gestionar_ET_Clasificador_c @Opcion='".$opcion."',@id_clasificador='".$hdIdClasificadro."',@num_clasificador='".$txtNumeroClasi."',@desc_clasificador='".$txtDescripcionClasi."',@detalle_clasificador='".$txtDetalleClasi."'");
		return true;
	}

	function  ValidarDescripcionClasificador($txtDescripcionClasi)
	{
		$ETClasificador=$this->db->query("select * from ET_CLASIFICADOR where replace(desc_clasificador, ' ', '')=replace('".$txtDescripcionClasi."', ' ', '')");
		
		return $ETClasificador->result();
	}
	function ValidarClasificadorEtapaEditar($hdIdClasificadro,$txtDescripcionClasi)
	{
		$ETClasificador=$this->db->query("select * from ET_CLASIFICADOR where id_clasificador!='".$hdIdClasificadro."' and replace(desc_clasificador, ' ', '')=replace('".$txtDescripcionClasi."', ' ', '')");

		return $ETClasificador->result();
	}
	function eliminar($opcion,$id_clasificador)
	{
		$ETClasificador=$this->db->query("execute sp_Gestionar_ET_Clasificador_d @Opcion='".$opcion."',@id_clasificador='".$id_clasificador."'");

		return $ETClasificador->result();
	}
	function VerificarClasificadorAsociado($id_clasificador)
	{
		$ETClasificador=$this->db->query("select id_clasificador from ET_PRESUPUESTO_ANALITICO where id_clasificador='".$id_clasificador."' ");

		return $ETClasificador->result();
	}
	function ValidarNodosClasificador($idClasificador)
	{
		$ETClasificador=$this->db->query("select* from ET_CLASIFICADOR where id_clasificador='".$idClasificador."' and (LEN(num_clasificador)=12 or LEN(num_clasificador)=11); ");

		return $ETClasificador->result();
	}

}