<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entidad extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Entidad');
	}
    
    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function index()
	{
		$this->_load_layout('Front/Administracion/frmSectorEntidad');
	}
    function GetEntidad()
	{
		if ($this->input->is_ajax_request()) 
		{
		$datos=$this->Model_Entidad->GetEntidad();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}
	//añadir enidad
	 function AddEntidad()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
	      $listaSector =$this->input->post("listaSector");
	      $txt_NombreEntidad =$this->input->post("txt_NombreEntidad");
	      $txt_DenominacionEntidad =$this->input->post("txt_DenominacionEntidad");
	    
	     $Data=$this->Model_Entidad->AddEntidad($listaSector,$txt_NombreEntidad,$txt_DenominacionEntidad);
	     echo json_encode($Data);
		 } 
	     else
	     {
	      show_404();
	      }
	  

 	 }
 	 function UpdateEntidad()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
	      $txt_IdModificarEntidar =$this->input->post("txt_IdModificarEntidar");
	      $id_sector=$this->input->post("listaSectorModificar");
	      $txt_NombreEntidadM =$this->input->post("txt_NombreEntidadM");
	      $txt_DenominacionEntidadM =$this->input->post("txt_DenominacionEntidadM");
	    
	     if($this->Model_Entidad->UpdateEntidad($txt_IdModificarEntidar,$id_sector,$txt_NombreEntidadM,$txt_DenominacionEntidadM) == false)
		       echo "Se actualizo una nueva entidad";
		      else
		      echo "Se actualizo  una nueva entidad"; 
		 } 
	     else
	     {
	      show_404();
	      }
	  

 	 }
 	 function EliminarEntidad()
 	 {
 	 	if($this->input->is_ajax_request()) 
	    {

	      $id_entidad=$this->input->post("id_entidad");
	     if($this->Model_Entidad->EliminarEntidad($id_entidad)== false)
		       echo "Se elimino la entidad";
		      else
		      echo "Se elimino entidad"; 
		 } 
	     else
	     {
	      show_404();
	      }
 	 }

    /*Fin Servicios publico asociado*/
	function _load_layout($template)
    {
      $this->load->view('layout/ADMINISTRACION/header');
      $this->load->view($template);
      $this->load->view('layout/ADMINISTRACION/footer');
    }

}
