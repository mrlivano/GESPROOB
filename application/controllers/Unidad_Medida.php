<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unidad_Medida extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('table');
        $this->load->model("Model_Unidad_Medida");
    }

    public function index()
    {
        $listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view('front/Administracion/UnidadMedida/index', ['listaUnidadMedida' => $listaUnidadMedida]);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

    public function insertar()
    {
    	if($_POST)
    	{
    		$txtDescripcion=$this->input->post('txtDescripcion');
            $txtAbreviatura=$this->input->post('txtAbreviatura');

            if(count($this->Model_Unidad_Medida->UnidadMedidaPorDescripcion($txtDescripcion))>0)
            {
                $this->session->set_flashdata('error', 'Esta unidad de medida ya fue registrado con anterioridad.');
                return redirect('/Unidad_Medida');
            }

            $data = $this->Model_Unidad_Medida->insertar($txtDescripcion, $txtAbreviatura);
            if($data=='1')
            {
                $this->session->set_flashdata('correcto', 'Unidad de medida registrado correctamente.');
                return redirect('/Unidad_Medida');
            }
            else
            {
                $this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Unidad_Medida');
            }    		
    	}
        return $this->load->view('front/Administracion/UnidadMedida/insertar');
    }

    public function editar()
    {
    	if($this->input->post('hdId'))
    	{
			$id=$this->input->post('hdId');

			$txtDescripcion=$this->input->post('txtDescripcion');
            $txtAbreviatura=$this->input->post('txtAbreviatura');

            if(count($this->Model_Unidad_Medida->UnidadMedidaPorDescripcionDiffId($id, $txtDescripcion))>0)
            {
                $this->session->set_flashdata('error', 'Esta unidad de medida ya fue registrado con anterioridad.');

                return redirect('/Unidad_Medida');
            }

			$data = $this->Model_Unidad_Medida->editar($id, $txtDescripcion, $txtAbreviatura);

            if($data=='1')
            {
                $this->session->set_flashdata('correcto', 'Datos guardados correctamente.');
                return redirect('/Unidad_Medida');
            }
            else
            {
                $this->session->set_flashdata('error', 'Usted no tiene permisos para realizar esta acción');
                return redirect('/Unidad_Medida');
            }    		
    	}

		$id=$this->input->post('id');

		$unidadMedida=$this->Model_Unidad_Medida->UnidadMedida($id)[0];

        return $this->load->view('front/Administracion/UnidadMedida/editar', ['unidadMedida' => $unidadMedida]);
    }
    public function listaUnidadMedida()
    {
        $data=$this->Model_Unidad_Medida->ETListaUnidadPorDescripcion($this->input->post('valueSearch'));
        echo json_encode($data);exit;
    }

    public function eliminar()
    {
        $id_tipog=$this->input->post("id_codigo");

        $data = $this->Model_Unidad_Medida->eliminar($id_tipog);
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


}
