<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_FE extends CI_Controller
{
	public function __construct()
	{
    	parent::__construct();
    	$this->load->model('Model_ModuloFE');
	}

	public function index()
	{
		$ListaModulo=$this->Model_ModuloFE->ListarModulo();
		
		$this->load->view('layout/Formulacion_Evaluacion/header');
		$this->load->view('Front/Formulacion_Evaluacion/ModuloFe/index', ['ListaModuloFE' => $ListaModulo]);
		$this->load->view('layout/Formulacion_Evaluacion/footer');
	}

	public function insertar()
	{
		if($_POST)
		{
			$txtNombre=$this->input->post("txtNombre");

			if(count($this->Model_ModuloFE->ModuloPorNombre($txtNombre))>0)
            {
                $this->session->set_flashdata('error', 'Este módulo ya fue registrado con anterioridad.');
                return redirect('/Modulo_FE');
            }

	    	$Data=$this->Model_ModuloFE->insertar($txtNombre);
	    	if($Data=='1')
	    	{
	    		$this->session->set_flashdata('correcto', 'Se guardo correctamente');
	    		return redirect('/Modulo_FE');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Modulo_FE');
	    	}	
		}

	    return $this->load->view('Front/Formulacion_Evaluacion/ModuloFE/insertar');
	}

	public function editar()
	{
		if($this->input->post('hdId'))
		{
			$id=$this->input->post("hdId");
			$txtNombre=$this->input->post("txtNombre");

			if(count($this->Model_ModuloFE->ModuloPorNombreDifId($id, $txtNombre))>0)
            {
                $this->session->set_flashdata('error', 'Este módulo ya fue registrado con anterioridad.');
                return redirect('/Modulo_FE');
            }

	    	$data=$this->Model_ModuloFE->editar($id,$txtNombre);

	    	if($data=='1')
	    	{
	    		$this->session->set_flashdata('correcto', 'Se modificó correctamente');
	    		return redirect('/Modulo_FE');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Modulo_FE');
	    	}
		}
		else
		{
			$id=$this->input->post('id');
			$Modulo=$this->Model_ModuloFE->EditarModuloFE($id)[0];	    
	    	return $this->load->view('Front/Formulacion_Evaluacion/ModuloFE/editar', ['Modulo' => $Modulo]);
		}			
	}

	public function eliminar()
	{
		$id_modulo=$this->input->post("id_codigo");
		$data=$this->Model_ModuloFE->eliminar($id_modulo);
        echo $data;	
	}

	function _load_layout($template)
    {
		$this->load->view('layout/Formulacion_Evaluacion/header');
		$this->load->view($template);
		$this->load->view('layout/Formulacion_Evaluacion/footer');
    }
}