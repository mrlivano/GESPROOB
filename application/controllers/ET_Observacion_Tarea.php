<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Observacion_Tarea extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Observacion_Tarea');
		$this->load->model('Model_ET_Archivo_Obs');
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Per_Req');
		$this->load->model('Model_ET_Levantamiento_Obs');
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start();

				$idPersonaTemp=$this->session->userdata('idPersona');

				$idTareaET=$this->input->post('idTareaET');
				$idET=$this->input->post('idET');
				$descObservacionTarea=$this->input->post('descObservacionTarea');
				$fechaObservacionTarea=date('Y-m-d H:i:s');

				$etPerReq=$this->Model_ET_Per_Req->ETPerReqCraetPorIdETYIdPersona($idET, $idPersonaTemp);

				if($etPerReq==null)
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no puede realizar observación porque no es CRAET de este proyecto.']);exit;
				}

				$this->Model_ET_Observacion_Tarea->insertar($idTareaET, $etPerReq->id_per_req, $descObservacionTarea, $fechaObservacionTarea, 0);

				$ultimoETObservacionTarea=$this->Model_ET_Observacion_Tarea->ultimoETObservacionTarea();

				$config['upload_path']='./uploads/ArchivoObservacionTareaGanttET';
				$config['allowed_types']='*';
				$config['max_width']=2000;
				$config['max_height']=2000;
				$config['max_size']=50000;
				$config['encrypt_name']=false;

				foreach($_FILES as $key => $value)
				{
					$this->Model_ET_Archivo_Obs->insertar($ultimoETObservacionTarea->id_observacion_tarea, $value['name'], date('Y-m-d H:i:s'), explode('.', $value['name'])[count(explode('.', $value['name']))-1]);

					$ultimoETArchivoObs=$this->Model_ET_Archivo_Obs->ultimoETArchivoObs();

					$config['file_name']=$ultimoETArchivoObs->id_archivo_obs;

					$this->load->library('upload', $config);
					
					$this->upload->initialize($config);
					
					$this->upload->do_upload($key);
				}

				$ultimoETObservacionTarea->childETArchivoObs=$this->Model_ET_Archivo_Obs->ETArchivoObsPorIdObservacionTarea($ultimoETObservacionTarea->id_observacion_tarea);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Observación realizada correctamente.', 'etObservacionTarea' => $ultimoETObservacionTarea]);exit;
			}

			$idTareaET=$this->input->get('idTareaET');
			$idET=$this->input->get('idET');

			$ETAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idET);
			$aprobado=($ETAprobado[0]->aprobado==1 ? 1 : 0);

			$listaETObservacionTarea=$this->Model_ET_Observacion_Tarea->ETObservacionTareaPorIdTareaET($idTareaET);

			foreach($listaETObservacionTarea as $key => $value)
			{
				$value->childETArchivoObs=$this->Model_ET_Archivo_Obs->ETArchivoObsPorIdObservacionTarea($value->id_observacion_tarea);
				$value->childETLevantamientoObs=$this->Model_ET_Levantamiento_Obs->ETLevantamientoObsPorIdObservacionTarea($value->id_observacion_tarea);
			}

			return $this->load->view('front/Ejecucion/ETObservacionTarea/insertar', ['idTareaET' => $idTareaET, 'idET' => $idET, 'listaETObservacionTarea' => $listaETObservacionTarea,'aprobado'=>$aprobado]);
		}
	}

	public function eliminar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start();

				$idPersonaTemp=$this->session->userdata('idPersona');

				$idObservacionTarea=$this->input->post('idObservacionTarea');

				if($this->Model_ET_Observacion_Tarea->ETObervacionTareaPorIdObservacionTareaYIdPersona($idObservacionTarea, $idPersonaTemp)==null)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no tiene autorización para borrar esta observación.']);exit;
				}

				$listaETArchivoObs=$this->Model_ET_Archivo_Obs->ETArchivoObsPorIdObservacionTarea($idObservacionTarea);

				foreach($listaETArchivoObs as $key => $value)
				{
					$rutaArchivoObsTemp='./uploads/ArchivoObservacionTareaGanttET/'.$value->id_archivo_obs.'.'.$value->ext_archivo;

					if(file_exists($rutaArchivoObsTemp))
					{
						unlink($rutaArchivoObsTemp);
					}
				}

				$listaETLevantamientoObsTemp=$this->Model_ET_Levantamiento_Obs->ETLevantamientoObsPorIdObservacionTarea($idObservacionTarea);

				foreach($listaETLevantamientoObsTemp as $key => $value)
				{
					if($value->ext_archivo=='')
					{
						continue;
					}

					$rutaArchivoTemp='./uploads/ArchivoLevantamientoObsTareaGanttET/'.$value->id_levantamiento_obs.'.'.$value->ext_archivo;

					if(file_exists($rutaArchivoTemp))
					{
						unlink($rutaArchivoTemp);
					}
				}

				$this->Model_ET_Observacion_Tarea->eliminar($idObservacionTarea);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Observación eliminada correctamente.']);exit;
			}
		}
	}
}
?>