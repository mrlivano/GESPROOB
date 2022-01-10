<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensaje extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Mensaje');
	}
	function itemMensaje(){
		$this->load->view('Front/mensaje/itemMensaje');
	}
	function bandejaEntrada(){
		$this->load->view('Front/mensaje/bandejaEntrada');
	}
	function listarMensaje(){
		$datos=$this->Model_Mensaje->listarMensaje();
		echo json_encode($datos);
	}
	function enviar(){
	   echo $this->Model_Mensaje->enviar($this->input->post("tx_mensaje"),$this->input->post("sl_destino"));
	}
	function eliminarMensaje(){
	   echo $this->Model_Mensaje->eliminarMensaje($this->input->post("id_mensaje"));
	}
	
}
