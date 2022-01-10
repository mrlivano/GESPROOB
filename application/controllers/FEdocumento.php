<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FEdocumento extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
	}
    
    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function ver_Documentos()
	{
		$this->_load_layout('Front/Formulacion_Evaluacion/frmDocumentos');
	}
	function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
