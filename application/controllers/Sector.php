<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Sector');
      $this->load->helper('FormatNumber_helper');
      $this->load->helper('file');

	}

    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function index()
	{
		$this->_load_layout('Front/Administracion/frmSectorEntidad');
	}

	public function ReporteListaSectorPip()
    {
				$id_ue = $this->session->userdata('idUnidadEjecutora');
        $listaNumPipSector=$this->Model_Sector->SectorPipListar($id_ue);
        $listaMontoTotalSector=$this->Model_Sector->SectorPipMontoTotalListar($id_ue);

        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/Sector/index',['listaNumPipSector'=>$listaNumPipSector,'listaMontoTotalSector'=>$listaMontoTotalSector]);
        $this->load->view('layout/Reportes/footer');
    }
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

	    	$config['image_library'] = 'gd2';
	    	$config['upload_path']          = './uploads/IconosSector/';
		    $config['allowed_types'] = 'gif|jpg|png';
	        $config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 75;
			$config['height']       = 50;
	        $this->load->library('upload', $config);
			$this->upload->initialize($config);
	        $this->upload->do_upload('faviconSector');
	        $file_info = $this->upload->data();
            $txt_NombreSector = $this->input->post('txt_NombreSector');
            $imagen = $file_info['file_name'];
            $data=$this->Model_Sector->AddSector($txt_NombreSector,$imagen);
            $data=['Proceso'=>'Correcto','mensaje'=>'Registrado correctamente'];

            echo json_encode($data);
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
		    $config['image_library'] = 'gd2';
	    	$config['upload_path']          = './uploads/IconosSector/';
		    $config['allowed_types'] = 'gif|jpg|png';
	        $config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 75;
			$config['height']       = 50;
	        $this->load->library('upload', $config);

			$this->upload->initialize($config);
	         if (!$this->upload->do_upload('faviconSectorActualizar')) {

	         	  $txt_IdModificar =$this->input->post("txt_IdModificar");
				  $txt_NombreSectorM =$this->input->post("txt_NombreSectorM");

				 if($this->Model_Sector->UpdateSector($txt_IdModificar,$txt_NombreSectorM) == false)
				   echo "Se actualizo correctamente el sector";
				 else
				   echo "Se actualizo correctamente el sector";


     		  } else {

		         $file_info = $this->upload->data();

		         $imagen = $file_info['file_name'];

		         $txt_IdModificar =$this->input->post("txt_IdModificar");

				 $txt_NombreSectorM =$this->input->post("txt_NombreSectorM");


				 if($this->Model_Sector->UpdateSectorTodosCampos($txt_IdModificar,$txt_NombreSectorM,$imagen) == false)
				   echo "Se actualizo correctamente el sector";
				 else
				   echo "Se actualizo correctamente el sector";

     		  }

	    }
	    else
	    {
	      	show_404();
	    }

 	 }


 	function EliminarSector(){

 		if ($this->input->is_ajax_request())
        {
            $id_sector = $this->input->post("id_sector");
            $this->Model_Sector->EliminarSector($id_sector);
            echo "1";

        } else {
            show_404();
        }

 	}
    /*fin sector*/

    function _load_layout($template)
    {
      $this->load->view('layout/ADMINISTRACION/header');
      $this->load->view($template);
      $this->load->view('layout/ADMINISTRACION/footer');
    }



}
