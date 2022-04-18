<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Presupuesto_Analitico extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Presupuesto_Ejecucion');
		$this->load->model('Model_ET_Presupuesto_Analitico');
		$this->load->model('Model_ET_Clasificador');
	}

	public function insertar()
	{
		if($_POST)
		{
			$msg = array();

			$this->db->trans_start();

			$idClasificador=$this->input->post('idClasificador');
			$hd_id_et=$this->input->post('hd_id_et');
			$idPresupuestoEjecucion=$this->input->post('idPresupuestoEjecucion');

			if(count($this->Model_ET_Presupuesto_Analitico->verificarPresupuestoAnaliticoTipoClasi($hd_id_et,$idClasificador,$idPresupuestoEjecucion))>0)
			{
				$this->db->trans_rollback();
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede agregar dos veces el mismo Clasificador con el mismo Tipo.']);exit;
			}

			$c_data['id_clasificador'] = $idClasificador;
            $c_data['id_et'] = $hd_id_et;
            $c_data['id_presupuesto_ej'] = $idPresupuestoEjecucion;

            $idAnalitico = $this->Model_ET_Presupuesto_Analitico->insertar($c_data);

            $verificarClasificador = $this->Model_ET_Clasificador->nombreClasificador($idClasificador);

            $this->db->trans_complete();

            $msg = ($idAnalitico != '' || $idAnalitico != NULL ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idAnalitico' =>$idAnalitico, 'num_clasificador' => $verificarClasificador->num_clasificador,'desc_clasificador'=>$verificarClasificador->desc_clasificador]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;           
		}

		$PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();
		foreach ($PresupuestoEjecucion as $key => $value) 
		{
			$Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
			if(count($Presupuesto)==0)
			{
				$value->NombrePresupuesto=$value->desc_presupuesto_ej;
				$value->IdPresupuesto=$value->id_presupuesto_ej;
			}
			else
			{
				foreach ($Presupuesto as $key => $temp) 
				{
					$value->NombrePresupuesto=$temp->desc_presupuesto_ej;
					$value->IdPresupuesto=$value->id_presupuesto_ej;
				}
			}
		}

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));

		$PresupuestoEjecucionListar=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

		foreach ($PresupuestoEjecucionListar as $key => $value) 
		{
			$Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
			if(count($Presupuesto)==0)
			{
				$value->childPresupuesto=[];
				$value->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($this->input->get('idExpedienteTecnico'),$value->id_presupuesto_ej);
			}
			if(count($Presupuesto)>0)
			{
				$value->childPresupuesto=$Presupuesto;
				foreach ($value->childPresupuesto as $key => $temp) 
				{
					$temp->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($this->input->get('idExpedienteTecnico'),$temp->id_presupuesto_ej);
				}
			}
		}

		$this->load->view('front/Ejecucion/ETPresupuestoAnalitico/insertar.php', ['expedienteTecnico' => $expedienteTecnico,'PresupuestoEjecucionListar' => $PresupuestoEjecucionListar,'PresupuestoEjecucion'=>$PresupuestoEjecucion]);

	}

	public function eliminar()
	{
		if($_POST)
		{
			$this->db->trans_start();

			$idClasiAnalitico=$this->input->post('idClasiAnalitico');
			if(count($this->Model_ET_Presupuesto_Analitico->VerificarAnalisisUnitario($idClasiAnalitico))>0)
			{
				$this->db->trans_rollback();
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede eliminar el Clasificador ya se encuentra asociado en el modulo de  Analisis Unitario']);exit;
			}

			$PresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->eliminar($idClasiAnalitico);

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Presupuesto analítico eliminada correctamente.']);exit;
		}

		$this->load->view('Front/Ejecucion/ETPartida/insertar');
	}

}