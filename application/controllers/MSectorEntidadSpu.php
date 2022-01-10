<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSectorEntidadSpu extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Sector');
	}
    
    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function index()
	{
		$this->_load_layout('Front/Administracion/frmSectorEntidad');
	}
    /*fin pagina principal de la vista */
    
    /* Sector*/
	 function GetSector()
	{
		if ($this->input->is_ajax_request()) 
		{
		$datos=$this->Model_Sector->GetSector();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}
	 function AddSector()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
	      $txt_NombreSector =$this->input->post("txt_NombreSector");
	      if($this->Model_Sector->AddSector($txt_NombreSector) == false)
	        echo "Se añadio un  sector";
	      else
	        echo "No se añadio  un sector";  
		 }
		 else
		  {
		      show_404();
		   }

 	 }
 	 function UpdateSector()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
		      $txt_IdModificar =$this->input->post("txt_IdModificar");
		      $txt_NombreSectorM =$this->input->post("txt_NombreSectorM");
		      if($this->Model_Sector->UpdateSector($txt_IdModificar,$txt_NombreSectorM) == false)
		        echo "Se actualizo correctamente el sector";
		      else
		        echo "No Se actualizo correctamente el sector"; 
	    }
	    else
	    {
	      	show_404();
	    }
	    
		

 	 }
    /*fin sector*/
    
    /* Entidad*/
    function GetEntidad()
	{
		if ($this->input->is_ajax_request()) 
		{
		$datos=$this->Model_Sector->GetEntidad();
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
	    
	     if($this->Model_Sector->AddEntidad($listaSector,$txt_NombreEntidad,$txt_DenominacionEntidad) == false)
		       echo "Se añadio una nueva entidad";
		      else
		      echo "No se añadio  una nueva entidad";  
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
	    
	     if($this->Model_Sector->UpdateEntidad($txt_IdModificarEntidar,$id_sector,$txt_NombreEntidadM,$txt_DenominacionEntidadM) == false)
		       echo "Se actualizo una nueva entidad";
		      else
		      echo "No se actualizo  una nueva entidad"; 
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
	     if($this->Model_Sector->EliminarEntidad($id_entidad)== false)
		       echo "Se elimino";
		      else
		      echo "no se elimino"; 
		 } 
	     else
	     {
	      show_404();
	      }
 	 }
 	 function EliminarSector()
 	 {
 	 	if($this->input->is_ajax_request()) 
	    {

	      $id_sector=$this->input->post("id_sector");
	     if($this->Model_Sector->EliminarSector($id_sector)== false)
		       echo "Se elimino el sector";
		      else
		      echo "No se elimino el sector"; 
		 } 
	     else
	     {
	      show_404();
	      }

 	 }

    function GetServicioAsociado()
	{
		if ($this->input->is_ajax_request()) 
		{
		$datos=$this->Model_Sector->GetServicioAsociado();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}
	
	function AddServicioAsociado()
	{
	    if ($this->input->is_ajax_request()) 
	    {
			$c_data['nombre_serv_pub_asoc']=$this->input->post("textarea_servicio_publicoA");
			if($this->Model_ServicioPublico->AddServicioAsociado($this->security->xss_clean($c_data)))
			{
				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Cambios guardados correctamente.']);exit;
			}
			else
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error.']);exit;
			}			
		}
	    else
	    {
	    	show_404();
	    }
 	}
 
 	 function UpdateServicioAsociado()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
	      $id_servicio_publicoA =$this->input->post("id_servicio_publicoA");
	      $textarea_servicio_publicoA=$this->input->post("textarea_servicio_publicoAA");
	     if($this->Model_Sector->UpdateServicioAsociado($id_servicio_publicoA,$textarea_servicio_publicoA) ==true)
		       echo "Se actualizo el Servicio Publico Asociado";
		      else
		      echo "No se actualizo el Servicio Publico Asociado"; 
		 } 

	     else
	     {
	      show_404();
	      }
	  

 	 }
 	  function EliminarServicioPublico()
       {

       }
    /*Fin Servicios publico asociado*/
	function _load_layout($template)
    {
      $this->load->view('layout/header');
      $this->load->view($template);
      $this->load->view('layout/footer');
    }

}
