<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Responsable extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Especialidad');
		$this->load->model('Model_ET_Per_Req');
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_Personal');
		$this->load->model('Cargo_Modal');
		$this->load->model('Model_ET_Responsable');
		
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 

				$msg = array();

	            $c_data['id_et']=$this->input->post('idET');
	            $c_data['id_tipo_responsable_et']=3;
	            $c_data['id_cargo']=$this->input->post('idCargo');
	            $c_data['estado_responsable_et']=1;

	            $cargos=$this->Model_ET_Responsable->countCargo($this->input->post('idET'),$this->input->post('idCargo'));

	            if(count($cargos)>0)
	            {
	            	foreach ($cargos as $key => $value) 
	            	{
	            		$u_data['estado_responsable_et']=0;
	            		$data = $this->Model_ET_Responsable->editar($u_data,$value->id_responsable_et);
	            	}
	            }   

	            $data = $this->Model_ET_Responsable->insertar($c_data);

				$this->db->trans_complete();

				$msg = ($data != '' || $data != NULL ? (['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.', 'idRespEt' =>$data]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            	echo json_encode($msg);exit;
			}

			$idET=$this->input->get('idExpedienteTecnico');

			$ETAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idET);

			$aprobado=($ETAprobado[0]->aprobado==1 ? 1 : 0);

			$listaCargo=$this->Cargo_Modal->getcargo();
			$listaRespEt=$this->Model_ET_Responsable->personalPorET($idET);
			$listaPersona=$this->Model_Personal->verTodo();

			return $this->load->view('front/Ejecucion/ETResponsable/insertar', ['listaCargo'=>$listaCargo, 'idET' => $idET, 'listaRespEt' => $listaRespEt, 'listaPersona' => $listaPersona,'aprobado'=>$aprobado]);
		}
	}

	public function eliminar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{		

				$msg = array();

				$this->db->trans_start(); 				
				$idEtResponsable=$this->input->post('idEtResponsable');
				$data = $this->Model_ET_Responsable->eliminar($idEtResponsable);
				$this->db->trans_complete();

		        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Datos eliminados correctamente.']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
		        echo json_encode($msg);exit;
			}
		}
	}

	public function asignarPersonal()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$msg = array();
				$this->db->trans_start(); 

				$c_data['id_persona']=$this->input->post('idPersona');
	            
	            
	            $data = $this->Model_ET_Responsable->editar($c_data,$this->input->post('idEtResponsable'));

				$this->db->trans_complete();

				$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Personal asignado correctamente.']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        		echo json_encode($msg);exit;
			}
		}
	}

	public function asignarFecha()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$msg = array();
				$this->db->trans_start(); 

				$c_data['fecha_asignacion_resp_et']=$this->input->post('fecha');
	            
	            $data = $this->Model_ET_Responsable->editar($c_data,$this->input->post('idEtResponsable'));

				$this->db->trans_complete();

				$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Personal asignado correctamente.']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        		echo json_encode($msg);exit;
			}
		}
	}

}