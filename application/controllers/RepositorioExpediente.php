<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RepositorioExpediente extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        $this->load->model('Model_ET_Expediente_Tecnico');
        $this->load->model('Expediente_Repositorio_Model');
	}

    public function index()
	{
		$listaExpediente=$this->Expediente_Repositorio_Model->listaExpediente();
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteRepositorio/index.php',['listaExpediente'=>$listaExpediente]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function insertar()
	{
       if($_POST)
		{
	       	$this->db->trans_start();
            $c_data['codigo_unico']=$this->input->post('txtCodigoUnico');
			$c_data['nombre_proyecto']=$this->input->post('txtProyecto');
			$c_data['carpeta']=$this->input->post('txtCarpeta');
			$idRepositorio=$this->Expediente_Repositorio_Model->insertar($c_data);
			$this->db->trans_complete();
			if($idRepositorio=="")
			{
				$this->session->set_flashdata('error', 'Ha ocurrido un error inesperado.');					
			}
			else
			{
				$this->session->set_flashdata('correcto', 'Expediente Tecnico registrado correctamente.');			
			}
			return redirect('/RepositorioExpediente/index');
		}
		if($this->input->get('buscar')=="true")
		{
			$codigo_unico_pi=$this->input->get('CodigoUnico');
			$Listarproyectobuscado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoBuscar($codigo_unico_pi);			
			$this->load->view('front/Ejecucion/ExpedienteRepositorio/insertar',['Listarproyectobuscado'=>$Listarproyectobuscado]);
			
		}
	}
}
