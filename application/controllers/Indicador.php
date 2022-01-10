<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicador extends CI_Controller {

public function __construct(){
      parent::__construct();
      $this->load->model('Model_Indicador');
	}
	

 //----------------MANTENIMIENTO DE LOS DATOS DE INDICADOR---------------------

/*INSERTAR UN INDICADOR*/
	 function AddIndicador()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
	      $txt_NombreIndicador =$this->input->post("txt_NombreIndicador");
	      $txtArea_DefIndicador =$this->input->post("txtArea_DefIndicador");
	      $txt_UnidadMedida =$this->input->post("txt_UnidadMedida");
	     
	     $data=$this->Model_Indicador->AddIndicador($txt_NombreIndicador,$txtArea_DefIndicador,$txt_UnidadMedida);
	     echo json_encode($data);
	 
	    }
	    else
	    {
	      show_404();
	    }

 	 }
 /*FIN INSERTAR UN INDICADOR*/

  /* LISTAR INDICADOR*/
	 function GetIndicador()
	{
		if ($this->input->is_ajax_request()) 
		{
		$datos=$this->Model_Indicador->GetIndicador();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}
//FIN LISTAR INDICADOR
//ACTUALIZAR O MODIFICAR DATOS DE UN INDICADOR
 	function UpdateIndicador()
	 {
	    if ($this->input->is_ajax_request()) 
	    {
		      $txt_IdIndicadorModif =$this->input->post("txt_IdIndicadorModif");
		      $txt_NombreIndicadorU =$this->input->post("txt_NombreIndicadorU");
		      $txtArea_DefIndicadorU =$this->input->post("txtArea_DefIndicadorU");
		      $txt_UnidadMedidaU =$this->input->post("txt_UnidadMedidaU");
		      if($this->Model_Indicador->UpdateIndicador($txt_IdIndicadorModif,$txt_NombreIndicadorU,$txtArea_DefIndicadorU,$txt_UnidadMedidaU) == false)
		        echo "Se actualizo correctamente el indicador";
		      else
		        echo "No Se actualizo correctamente el indicador"; 
	    }
	    else
	    {
	      	show_404();
	    }
 	 }
//FIN ACTUALIZAR O MODIFICAR DATOS DEL INDICADOR

 	 //ELIMINAR INDICADOR
 	 function DeleteIndicador()
 	 {
 	 	if($this->input->is_ajax_request()) 
	    {

	      $id_indicador=$this->input->post("id_indicador");
	     if($this->Model_Indicador->DeleteIndicador($id_indicador)== false)
		       echo "Se elimino Indicador";
		      else
		      echo "No se elimino indicador"; 
		 } 
	     else
	     {
	      show_404();
	      }
 	 }
 	 //FIN ELIMINAR INDICADOR
//----------------FIN MANTENIMIENTO DE LOS DATOS DE INDICADOR-------------------

	function _load_layout($template)
    {
      $this->load->view('layout/header');
      $this->load->view($template);
      $this->load->view('layout/footer');
    }

}
