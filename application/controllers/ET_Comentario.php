<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Comentario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Comentario');
		$this->load->model('Model_ET_Especialista_Tarea');
		$this->load->model('Model_ET_Archivo');
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
				$descComentario=$this->input->post('descComentario');
				$fechaComentario=date('Y-m-d H:i:s');

				$etEspecialistaTarea=$this->Model_ET_Especialista_Tarea->EspecialistaTareaPorIdTareaYIdPersona($idTareaET, $idPersonaTemp);

				if($etEspecialistaTarea==null)
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no puede realizar comentarios porque no fue asignado a esta actividad.']);exit;
				}

				$this->Model_ET_Comentario->insertar($idTareaET, $etEspecialistaTarea->id_especialista_tarea, $descComentario, $fechaComentario);

				$ultimoETComentario=$this->Model_ET_Comentario->ultimoETComentario();

				$config['upload_path']='./uploads/ArchivoComentarioTareaGanttET';
				$config['allowed_types']='*';
				$config['max_width']=2000;
				$config['max_height']=2000;
				$config['max_size']=50000;
				$config['encrypt_name']=false;

				foreach($_FILES as $key => $value)
				{
					$this->Model_ET_Archivo->insertar($ultimoETComentario->id_et_comentario, $value['name'], date('Y-m-d H:i:s'), explode('.', $value['name'])[count(explode('.', $value['name']))-1]);

					$ultimoETArchivo=$this->Model_ET_Archivo->ultimoETArchivo();

					$config['file_name']=$ultimoETArchivo->id_et_archivo;

					$this->load->library('upload', $config);
					
					$this->upload->initialize($config);
					
					$this->upload->do_upload($key);
				}

				$ultimoETComentario->childETArchivo=$this->Model_ET_Archivo->ETArchivoPorIdETComentario($ultimoETComentario->id_et_comentario);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Comentario realizado correctamente.', 'etComentario' => $ultimoETComentario]);exit;
			}

			$idTareaET=$this->input->get('idTareaET');

			$listaETComentario=$this->Model_ET_Comentario->ETComentarioPorIdTareaET($idTareaET);

			foreach($listaETComentario as $key => $value)
			{
				$value->childETArchivo=$this->Model_ET_Archivo->ETArchivoPorIdETComentario($value->id_et_comentario);
			}

			return $this->load->view('front/Ejecucion/ETComentario/insertar', ['idTareaET' => $idTareaET, 'listaETComentario' => $listaETComentario]);
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

				$idETComentario=$this->input->post('idETComentario');

				if($this->Model_ET_Comentario->ETComentarioPorIdETComentarioYIdPersona($idETComentario, $idPersonaTemp)==null)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ud. no tiene autorización para borrar este comentario.']);exit;
				}

				$listaETArchivo=$this->Model_ET_Archivo->ETArchivoPorIdETComentario($idETComentario);

				foreach($listaETArchivo as $key => $value)
				{
					$rutaArchivoTemp='./uploads/ArchivoComentarioTareaGanttET/'.$value->id_et_archivo.'.'.$value->ext_archivo;

					if(file_exists($rutaArchivoTemp))
					{
						unlink($rutaArchivoTemp);
					}
				}

				$this->Model_ET_Comentario->eliminar($idETComentario);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Comentario eliminado correctamente.']);exit;
			}
		}
	}
}
?>