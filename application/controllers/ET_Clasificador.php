<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Clasificador extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Clasificador');
	}

	public function index()
    {    
        $opcion="R";
        $ETClasificador=$this->Model_ET_Clasificador->clasificador_Listar($opcion);
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('Front/Ejecucion/ETClasificador/index',['ETClasificador'=>$ETClasificador]);
        $this->load->view('layout/Ejecucion/footer');
    }

    public function BuscarDetalleClasificador()
    {
    	$data=$this->Model_ET_Clasificador->ETListaClasificador($this->input->post('valueSearch'));
		
		foreach ($data as $key => $value)
		{
			$value->num_clasificador=str_replace(' ', '_', $value->num_clasificador);
		}

		echo json_encode($data);exit;
    }

	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start(); 
			$opcion="C";
			$txtNumeroClasi=$this->input->post('txtNumeroClasi');
			$txtDescripcionClasi=$this->input->post('txtDescripcionClasi');
			$txtDetalleClasi=$this->input->post('txtDetalleClasi');
			if(count($this->Model_ET_Clasificador->ValidarDescripcionClasificador($txtDescripcionClasi))>0)
            {
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Datos Duplicados de la Descripción.']);exit;
            }
			$this->Model_ET_Clasificador->insertar($opcion,$txtNumeroClasi,$txtDescripcionClasi,$txtDetalleClasi);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit;
		}

		$this->load->view('Front/Ejecucion/ETClasificador/insertar');
	
	}
	public function editar()
	{
		if($this->input->post('hdIdClasificadro'))
		{	
			$this->db->trans_start(); 
			$opcion="U";
			$hdIdClasificadro=$this->input->post('hdIdClasificadro');
			$txtNumeroClasi=$this->input->post('txtNumeroClasi');
			$txtDescripcionClasi=$this->input->post('txtDescripcionClasi');
			$txtDetalleClasi=$this->input->post('txtDetalleClasi');
			if(count($this->Model_ET_Clasificador->ValidarClasificadorEtapaEditar($hdIdClasificadro,$txtDescripcionClasi))>0)
            {	
            	echo json_encode(['proceso' => 'error', 'mensaje' => 'Este tipo de descripcion ya fue registrado con anterioridad .']);exit;
            }
			$this->Model_ET_Clasificador->editar($opcion,$hdIdClasificadro,$txtNumeroClasi,$txtDescripcionClasi,$txtDetalleClasi);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos Editados Correctamente.', 'txtNumeroClasi' => $txtNumeroClasi]);exit;

		}
		$id_clasificador=$this->input->GET('id_clasificador');
		$ETClasificador=$this->Model_ET_Clasificador->nombreClasificador($id_clasificador);
	    $this->load->view('Front/Ejecucion/ETClasificador/editar',['ETClasificador'=>$ETClasificador]);
	}

	public function eliminar()
	{
		if ($this->input->is_ajax_request()) 
	    {
			$opcion="D";
			$id_clasificador=$this->input->post('id_clasificador');
			if(count($this->Model_ET_Clasificador->VerificarClasificadorAsociado($id_clasificador))>0)
            {	
            	echo json_encode("No es posible eliminar el registro ");
            }
			$this->Model_ET_Clasificador->eliminar($opcion,$id_clasificador);
			echo json_encode($Data);
		}
	}

}