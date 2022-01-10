<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Archivo_Obs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Model_ET_Archivo_Obs");
	}

	public function descargar($idETArchivoObs)
	{
		$etArchivoObsTemp=$this->Model_ET_Archivo_Obs->ETArchivoObs($idETArchivoObs);

		$extensionArchivoObsTemp=$etArchivoObsTemp->ext_archivo;

		$rutaArchivoObsTemp='./uploads/ArchivoObservacionTareaGanttET/'.$idETArchivoObs.'.'.$extensionArchivoObsTemp;

		$data=file_get_contents($rutaArchivoObsTemp);

		$this->load->helper('download');
		
		force_download($etArchivoObsTemp->nombre_archivo, $data);
	}
}