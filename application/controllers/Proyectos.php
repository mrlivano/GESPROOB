<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Proyectos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Periodo_Ejecucion');
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
		if($this->input->is_ajax_request())
		{
		if($_POST)
		{
			$this->db->trans_start();
			$id_et = $this->input->post('idExpedienteTecnico');
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($id_et);
			$c_data['id_pi'] = $expedienteTecnico[0]->id_pi;
			$c_data['anio'] = $this->input->post('anio');
			$c_data['mes'] = $this->input->post('mes');
			$c_data['flag'] = 'True';
			$hdMes = $this->input->post('hdMes');
			$this->Model_ET_Periodo_Ejecucion->insertarCierre($c_data);
			$this->db->trans_complete();
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos registrados correctamente.']);exit;
		}
			$idEt = $this->input->get('idExpedienteTecnico');
			$años=$this->listaAños();
			$meses = $this->listaMesesK();
			$listaPlazo=$this->Model_ET_Periodo_Ejecucion->cierrePlazo($idEt);
			$this->load->view('front/Administracion/popFechas.php',['idEt'=>$idEt, 'años'=>$años, 'mes'=>$meses, 'listaPlazo'=>$listaPlazo]);

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

		private function listaMesesK()
    {
        $array = array(
        '01'=>'Enero',
        '02'=>'Febrero',
        '03'=>'Marzo',
        '04'=>'Abril',
       	'05'=>'Mayo',
        '06'=>'Junio',
        '07'=>'Julio',
        '08'=>'Agosto',
        '09'=>'Setiembre',
        '10'=>'Octubre',
        '11'=>'Noviembre',
				'12'=>'Diciembre'
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
