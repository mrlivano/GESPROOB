<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_CriterioEspecifico extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	function ListarCriterioEspecifico($id_criterio_gen)
	{
		$opcion="ListarCriteriosEspecificos";
		$data=$this->db->query("execute sp_Gestionar_CriterioEspecifico  @opcion='".$opcion."',@id_criterio_gen=$id_criterio_gen");

		return $data->result();
	}
	
	function editar($id,$txtcriterioespecifico,$txtpeso)
	{
		$opcion="editar";
		$data=$this->db->query("execute sp_Gestionar_CriterioEspecifico_c  @opcion='".$opcion."',@id_criterio='".$id."',@nombre_criterio='".$txtcriterioespecifico."',@peso='".$txtpeso."'");

        return true;
	}

	function criterioEspecifico($id)
    {
        $data=$this->db->query("select * from CRITERIO_ESP where id_criterio='".$id."'");

         return $data->result()[0];
    }

    function insertar($txtIdCriterioG,$txtNombreCriterioEspecifico,$txtpeso)
    {
    	$opcion="insertar";
		$data=$this->db->query("execute sp_Gestionar_CriterioEspecifico_c @opcion='".$opcion."', @id_criterio_gen='".$txtIdCriterioG."',@nombre_criterio='".$txtNombreCriterioEspecifico."',@peso='".$txtpeso."'");

		return $data->result();
    }

    function CriterioEspecificoData($txtNombreCriterioEspecifico)
    {
        $data=$this->db->query("select * from CRITERIO_ESP where replace(nombre_criterio, ' ', '')=replace('".$txtNombreCriterioEspecifico."', ' ', '')");

        return $data->result();
    }

    function eliminar($id)
    {
        $opcion='eliminar';
        $this->db->query("execute sp_Gestionar_CriterioEspecifico_d  @Opcion='".$opcion."',@id_criterio='".$id."'");
        return true;
    }
    function listarFuncion($anio,$id_funcion)
    {
        $data=$this->db->query("select distinct funcion.nombre_funcion,funcion.id_funcion from funcion inner join CRITERIO_GEN
         on funcion.id_funcion=CRITERIO_GEN.id_funcion where CRITERIO_GEN.anio_criterio_gen='".$anio."' and CRITERIO_GEN.id_funcion='".$id_funcion."' ");
        return $data->result();
    }

    function listarCriterioGeneralUnico($id_criterio)
    {
        $data=$this->db->query("select * from CRITERIO_GEN inner join CRITERIO_ESP on CRITERIO_GEN.id_criterio_gen=CRITERIO_ESP.id_criterio_gen
        where CRITERIO_ESP.id_criterio='$id_criterio'");
        return $data->result()[0];

    }

    function validarAsociacionProyecto($id_criterio)
    {
       
        $data=$this->db->query(" select * from PUNTAJE_CRITERIO_PI where id_criterio='$id_criterio'");
        return $data->result();

    }

}