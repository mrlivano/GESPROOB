<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Proyectos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Analisis_Unitario');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_Personal');
		$this->load->model('Model_Persona_Juridica');
		$this->load->model("Model_ET_Tipo_Responsable");
		$this->load->model("Model_ET_Responsable");
		$this->load->model("Cargo_Modal");
		$this->load->model("Model_ET_Presupuesto_Analitico");
		$this->load->model("Model_ET_Img");
		$this->load->model('Model_ET_Etapa_Ejecucion');
		$this->load->model('Model_ET_Presupuesto_Ejecucion');
		$this->load->model('Model_Personal');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Detalle_Analisis_Unitario');
		$this->load->model('Model_ET_Tarea');
		$this->load->model('Model_ET_Mes_Valorizacion');
		$this->load->model('Model_ET_Detalle_Formatos');
		$this->load->model('Model_Unidad_Medida');
		$this->load->model('Model_DetSegOrden');
		$this->load->model('UsuarioProyecto_model');
		$this->load->model('Model_ET_Recurso');
		$this->load->model('Model_ModalidadE');
		$this->load->model('FuenteFinanciamiento_Model');
		$this->load->model('Model_ET_Meta_Analitico');
		$this->load->model('Model_ET_Recurso_Insumo');
		$this->load->model('Model_ET_Periodo_Ejecucion');
		$this->load->model('Model_Dashboard_Reporte');
		$this->load->model('Model_ET_Cronograma_Ejecucion');
		$this->load->model('Model_ET_Pie_Presupuesto');
		$this->load->library('mydompdf');
		$this->load->helper('FormatNumber_helper');
	}

	function _load_layout($template, $data)
	{
		$this->load->view('layout/Ejecucion/header');
		$this->load->view($template, $data);
		$this->load->view('layout/Ejecucion/footer');
	}

	
	public function index()
	{
		$listaProyectos = $this->Model_ET_Expediente_Tecnico->ListarExpedientePorEtapa(3);
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Administracion/frmProyectos.php',['listaEjecucion' => $listaProyectos]);
		$this->load->view('layout/Ejecucion/footer');
	}
	public function fechas()
	{
		if($_GET)
		{
			$idEt = $this->input->get('idExpedienteTecnico');
			$años=$this->listaAños();
			$meses = $this->listaMeses();
			$this->load->view('front/Administracion/popFechas.php',['idEt'=>$idEt, 'años'=>$años, 'mes'=>$meses]);
		}
	}

	private function listaMeses()
    {
        $array = array(
            'Enero'=>'01',
            'Febrero'=>'02',
            'Marzo'=>'03',
            'Abril'=>'04',
            'Mayo'=>'05',
            'Junio'=>'06',
            'Julio'=>'07',
            'Agosto'=>'08',
            'Setiembre'=>'09',
            'Octubre'=>'10',
            'Noviembre'=>'11',
            'Diciembre'=>'12'
        );
        return $array;
    }
	private function listaAños()
    {		
		$array = array();
		for ($i=0; $i < 9 ; $i++) { 
			$array[$i]=2022-$i;
		}
        
        return $array;
    }
}
