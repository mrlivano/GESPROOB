<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_Gasto_FE extends CI_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	$this->load->model('Model_TipoGastoFE');
	}

	public function index()
	{
		$ListaTipoGastoFE=$this->Model_TipoGastoFE->ListarTipoGastoFE();
		
		$this->load->view('layout/Formulacion_Evaluacion/header');
		$this->load->view('Front/PresupuestoEstudioInversion/TipoGastoFE/index', ['ListaTipoGastoFE' => $ListaTipoGastoFE]);
		$this->load->view('layout/Formulacion_Evaluacion/footer');
	}

	public function insertar()
	{
		if($_POST)
		{
			$txtDescripcion=$this->input->post("txtDescripcion");

			if(count($this->Model_TipoGastoFE->TipoGastoFEPorDescripcion($txtDescripcion))>0)
            {
                $this->session->set_flashdata('error', 'Este tipo de gasto ya fue registrado con anterioridad.');
                return redirect('/Tipo_Gasto_FE');
            }

	    	$Data=$this->Model_TipoGastoFE->insertar($txtDescripcion);
	    	if($Data=='1')
	    	{
	    		$this->session->set_flashdata('correcto', 'Se registró correctamente');
	    		return redirect('/Tipo_Gasto_FE');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Tipo_Gasto_FE');
	    	}			
		}
	    return $this->load->view('Front/PresupuestoEstudioInversion/TipoGastoFE/insertar');
	}

	public function editar()
	{
		if($this->input->post('hdId'))
		{
			$id=$this->input->post("hdId");
			$txtDescripcion=$this->input->post("txtDescripcion");

			if(count($this->Model_TipoGastoFE->TipoGastoFEPorDescripcionDiffId($id, $txtDescripcion))>0)
            {
                $this->session->set_flashdata('error', 'Este tipo de gasto ya fue registrado con anterioridad.');

                return redirect('/Tipo_Gasto_FE');
            }

	    	$Data=$this->Model_TipoGastoFE->editar($id,$txtDescripcion);

	    	if($Data=='1')
	    	{
	    		$this->session->set_flashdata('correcto', 'Se modificó correctamente');
	    		return redirect('/Tipo_Gasto_FE');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Tipo_Gasto_FE');
	    	}
		}

		$id=$this->input->post('id');

		$TipoGastoFE=$this->Model_TipoGastoFE->TipoGastoFE($id)[0];
	    
	    return $this->load->view('Front/PresupuestoEstudioInversion/TipoGastoFE/editar', ['TipoGastoFE' => $TipoGastoFE]);		
	}
	public function eliminar()
	{
        $id_tipog=$this->input->post("id_codigo");

		$data = $this->Model_TipoGastoFE->eliminar($id_tipog);
		/*
		if($data>0)
		{
			$this->session->set_flashdata('correcto', 'Se eliminó correctamente el registro');
			redirect('Tipo_Gasto_FE/index');
		}
		$this->session->set_flashdata('error', 'Ha ocurrido un error inesperado');
		redirect('Tipo_Gasto_FE/index');
		*/
        echo $data;


	}

	function _load_layout($template)
    {
		$this->load->view('layout/Formulacion_Evaluacion/header');
		$this->load->view($template);
		$this->load->view('layout/Formulacion_Evaluacion/footer');
    }
}