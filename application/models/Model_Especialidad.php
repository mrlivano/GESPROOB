<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Especialidad extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ListarEspecialidad()
	{
		$data=$this->db->query("select * from ESPECIALIDAD order by (nombre_esp)");

		return $data->result();
	}

	public function addEspecialidad($txt_nombre_esp)
	{
		$data = array(
		        'nombre_esp' => $txt_nombre_esp,
		);

		$this->db->insert('ESPECIALIDAD', $data);
		return $result;
	}
	public function updateEspecialidad($txt_id_esp, $txt_nombre_esp_M)
	{
		$data = array(
						'nombre_esp' => $txt_nombre_esp_M
		);
		$this->db->where('id_esp', $txt_id_esp);
		$this->db->update('ESPECIALIDAD', $data);
	}
	function deleteEspecialidad($id_esp)
	{
		$this->db->where('id_esp',$id_esp);
		$this->db->delete('ESPECIALIDAD');
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}
}
