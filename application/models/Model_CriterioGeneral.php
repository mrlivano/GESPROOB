<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_criterioGeneral extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	function CriteriosGenerales()
	{
		$data=$this->db->query("select * from CRITERIO_GEN inner join FUNCION on CRITERIO_GEN.id_funcion=FUNCION.id_funcion");

		return $data->result();
	}
	function CriteriosGeneralesPorFuncion($anio)
	{
		//$data=$this->db->query("select * from	FUNCION, CRITERIO_GEN where FUNCION.id_funcion=CRITERIO_GEN.id_funcion and anio_criterio_gen=".$anio);
        $data=$this->db->query("select * from FUNCION");

		return $data->result();
	}

	function ListarCriterioGenerales($id_funcion,$anio)
	{
		$opcion="ListarCriterioGeneral";
		$ListarCriterioGenerales=$this->db->query("execute sp_Gestionar_CriterioGeneral @opcion='".$opcion."', @id_funcion='$id_funcion',@anio_criterio_gen='".$anio."' ");

		return $ListarCriterioGenerales->result();
	}
	function insert($txtNombreCriterio,$txtPesoCriterioG,$txtAnioCriterioG,$txtIdFuncion)
	{
		$opcion="insertar";
		$ListarCriterioGenerales=$this->db->query("execute sp_Gestionar_CriterioGeneral_c @opcion='".$opcion."', @nombre_criterio_gen='".$txtNombreCriterio."',@peso_criterio_gen='$txtPesoCriterioG',@anio_criterio_gen='$txtAnioCriterioG',@id_funcion=$txtIdFuncion ");

		return $ListarCriterioGenerales->result();
	}
	function Editar($hdIdcriterioGeneral,$txtNombreCriterio,$txtPesoCriterioG,$txtAnioCriterioG)
	{
		$opcion="editar";
		$ListarCriterioGenerales=$this->db->query("execute sp_Gestionar_CriterioGeneral_c @opcion='".$opcion."', 	@id_criterio_gen='$hdIdcriterioGeneral', @nombre_criterio_gen='".$txtNombreCriterio."', @peso_criterio_gen='$txtPesoCriterioG', @anio_criterio_gen='$txtAnioCriterioG'");

		return $ListarCriterioGenerales->result();
	}
	function eliminar($id_criterio_gen)
	{
		$opcion="eliminar";
		$this->db->query("execute sp_Gestionar_CriterioGeneral_d @opcion='".$opcion."', @id_criterio_gen='$id_criterio_gen' ");
        return true;
	}
	function listadoUnicoCGeneral($id_criterio_gen)
	{
		$funcion=$this->db->query("select * FROM CRITERIO_GEN where id_criterio_gen='$id_criterio_gen'");
        return $funcion->result()[0];
	}
	function virificarCriterioEspe($id_criterio_gen)
	{
		$data=$this->db->query("SELECT * FROM CRITERIO_ESP where id_criterio_gen='$id_criterio_gen'");
        return $data->result();
	}
	function getcriterioGeneral()
	{
		 $funcion=$this->db->query("select * from CRITERIO_GEN");
        return $funcion->result();
	}

	function CriterioGeneralData($txtNombreCriterio,$txtAnioCriterioG)
    {
        $data=$this->db->query("select * from CRITERIO_GEN where CRITERIO_GEN.nombre_criterio_gen='$txtNombreCriterio' and  CRITERIO_GEN.anio_criterio_gen='$txtAnioCriterioG'");

        return $data->result();
    }

	function CriterioGeneralModifId($hdIdcriterioGeneral, $txtNombreCriterio)
	{
		$data=$this->db->query("select * from CRITERIO_GEN where id_criterio_gen!='".$hdIdcriterioGeneral."' and replace(nombre_criterio_gen, ' ', '')=replace('".$txtNombreCriterio."', ' ', '')");

        return $data->result();
	}

	function listarCriterioGPorAnios($anio)
	{
		$data=$this->db->query("select * from CRITERIO_GEN where CRITERIO_GEN.anio_criterio_gen='$anio'");
        return $data->result();
	}
	function listarCriterioGPorAniosFuncion($anio,$id_funcion)
	{
		$data=$this->db->query("select * from CRITERIO_GEN  INNER JOIN FUNCION ON CRITERIO_GEN.id_funcion=FUNCION.id_funcion  WHERE
			CRITERIO_GEN.anio_criterio_gen='$anio'  and FUNCION.id_funcion='$id_funcion' ");
        return $data->result();

	}
}
