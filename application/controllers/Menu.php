<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

public function __construct(){
		parent::__construct();
		$this->load->model('Model_Menu');

	}


	public function index()
	{

		$this->_load_layout('Front/Usuario/frm_menu');
	}

	function addMenu(){
	    if ($this->input->is_ajax_request()){
	        $tx_nombre =$this->input->post("tx_nombre");
	         $tx_url =$this->input->post("tx_url");
	          $tx_posicion =$this->input->post("tx_posicion");
	           $tx_class_icono =$this->input->post("tx_class_icono");
	             $cbx_menuPadre =$this->input->post("cbx_menuPadre");
	             $cbx_modulo =$this->input->post("cbx_modulo");
	             $cbx_nivel =$this->input->post("cbx_nivel");
	     	echo $this->Model_Menu->addMenu($tx_nombre,$tx_url,$tx_posicion, $cbx_menuPadre,$cbx_nivel,$cbx_modulo,$tx_class_icono);
		}
		else{
		    show_404();
		}
 	}
 	function updateMenu($idMenu){
	    if ($this->input->is_ajax_request()){
		    $tx_nombre =$this->input->post("tx_nombre");
	         $tx_url =$this->input->post("tx_url");
	          $tx_posicion =$this->input->post("tx_posicion");
	           $tx_class_icono =$this->input->post("tx_class_icono");
	           	             $cbx_menuPadre =$this->input->post("cbx_menuPadre");
	           	                $cbx_modulo =$this->input->post("cbx_modulo");
	             $cbx_nivel =$this->input->post("cbx_nivel");
		    echo $this->Model_Menu->updateMenu($idMenu,$tx_nombre,$tx_url,$tx_posicion, $cbx_menuPadre,$cbx_nivel,$cbx_modulo,$tx_class_icono);
	    }
	    else{
	      	show_404();
	    }
 	}
	function _load_layout($template)
    {
      $this->load->view('layout/USUARIO/header');
      $this->load->view($template);
      $this->load->view('layout/USUARIO/footer');
    }
    function getMenu(){
		if ($this->input->is_ajax_request()) {
			$datos=$this->Model_Menu->getMenu();
			echo json_encode($datos);
		}
		else{
			show_404();
		}
	}
	function itemMenu(){
		if($this->input->get('id_menu')!=''){
    		$data['arrayMenu']=$this->Model_Menu->getMenu($this->input->get('id_menu'))[0];
			$this->load->view('Front/Usuario/itemMenu',$data);
    	}
    	else{
			$this->load->view('Front/Usuario/itemMenu');
    	}
	}



}
