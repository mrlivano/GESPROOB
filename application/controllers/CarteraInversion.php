<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarteraInversion extends CI_Controller {

public function __construct()
{
    parent::__construct();
    $this->load->model('Model_CarteraInversion');
    $this->load->helper('file');
}
public function index()
{
	$this->_load_layout('Front/Pmi/frmCarteraInversion');
}

	function AddCartera()
	{
	 	if ($this->input->is_ajax_request())
        {
            $msg = array();
            $nombreArchivo = $_FILES['cartera_resolucion']['name'];

            $c_data['año_apertura_cartera']=$this->input->post("dateAñoAperturaCart")."-01-01";
			$c_data['fecha_inicio_cartera']=$this->input->post("dateFechaIniCart");
			$c_data['fecha_cierre_cartera']=$this->input->post("dateFechaFinCart");
			$c_data['estado_cartera'] = $this->input->post("estadoCartera");
			$c_data['numero_resolucion_cartera']=$this->input->post("txt_NumResolucionCart");
			$query = $this->Model_CarteraInversion->getSameYearCartera($c_data);
			if ($query>0)
			{
				$msg = (['proceso' => 'Error', 'mensaje' => 'El año de apertura ya existe']);
				$this->load->view('front/json/json_view',['datos' => $msg]);
				return;
			}

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if($extension=='png' || $extension=='jpg'|| $extension=='pdf')
                {
                    $config['upload_path'] = './uploads/cartera/';
                    $config['allowed_types'] = '*';
                    //$config['max_width']     = 1024;
				    //$config['max_height']    = 768;
				    $config['file_name'] = 'DOC_';
				    $config['max_size'] = '20048';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('cartera_resolucion'))
                    {
                        $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                        $this->load->view('front/json/json_view',['datos' => $msg]);
                        return;
                    }
                    $c_data['url_resolucion_cartera']= $this->upload->data('file_name');
                    $q2 = $this->Model_CarteraInversion->AddCartera($c_data);
                    $msg=($q2>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Cartera guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
                    $this->load->view('front/json/json_view', ['datos' => $msg]);
                }
                else
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'El tipo de archivo que intentas subir no está permitido.']);
                    $this->load->view('front/json/json_view', ['datos' => $msg]);
                }
            }
            else
            {
            	$c_data['url_resolucion_cartera']= NULL;
                $q1 = $this->Model_CarteraInversion->AddCartera($c_data);
                $msg=($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
                $this->load->view('front/json/json_view', ['datos' => $msg]);
            }
        }
	}

 	function editCartera()
 	{
      	$idCartera = isset($_GET['id_cartera']) ? $_GET['id_cartera'] : null;
	    if ($this->input->is_ajax_request())
	    {
	    	$msg = array();
            $nombreArchivo = $_FILES['cartera_resolucion']['name'];

			$c_data['fecha_inicio_cartera']=$this->input->post("dateFechaIniCart");
			$c_data['fecha_cierre_cartera']=$this->input->post("dateFechaFinCart");
			$c_data['estado_cartera'] = $this->input->post("estadoCartera");
			$c_data['numero_resolucion_cartera']=$this->input->post("txt_NumResolucionCart");

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if($extension=='png' || $extension=='jpg'|| $extension=='pdf')
                {
                    $config['upload_path'] = './uploads/cartera/';
                    $config['allowed_types'] = '*';
				    $config['file_name'] = 'DOC_';
				    $config['max_size'] = '20048';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('cartera_resolucion'))
                    {
                        $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                        $this->load->view('front/json/json_view',['datos' => $msg]);
                        return;
                    }
                    $c_data['url_resolucion_cartera']= $this->upload->data('file_name');
                    $q2 = $this->Model_CarteraInversion->editarCartera($idCartera,$c_data);
                    $msg=($q2>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro editado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));

                    if (file_exists("uploads/cartera/".$this->input->post("documento")))
           			{
					   	unlink("uploads/cartera/".$this->input->post("documento"));
					}
                    $this->load->view('front/json/json_view', ['datos' => $msg]);

                }
                else
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'El tipo de archivo que intentas subir no está permitido.']);
                    $this->load->view('front/json/json_view', ['datos' => $msg]);
                }
            }
            else
            {
            	$c_data['url_resolucion_cartera']= NULL;
                $q1 = $this->Model_CarteraInversion->editarCartera($idCartera,$c_data);
                $msg=($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
                $this->load->view('front/json/json_view', ['datos' => $msg]);
            }
		}
 	}

 	 function editarCartera()
    {
    	if($this->input->get('id_cartera')!=''){
    		$data['arrayCartera']=$this->Model_CarteraInversion->getCartera($this->input->get('id_cartera'))[0];
			$this->load->view('Front/Pmi/Cartera/editar',$data);
    	}
    	else{
    		$this->load->view('front/Pmi/Cartera/editar');
			//$this->load->view('Front/Pmi/itemCartera');
    	}
    }
	//FIN INSERTAR UNA CARTERA DE INVERSION
  function itemCartera(){
    	//$data['id_persona']=$this->input->get('id_persona');
    	if($this->input->get('id_cartera')!=''){
    		$data['arrayCartera']=$this->Model_CarteraInversion->getCartera($this->input->get('id_cartera'))[0];
			$this->load->view('Front/Pmi/itemCartera',$data);
    	}
    	else{
			$this->load->view('Front/Pmi/itemCartera');
    	}

	}

    function GetCarteraFechaCierre($idCartera)
    {
        if ($this->input->is_ajax_request()) 
        {
			echo ($this->Model_CarteraInversion->getCartera($idCartera)[0]->fecha_cierre_cartera);
		}
		else
		{
			show_404();
		}
	}


	function getCarteraAnio($anio)//La variable "$anio" se esté recuperando en la vista "Front/Pmi/frmMProyectoInversion"; por tal motivo, no hay que borrar este parámetro.
	{
		$this->load->view('layout/Pmi/header');
		$this->load->view('Front/Pmi/frmMProyectoInversion', ['anio' => $anio]);
		$this->load->view('layout/Pmi/footer');
        /*if ($this->input->is_ajax_request())
        {
            $datos=$this->Model_CarteraInversion->GetCarteraInversion();
            foreach ($datos as $key => $value)
            {
                $value->fecha_inicio_cartera = date('d/m/Y',strtotime($value->fecha_inicio_cartera));
                $value->fecha_cierre_cartera = date('d/m/Y',strtotime($value->fecha_cierre_cartera));
            }
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }*/
	}

    function GetCarteraInvFechAct()
	{
		if ($this->input->is_ajax_request())
		{
		$datos=$this->Model_CarteraInversion->GetCarteraInvFechAct();
		echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}

	function GetCarteraInversion()
	{
		if ($this->input->is_ajax_request())
		{
			$datos=$this->Model_CarteraInversion->GetCarteraInversion();
			foreach ($datos as $key => $value)
			{
				$value->fecha_inicio_cartera = date('d/m/Y',strtotime($value->fecha_inicio_cartera));
				$value->fecha_cierre_cartera = date('d/m/Y',strtotime($value->fecha_cierre_cartera));
			}
			echo json_encode($datos);
		}
		else
		{
			show_404();
		}

	}
	function GetCarteraAnios(){
		if ($this->input->is_ajax_request())
		{
		  $datos=$this->Model_CarteraInversion->GetCarteraAnios();
		  echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}

    function EliminarCartera() 
    {
        if ($this->input->is_ajax_request()) 
        {
            $msg = array();
            $id_cartera = $this->input->post("id_cartera");
            $data = $this->Model_CarteraInversion->EliminarCartera($id_cartera);
            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'La cartera fue eliminada']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }  
        else 
        {
            show_404();
        }
    }
 	function _load_layout($template)
    {
      $this->load->view('layout/Pmi/header');
      $this->load->view($template);
      $this->load->view('layout/Pmi/footer');
    }

}
