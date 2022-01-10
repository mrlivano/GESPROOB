<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FE_Presupuesto_Inv extends CI_Controller {
	public function __construct(){
      parent::__construct();
      $this->load->model('Model_FE_Presupuesto_Inv');
	}

	public function index($codigo_unico_est_inv)
    {
    	$nombreProyecto=$this->Model_FE_Presupuesto_Inv->nombreProyectoInv($codigo_unico_est_inv)[0];
    	$ListarPresupuesto=$this->Model_FE_Presupuesto_Inv->ListarPresupuesto($codigo_unico_est_inv);

        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/index',['ListarPresupuesto'=>$ListarPresupuesto,'nombreProyectoInv'=>$nombreProyecto]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

	public function insertar()
	{
		if($_POST)
		{
			$codigoUnicoInversion=$this->input->post("codigoUnicoInversion");
			
			$cbx_estudioInversion =$this->input->post("idEstudioInversion");
			$txtSector =$this->input->post("cbx_Sector");
			$txtPliego =$this->input->post("txtPliego");

			$Data=$this->Model_FE_Presupuesto_Inv->insertar($cbx_estudioInversion , $txtSector , $txtPliego);

			$data=$this->Model_FE_Presupuesto_Inv->ultimoIdPresupuestoInv()[0];
			$id_presupuesto_fe =$data->id;
			$id_fuente_finan=$this->input->post("txtDescripcionFuente");
			$hdDescripcionFuente=$this->input->post("hdDescripcionFuente");
			$hdCorrelativoMeta=$this->input->post("hdCorrelativoMeta");
			$hdAnio=$this->input->post("hdAnio");
	    	for ($i=0; $i <count($hdAnio); $i++) { 
	    		$hdDescripcionFuente[$i];
	    		$Data=$this->Model_FE_Presupuesto_Inv->insertarPresupuestoFuente($id_presupuesto_fe,$id_fuente_finan,$hdCorrelativoMeta[$i],$hdAnio[$i]);
	    	}
	    	$this->session->set_flashdata('correcto',"Se registro corectamente el presupuesto");
	    	return redirect("/FE_Presupuesto_Inv/index/".$codigoUnicoInversion.""); 
		}

		$codigo_unico_inv=$this->input->GET('id');
		$nombreProyectoInver=$this->Model_FE_Presupuesto_Inv->nombreProyectoInv($codigo_unico_inv)[0];

		$listarSector=$this->Model_FE_Presupuesto_Inv->listarSector();
		$listarFueteFinanciamiento=$this->Model_FE_Presupuesto_Inv->listarFueteFinanciamiento();
		
	    $this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/insertar',['listarSector' => $listarSector,'listarFueteFinanciamiento' => $listarFueteFinanciamiento,'nombreProyectoInver' => $nombreProyectoInver ]);
	}

	function _load_layout($template)
    {
      $this->load->view('layout/Formulacion_Evaluacion/header');
      $this->load->view($template);
      $this->load->view('layout/Formulacion_Evaluacion/footer');
    }
}