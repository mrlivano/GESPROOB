<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Archivo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Model_ET_Archivo");
	}

	public function descargar($idETArchivo)
	{
		$etArchivoTemp=$this->Model_ET_Archivo->ETArchivo($idETArchivo);

		$extensionArchivoTemp=$etArchivoTemp->ext_archivo;

		$rutaArchivoTemp='./uploads/ArchivoComentarioTareaGanttET/'.$idETArchivo.'.'.$extensionArchivoTemp;

		$data=file_get_contents($rutaArchivoTemp);

		$this->load->helper('download');
		
		force_download($etArchivoTemp->nombre_archivo, $data);
	}
}