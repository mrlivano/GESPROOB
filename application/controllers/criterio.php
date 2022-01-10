<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Criterio extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Criterio');
	}
	public function mantenimiento(){
		$this->_load_layout('front/Criterio/frmMantenimiento');
	}
	public function prioridad(){
		$this->_load_layout('front/Criterio/frmPrioridad');
	}
	function itemPrioridad(){
		$data['id_proyecto']=$this->input->get("id_proyecto");
    	$data['arrayValorizacion']=$this->Model_Criterio->getValorizacion($this->input->get("id_proyecto"),$this->input->get("id_funcion"));
		$this->load->view('Front/Criterio/itemPrioridad',$data);
	}
	function itemCriterio(){
		if($this->input->get('id_criterio')!=''){
    		$data['arrayCriterio']=$this->Model_Criterio->getCriterio($this->input->get('id_criterio'))[0];
			$this->load->view('Front/Criterio/itemCriterio',$data);
    	}
    	else{
			$this->load->view('Front/Criterio/itemCriterio');
    	}
	}
	function itemFactor(){
		if($this->input->get('id_factor')!=''){
    		$data['arrayFactor']=$this->Model_Criterio->getFactor($this->input->get('id_factor'))[0];
			$this->load->view('Front/Criterio/itemFactor',$data);
    	}
    	else{
			$this->load->view('Front/Criterio/itemFactor');
    	}
	}
	function itemValorizacion(){
		if($this->input->get('id_valorizacion')!=''){
    		$data['arrayValorizacion']=$this->Model_Criterio->getValorizacionPtje(0,$this->input->get('id_valorizacion'))[0];
			$this->load->view('Front/Criterio/itemValorizacion',$data);
    	}
    	else{
    		$data['idCriterio']=$this->input->get('idCriterio');
			$this->load->view('Front/Criterio/itemValorizacion',$data);
    	}
	}
	function _load_layout($template){
      $this->load->view('layout/PMI/header');
      $this->load->view($template);
      $this->load->view('layout/PMI/footer');
    }
    function getFactor()
    {
		if ($this->input->is_ajax_request()) {
			$datos=$this->Model_Criterio->getFactor();
			echo json_encode($datos);
		}
		else{
			show_404();
		}
	}
	function getPrioridad()
	{
		$proyecto=$this->input->get("id_project");
		$datos=$this->Model_Criterio->getPrioridad($proyecto);
		echo json_encode($datos);
	}
	function addFactor(){
	    if ($this->input->is_ajax_request()){
	        $tx_nombre_factor =$this->input->post("tx_nombre_factor");
	     	echo $this->Model_Criterio->addFactor($tx_nombre_factor);
		}
		else{
		    show_404();
		}
 	}
 	function updateFactor($idFactor){
	    if ($this->input->is_ajax_request()){
		    $tx_nombre_factor =$this->input->post("tx_nombre_factor");
		    echo $this->Model_Criterio->updateFactor($idFactor,$tx_nombre_factor);
	    }
	    else{
	      	show_404();
	    }
 	}
 	function addCriterio(){
	    if ($this->input->is_ajax_request()){
	        $tx_nombre_criterio =$this->input->post("tx_nombre_criterio");
	        $cbx_idFactor =$this->input->post("cbx_idFactor");
	        $cbx_idFuncion =$this->input->post("cbx_idFuncion");
	        $tx_peso_criterio =$this->input->post("tx_peso_criterio");
	        $tx_definicion_criterio =$this->input->post("tx_definicion_criterio");
	     	echo $this->Model_Criterio->addCriterio($tx_nombre_criterio,$cbx_idFactor,$tx_peso_criterio,$tx_definicion_criterio,$cbx_idFuncion);
		}
		else{
		    show_404();
		}
 	}
 	function updateCriterio($idCriterio){
	    if ($this->input->is_ajax_request()){
		    $tx_nombre_criterio =$this->input->post("tx_nombre_criterio");
	        $cbx_idFactor =$this->input->post("cbx_idFactor");
	        $cbx_idFuncion =$this->input->post("cbx_idFuncion");
	        $tx_peso_criterio =$this->input->post("tx_peso_criterio");
	        $tx_definicion_criterio =$this->input->post("tx_definicion_criterio");
		    echo $this->Model_Criterio->updateCriterio($idCriterio,$tx_nombre_criterio,$cbx_idFactor,$tx_peso_criterio,$tx_definicion_criterio,$cbx_idFuncion);
	    }
	    else{
	      	show_404();
	    }
 	}
 	function addValorizacion($idCriterio){
	    if ($this->input->is_ajax_request()){
	        $tx_nombre_valorizacion =$this->input->post("tx_nombre_valorizacion");
	        $tx_puntaje_valorizacion =$this->input->post("tx_puntaje_valorizacion");
	     	echo $this->Model_Criterio->addValorizacion($idCriterio,$tx_nombre_valorizacion,$tx_puntaje_valorizacion);
		}
		else{
		    show_404();
		}
 	}
 	function updateValorizacion($idValorizacion){
	    if ($this->input->is_ajax_request()){
		    $tx_nombre_valorizacion =$this->input->post("tx_nombre_valorizacion");
	        $tx_puntaje_valorizacion =$this->input->post("tx_puntaje_valorizacion");
		    echo $this->Model_Criterio->updateValorizacion($idValorizacion,$tx_nombre_valorizacion,$tx_puntaje_valorizacion);
	    }
	    else{
	      	show_404();
	    }
 	}

	function getCriterio(){
		if ($this->input->is_ajax_request()) {
			$datos=$this->Model_Criterio->getCriterio();
			echo json_encode($datos);
		}
		else{
			show_404();
		}
	}
	function getValorizacionPtje($criterio){
		if ($this->input->is_ajax_request()) {
			$datos=$this->Model_Criterio->getValorizacionPtje($criterio);
			echo json_encode($datos);
		}
		else{
			show_404();
		}
	}
	function addPrioridad(){	
		if ($this->input->is_ajax_request()) {
			echo $this->Model_Criterio->addPrioridad($this->input->post("id_proyecto"),$this->input->post("arrayValorizacion"));
		}
		else{
			show_404();
		}
	}
}
