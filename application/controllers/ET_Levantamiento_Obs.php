<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Levantamiento_Obs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Observacion_Tarea');
		$this->load->model('Model_ET_Levantamiento_Obs');
		$this->load->model('Model_ET_Especialista_Tarea');
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
				$idObservacionTarea=$this->input->post('idObservacionTarea');
				$descLevObs=$this->input->post('descLevObs');
				$fechaLevObs=date('Y-m-d H:i:s');

				$etEspecialistaTarea=$this->Model_ET_Especialista_Tarea->EspecialistaTareaPorIdTareaYIdPersona($idTareaET, $idPersonaTemp);

				if($etEspecialistaTarea==null)
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no puede responder esta observación porque no fuiste asignado a esta actividad.']);exit;
				}

				$ultimoETLevantamientoObs=null;

				if(count($_FILES)==0)
				{
					$this->Model_ET_Levantamiento_Obs->insertar($etEspecialistaTarea->id_especialista_tarea, $idObservacionTarea, $descLevObs, $fechaLevObs, '');

					$ultimoETLevantamientoObs=$this->Model_ET_Levantamiento_Obs->ultimoETLevantamientoObs();
				}
				else
				{
					$config['upload_path']='./uploads/ArchivoLevantamientoObsTareaGanttET';
					$config['allowed_types']='*';
					$config['max_width']=2000;
					$config['max_height']=2000;
					$config['max_size']=50000;
					$config['encrypt_name']=false;

					foreach($_FILES as $key => $value)
					{
						$this->Model_ET_Levantamiento_Obs->insertar($etEspecialistaTarea->id_especialista_tarea, $idObservacionTarea, $descLevObs, $fechaLevObs, explode('.', $value['name'])[count(explode('.', $value['name']))-1]);

						$ultimoETLevantamientoObs=$this->Model_ET_Levantamiento_Obs->ultimoETLevantamientoObs();
						
						$config['file_name']=$ultimoETLevantamientoObs->id_levantamiento_obs;

						$this->load->library('upload', $config);
						
						$this->upload->initialize($config);
						
						$this->upload->do_upload($key);
					}
				}

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Respuesta publicada correctamente.', 'etLevantamientoObs' => $ultimoETLevantamientoObs]);exit;
			}
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

				$idLevantamientoObs=$this->input->post('idLevantamientoObs');

				if($this->Model_ET_Levantamiento_Obs->ETLevantamientoObsPorIdLevantamientoObsYIdPersona($idLevantamientoObs, $idPersonaTemp)==null)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no tiene autorización para borrar esta respuesta.']);exit;
				}

				$etLevantamientoObsTemp=$this->Model_ET_Levantamiento_Obs->ETLevantamientoObs($idLevantamientoObs);

				if($etLevantamientoObsTemp->ext_archivo!='')
				{
					$rutaArchivoTemp='./uploads/ArchivoLevantamientoObsTareaGanttET/'.$etLevantamientoObsTemp->id_levantamiento_obs.'.'.$etLevantamientoObsTemp->ext_archivo;

					if(file_exists($rutaArchivoTemp))
					{
						unlink($rutaArchivoTemp);
					}
				}

				$this->Model_ET_Levantamiento_Obs->eliminar($idLevantamientoObs);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Respuesta eliminada correctamente.']);exit;
			}
		}
	}

	public function descargarArchivo($idLevantamientoObs)
	{
		$etIdLevantamientoObs=$this->Model_ET_Levantamiento_Obs->ETLevantamientoObs($idLevantamientoObs);

		$extensionArchivoTemp=$etIdLevantamientoObs->ext_archivo;

		$rutaArchivoObsTemp='./uploads/ArchivoLevantamientoObsTareaGanttET/'.$idLevantamientoObs.'.'.$extensionArchivoTemp;

		$data=file_get_contents($rutaArchivoObsTemp);

		$this->load->helper('download');
		
		force_download($idLevantamientoObs.'.'.$extensionArchivoTemp, $data);
	}
}
?>