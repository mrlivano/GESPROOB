<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_UF_Req_Personal_Estudio extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function insertar($id_est_inv, $id_persona, $id_esp, $fecha_desig, $formulador)
	{
		$this->db->query("exec sp_Gestionar_UfRPersonalEstudio_c @opcion='insertar', @id_est_inv=$id_est_inv, @id_persona=$id_persona, @id_esp=$id_esp, @fecha_desig=$fecha_desig, @formulador=$formulador");

		return true;
	}


    function ETPerReqPorIdETFormulacion($id_est_inv)
	{
		$data=$this->db->query("select * from UF_REQ_PERSONAL_ESTUDIO as UfReqPersonal inner join ESPECIALIDAD as e on UfReqPersonal.id_esp=e.id_esp
								left join PERSONA as p on UfReqPersonal.id_persona=p.id_persona where UfReqPersonal.id_est_inv='".$id_est_inv."' order by (e.nombre_esp)");

		return $data->result();
	}

	function ultimoETPerReqFormulador()
	{
		$data=$this->db->query("select * from UF_REQ_PERSONAL_ESTUDIO where id_req_per=(select max(id_req_per) from UF_REQ_PERSONAL_ESTUDIO)");

		return count($data->result())==0 ? null : $data->result()[0];
	}

	function asignarQuitarFormulador($idPerReq,$formulador)
	{
		$this->db->query("exec sp_Gestionar_UfRPersonalEstudio_c @opcion='asignarQuitarFormulador',@id_req_per='$idPerReq' , @formulador='$formulador' ");

		return true;
	}

	function asignarPersonal($idPerReq,$idPersona,$fecha_desig)
	{

		$this->db->query("exec sp_Gestionar_UfRPersonalEstudio_c @opcion='asignarPersonal', @id_req_per=$idPerReq,@id_persona=$idPersona,@fecha_desig='$fecha_desig' ");

		return true;
	}

	function existePersonaPorET($idPersona, $id_est_inv)
	{
		
			$data=$this->db->query(" select * from UF_REQ_PERSONAL_ESTUDIO where UF_REQ_PERSONAL_ESTUDIO.id_persona=$idPersona and id_est_inv=$id_est_inv ");
			return count($data->result())>0 ? true : false;
	}

	function listaIndependienteEstudio($id_est_inv)
	{
		
		$data=$this->db->query("select * from UF_ESTUDIO_INVERSION_2 where UF_ESTUDIO_INVERSION_2.id_est_inv='$id_est_inv'");

		return $data->result()[0];
	}


}