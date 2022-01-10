<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elfiles extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
    	$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Estudio_Inversion_Model');
	}

	public function index()
	{
		echo("hola");
	}

	/* Standalone Elfinder */
	public function elfinder_files()
	{
		$mod = $_GET['mod'];
    	$id_et = $_GET['id_et'];
		if ($mod == "FE") 
		{
			$folders2 = $this->Estudio_Inversion_Model->get_EstudioInversion();
			foreach ($folders2 as $folder2) 
			{
				if (!file_exists('uploads/RepositorioFE/'.$folder2->codigo_unico_est_inv)) 
				{
		      		$path = FCPATH . 'uploads/RepositorioFE/'.$folder2->codigo_unico_est_inv;
		        	mkdir($path, 0777, true);
		    	}
		  	}
			$this->load->helper('url');
	    	$data['connector'] = site_url() . '/elfiles/elfinder_init?id_et='.$id_et.'&mod=FE';
	    	$this->load->view('elfinder_view', $data);
		} 
		else 
		{
	    	$folders = $this->Model_ET_Expediente_Tecnico->ListarExpedienteTecnico();
			foreach ($folders as $folder) 
			{
				if (!file_exists('uploads/Repositorio/'.$folder->id_et)) 
				{
	        		$path = FCPATH . 'uploads/Repositorio/'.$folder->id_et;
	          		mkdir($path, 0777, true);
	      		}	
	    	}
			$this->load->helper('url');
			$data['connector'] = site_url() . '/elfiles/elfinder_init?id_et='.$id_et;
			$this->load->view('elfinder_view', $data);
		}
	}

	/* Popup Elfinder in TinyMCE */
	public function elfinder_popup()
	{
		$this->load->view('elfinder_popup_view');
	}

	/* Elfinder initialization */
	public function elfinder_init()
	{
		$id_et = $_GET['id_et'];
		$id_persona = $this->session->userdata('idPersona');
		$idTipoUsuario = $this->session->userdata('tipoUsuario');
		$folders = $this->Model_ET_Expediente_Tecnico->belongsETtoUser($id_persona, $id_et, $idTipoUsuario);
		$folders2 = $this->Estudio_Inversion_Model->getEstudioInversionF($id_persona, $id_et, $idTipoUsuario);
		$folderArray = [];

		foreach ($folders as $folder) 
		{
			array_push($folderArray,
				array(
					'driver' => 'LocalFileSystem',
					'path' =>  'uploads/Repositorio/'.$folder->id_et,
					'URL' => base_url('uploads/Repositorio/'.$folder->id_et),
					'alias' => 'Expediente '.$folder->id_et,
					'uploadMaxSize' => '2000M',
					'uploadDeny'    => array('all'),                 // Recomend the same settings as the original volume that uses the trash
					'uploadAllow'   => array('all'),                // Same as above
					'uploadOrder'   => array('deny', 'allow'),      // Same as above
					'accessControl' => array($this, 'elfinderAccess'),
					'attributes' => array(
						array(
							'pattern' => '/\.tmb$/',
							'read' => true,
							'write' => true,
							'locked' => true,
							'hidden' => true
						)
					)
				)
			);
		}

		foreach ($folders2 as $folder2) {
			array_push($folderArray,
				array(
					'driver' => 'LocalFileSystem',
					'path' =>  'uploads/RepositorioFE/'.$folder2->codigo_unico_est_inv,
					'URL' => base_url('uploads/RepositorioFE/'.$folder2->codigo_unico_est_inv),
					'alias' => 'Expediente '.$folder2->codigo_unico_est_inv,
					'uploadMaxSize' => '2000M',
					'uploadDeny'    => array('all'),                 // Recomend the same settings as the original volume that uses the trash
					'uploadAllow'   => array('all'),                // Same as above
					'uploadOrder'   => array('deny', 'allow'),      // Same as above
					'accessControl' => array($this, 'elfinderAccess'),
					'attributes' => array(
						array(
							'pattern' => '/\.tmb$/',
							'read' => true,
							'write' => true,
							'locked' => true,
							'hidden' => true
						)
					)
				)
			);
		}

		$opts = array(
			'debug' => false,
			'roots' => $folderArray
		);
		$this->load->library('elfinder_lib/Elfinder_lib', $opts);
	}

	public function elfinderAccess($attr, $path, $data, $volume, $isDir, $relpath)
	{
		$basename = basename($path);
		return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
				&& strlen($relpath) !== 1           // but with out volume root
			? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
			:  null;                                 // else elFinder decide it itself
	}

}
