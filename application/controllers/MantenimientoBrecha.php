<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MantenimientoBrecha extends CI_Controller {

public function __construct(){
      parent::__construct();
      $this->load->model('Model_Brecha');
	}
	public function index()
	{
		$this->_load_layout('Front/Pmi/frmMantenimientoBrecha');
	}
//----------------MANTENIMIENTO DE LOS DATOS DE BRECHAS---------------------
	/*INSERTAR UNA NUEVA BRECHA*/
	 function AddBrecha()
	 {
	    if ($this->input->is_ajax_request())
	    {
	    $cbxServPubAsoc=$this->input->post("cbxServPubAsoc");
	      $txt_NombreBrecha =$this->input->post("txt_NombreBrecha");
	      $txtArea_DescBrecha =$this->input->post("txtArea_DescBrecha");
	      /*if($this->Model_Brecha->AddBrecha($cbxServPubAsoc,$txt_NombreBrecha,$txtArea_DescBrecha) == true)
	        echo "No se añadio una  Brecha";
	      else
	        echo "Se añadio  una Brecha";
	    }*/
	     $Data=$this->Model_Brecha->AddBrecha($cbxServPubAsoc,$txt_NombreBrecha, $txtArea_DescBrecha);
            echo json_encode($Data);
		}
	    else
	    {
	      show_404();
	    }
 	 }
//FIN INSERTAR UNA NUEVA BRECHA
    /* LISTAR BRECHAS*/
	 function GetBrecha()
	{
		if ($this->input->is_ajax_request())
		{
		$datos=$this->Model_Brecha->GetBrecha();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}
//FIN LISTAR BRECHAS
//ACTUALIZAR O MODIFICAR DATOS DE LAS BRECHAS
 	function UpdateBrecha()
	 {
	    if ($this->input->is_ajax_request())
	    {
		      $txt_IdBrechaModif =$this->input->post("txt_IdBrechaModif");
		      $id_ServPubAsoc=$this->input->post("cbxSerPubAsocModificar");
		      $txt_NombreBrechaU =$this->input->post("txt_NombreBrechaU");
		      $txtArea_DescBrechaU =$this->input->post("txtArea_DescBrechaU");
		      if($this->Model_Brecha->UpdateBrecha($txt_IdBrechaModif,$id_ServPubAsoc,$txt_NombreBrechaU,$txtArea_DescBrechaU) == false)
		        echo "Se actualizo correctamente la brecha";
		      else
		        echo "No Se actualizo correctamente la brecha";
	    }
	    else
	    {
	      	show_404();
	    }
 	 }
//FIN ACTUALIZAR O MODIFICAR DATOS DE LAS BRECHAS

 	 //ELIMINAR BRECHA
 	 function DeleteBrecha()
 	 {
 	 	if($this->input->is_ajax_request())
	    {

	      $id_brecha=$this->input->post("id_brecha");
	     if($this->Model_Brecha->DeleteBrecha($id_brecha)== false)
		       echo "Se elimino la brecha";
		      else
		      echo "No se elimino ella brecha";
		 }
	     else
	     {
	      show_404();
	      }
 	 }
 	 //FIN ELIMINAR BRECHA
 	function _load_layout($template)
    {
      $this->load->view('layout/header');
      $this->load->view($template);
      $this->load->view('layout/footer');
    }

}
