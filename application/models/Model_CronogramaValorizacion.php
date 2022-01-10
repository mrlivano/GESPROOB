<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_CronogramaValorizacion extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function CronogramaValorizacion_Listar($opcion)
	{
		$CronogramaValorizacion_Listar=$this->db->query("execute sp_Gestionar_ET_Cronogram_Valoracion @Opcion='".$opcion."' ");
	    return $CronogramaValorizacion_Listar->result();
	}

	function insertar($opcion,$txtCronogramaValorizacion)
	{
		$CronogramaValorizacion=$this->db->query("execute sp_Gestionar_ET_Cronogram_Valoracion_c @Opcion='".$opcion."',@desc_cronograma='".$txtCronogramaValorizacion."'");
		return true; 
	} 
	function NombreCronogranmaValoracion($id_valorizacion)
	{
		$CronogramaValorizacion_N=$this->db->query("Select id_valorizacion,desc_cronograma from ET_CRONOGRAMA_VALORIZACION where  id_valorizacion='".$id_valorizacion."' ");
	    return $CronogramaValorizacion_N->result()[0];
	}

	function editar($opcion,$hdIdCronogramaValorizacion,$txtCronogramaValorizacion)
	{
		$CronogramaValorizacion=$this->db->query("execute sp_Gestionar_ET_Cronogram_Valoracion_c @Opcion='".$opcion."',@id_valorizacion='".$hdIdCronogramaValorizacion."',@desc_cronograma='".$txtCronogramaValorizacion."' ");
	    return $CronogramaValorizacion->result();
	}

	function ValidarCronogramaValorizacion($txtCronogramaValorizacion)
	{
		$CronogramaValorizacion=$this->db->query("select * from ET_CRONOGRAMA_VALORIZACION where replace(desc_cronograma, ' ', '')=replace('".$txtCronogramaValorizacion."', ' ', '')");
		
		return $CronogramaValorizacion->result();
	}

	function ValidarDescripcionEtapaEditar($hdIdCronogramaValorizacion,$txtCronogramaValorizacion)
	{
		$CronogramaValorizacion=$this->db->query("select * from ET_CRONOGRAMA_VALORIZACION where id_valorizacion!='".$hdIdCronogramaValorizacion."' and replace(desc_cronograma, ' ', '')=replace('".$txtCronogramaValorizacion."', ' ', '')");

		return $CronogramaValorizacion->result();
	}
    function EliminarCronograma($id_cronog){

        $this->db->query("delete from ET_CRONOGRAMA_VALORIZACION where id_valorizacion=".$id_cronog."");
        return true;
    }

}