<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Periodo_Ejecucion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Periodo_Ejecucion');
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_Personal');
		$this->load->model("Cargo_Modal");
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if ($_POST)
			{
				$msg = array();

				$id_et=$this->input->post('hdIdEt');
				$fechaInicio=$this->input->post('txtFechaInicio');
				$fechaFin=$this->input->post('txtFechaFin');

				if($fechaInicio>$fechaFin)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'La Fecha de Inicio no puede ser mayor a la Fecha de Fin']);exit;
				}

				$validar = $this->Model_ET_Periodo_Ejecucion->plazoValidar($id_et,$fechaInicio,$fechaFin);

				if(count($validar))
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'El periodo de fechas ya se encuentra registrado']);exit;
				}

				$config['upload_path'] = './uploads/ResolucionAmpliacion/';
                $config['allowed_types'] = '*';
			    $config['file_name'] = 'DOC_';
			    $config['max_size'] = '20048';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('fileResolucion'))
                {
                    $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                    echo json_encode($msg);exit;
                }

				$this->db->trans_start();

				$u_data['estado']=0;
				$this->Model_ET_Periodo_Ejecucion->editarEstado($u_data,$id_et);

				$c_data['id_et']=$id_et;
				$c_data['fecha_inicio']=$fechaInicio;
				$c_data['fecha_fin']=$fechaFin;
				$c_data['resolucion']=$this->upload->data('file_name');
				$c_data['estado']=1;
				$c_data['numero_resolucion']=$this->input->post('txtNumeroResolucion');
				$c_data['fecha_resolucion']=$this->input->post('txtFechaResolución');
				$c_data['tipo']=$this->input->post('selectTipoPlazo');
				$c_data['responsable']=$this->input->post('ComboResponsableEjecucion');
				$c_data['cargo']=$this->input->post('comboCargoEjecucion');

				$data=$this->Model_ET_Periodo_Ejecucion->insertar($c_data);

				$this->db->trans_complete();

				$msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        		echo json_encode($msg);exit;

			}
			else
			{
				$id_et=$this->input->get('id_et');
				$listarPersona=$this->Model_Personal->listarPersona();
				$listarCargo=$this->Cargo_Modal->getcargo();
				$listaPlazoEjecucion=$this->Model_ET_Periodo_Ejecucion->listaPlazoEjecucion($id_et);
				if(count($listaPlazoEjecucion)==0)
				{
					$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($id_et);
					$fecha=$expedienteTecnico[0]->fecha_fin_et;
				}
				else
				{
					$fecha=$listaPlazoEjecucion[0]->fecha_fin;
				}
				$this->load->view('front/Ejecucion/ExpedienteTecnico/periododeejecucion',['id_et'=>$id_et, 'listaPlazoEjecucion' => $listaPlazoEjecucion, 'fecha'=>$fecha,'listarPersona'=>$listarPersona,'listarCargo' => $listarCargo]);
			}
		}
	}

	public function listarCronogramaEjecucion()
	{
			if ($this->input->is_ajax_request())
			{
					$id_et = $this->input->post("id_et");
					$data  = $this->Model_ET_Periodo_Ejecucion->listaPlazoEjecucion($id_et);
					if($data == false)
					{
							echo json_encode(array('data' => $data));
					}
					else
					{
							echo json_encode(array('data' => $data));
					}
			}
			else
			{
					show_404();
			}
	}

	private function calcularNumeroMeses($fechaInicio,$fechaFin)
	{
		$ts1 = strtotime($fechaInicio);
		$ts2 = strtotime($fechaFin);
		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);
		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);
		$numerodemeses = (($year2 - $year1) * 12) + ($month2 - $month1);
		return $numerodemeses;				
	}

	public function eliminar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start(); 
				
				$idPerReq=$this->input->post('idPerReq');

				$this->Model_ET_Per_Req->eliminar($idPerReq);

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos eliminados correctamente.']);exit;
			}
		}
	}

	function eliminarPeriodoEjecucion()
    {
        $msg = array();
        $data = $this->Model_ET_Periodo_Ejecucion->eliminar($this->input->post("id_periodo"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

}