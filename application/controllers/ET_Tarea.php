<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Tarea extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Tarea_Gantt');
		$this->load->model('Model_ET_Tarea');
		$this->load->model('Model_ET_Tarea_Observacion');
		$this->load->model('Model_ET_Responsable_Tarea');
		$this->load->model('Model_ET_Documento_Ejecucion');
		$this->load->model('Model_Personal');
		$this->load->model('Model_Especialidad');
		$this->load->model('Model_ET_Especialista_Tarea');
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('UsuarioProyecto_model');
		$this->load->model('Model_ET_Comentario');
		$this->load->model('Model_ET_Observacion_Tarea');
		$this->load->model('Model_ET_Levantamiento_Obs');
		$this->load->model('Model_ProyectoInversion');
	}

	private function number_of_working_days($from, $to)
	{
		$workingDays=[1, 2, 3, 4, 5]; # date format=N (1=Monday, ...)
		$holidayDays=['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

		$from=new DateTime($from);

		$to=new DateTime($to);
		$to->modify('+1 day');

		$interval=new DateInterval('P1D');
		$periods=new DatePeriod($from, $interval, $to);

		$days=0;

		foreach($periods as $period)
		{
			if(!in_array($period->format('N'), $workingDays)) continue;
			if(in_array($period->format('Y-m-d'), $holidayDays)) continue;
			if(in_array($period->format('*-m-d'), $holidayDays)) continue;

			$days++;
		}

		return $days;
	}

	public function index()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$ExpedienteAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idExpedienteTecnico);
		$idPI = $ExpedienteAprobado[0]->id_pi;
		$proyectoInversionET = $this->Model_ProyectoInversion->getProyectoInversionByET($idPI);
		$proyectoInversionET = $proyectoInversionET[0]->codigo_unico_pi;
		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($ExpedienteAprobado[0]->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/index');
			}
        }

		$this->db->trans_start();

		$listaETTareaGantt=$this->Model_ET_Tarea_Gantt->ETTareaGanttPorIdET($idExpedienteTecnico);

		if(count($listaETTareaGantt)==0)
		{
			$this->Model_ET_Tarea_Gantt->insertar($idExpedienteTecnico, 0);

			$listaETTareaGantt=$this->Model_ET_Tarea_Gantt->ETTareaGanttPorIdET($idExpedienteTecnico);
		}

		$idTareaGantt=$listaETTareaGantt[0]->id_tarea_gantt;

		$listaETTarea=$this->Model_ET_Tarea->ETTareaPorIdTareaGantt($idTareaGantt);

		$arrayTask=[];

		if(count($listaETTarea)==0)
		{
			$arrayTask[0]=[
				"id" => "9999",
				"name" =>  "Proyecto: ".$proyectoInversionET,
				//"quantityComment" => 0,
				//"quantityObservation" => 0,
				"observationPending" => false,
				"progress" => 0,
				"progressByWorklog" => false,
				"relevance" => 0,
				"type" => "",
				"typeId" => "",
				"description" => "",
				"code" => "",
				"level" => 0,
				"status" => "STATUS_ACTIVE",
				"depends" => "",
				"canWrite" => true,
				"start" =>  1524610800000,
				"duration" => 1,
				"end" =>  1524610800000,
				"startIsMilestone" => false,
				"endIsMilestone" => false,
				"assigs" => [],
				//"personaAsignada" => "",
				"hasChild" => true
			];
		}

		foreach($listaETTarea as $key => $value)
		{
			$ts1=strtotime($value->fecha_inicio_tarea);
			$ts2=strtotime($value->fecha_final_tarea);

			$seconds_diff=$ts2-$ts1;

			$value->childETEspecialidadTarea=$this->Model_ET_Especialista_Tarea->EspecialistaTareaPorIdTarea($value->id_tarea_et);
			$value->countETComentario=count($this->Model_ET_Comentario->ETComentarioPorIdTareaET($value->id_tarea_et));

			$listaETObservacionTareaTemp=$this->Model_ET_Observacion_Tarea->ETObservacionTareaPorIdTareaET($value->id_tarea_et);

			$value->countETObservacionTarea=count($listaETObservacionTareaTemp);

			$value->observationPending=false;

			foreach($listaETObservacionTareaTemp as $index => $item)
			{
				$value->observationPending=(count($this->Model_ET_Levantamiento_Obs->ETLevantamientoObsPorIdObservacionTarea($item->id_observacion_tarea))==0 ? true : false);

				if($value->observationPending)
				{
					break;
				}
			}

			$personaAsignadaTemp='';
			$ultimaEspecialidadTemp=null;

			foreach($value->childETEspecialidadTarea as $index => $item)
			{
				if($item->nombres!=null)
				{
					if($ultimaEspecialidadTemp!=$item->nombre_esp)
					{
						$ultimaEspecialidadTemp=$item->nombre_esp;

						$personaAsignadaTemp.='<b>'.$item->nombre_esp.':</b> '.$item->nombres.' '.$item->apellido_p.' '.$item->apellido_m.', ';
					}
					else
					{
						$personaAsignadaTemp.=$item->nombres.' '.$item->apellido_p.' '.$item->apellido_m.', ';
					}
				}
			}

			$personaAsignadaTemp=strlen($personaAsignadaTemp)>0 ? substr($personaAsignadaTemp, 0, -2) : '';

			$arrayTask[]=[
				'id' => $value->id_tarea_et,
				'name' => html_escape($value->nombre_tarea),
				'quantityComment' => $value->countETComentario,
				'quantityObservation' => $value->countETObservacionTarea,
				'observationPending' => $value->observationPending,
				'progress' => $value->avance_tarea,
				'progressByWorklog' => false,
				'relevance' => 0,
				'type' => '',
				'typeId' => '',
				'description' => '',
				'code' => $value->id_tarea_et,
				'level' => $value->nivel_tarea,
				'status' => $value->color_tarea,
				'depends' => $value->dependencia_tarea,
				'canWrite' => true,
				'start' => (strtotime($value->fecha_inicio_tarea)*1000),
				'duration' => $this->number_of_working_days($value->fecha_inicio_tarea, $value->fecha_final_tarea),
				'end' => (strtotime($value->fecha_final_tarea)*1000),
				'startIsMilestone' => false,
				'endIsMilestone' => false,
				'assigs' => [],
				'personaAsignada' => $personaAsignadaTemp,
				'hasChild' => (count($listaETTarea)-1!=$key ? ($listaETTarea[$key+1]->nivel_tarea>$value->nivel_tarea ? true : false) : false)
			];
		}

		$this->db->trans_complete();

		return $this->load->view('Front/Ejecucion/ETTarea/index', ['arrayTask' => json_encode($arrayTask), 'listaETTarea' => $listaETTarea, 'idTareaGantt' => $idTareaGantt, 'idExpedienteTecnico' => $idExpedienteTecnico ]);
	}

	public function insertarBloque()
	{
		if($this->input->is_ajax_request())
		{
			$this->db->trans_start();

			$idTareaGantt=$this->input->post('idTareaGantt');
			$idET=$this->input->post('idExpedienteTecnico');

			$ETAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idET);
			if ($ETAprobado[0]->aprobado==1)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'Este Expediente Tecnico ya fue aprobado, por lo tanto no puede ser modificado']);exit;
			}

			$tareas=json_decode($this->input->post('tareas'));

			$idsTemp='';

			foreach($tareas as $key => $value)
			{
				if(trim($value->code)!='')
				{
					$idsTemp.=','.$value->code;
				}
			}

			$idsTemp=$idsTemp!='' ? substr($idsTemp, 1) : null;

			$listaETTareaTemp=null;

			if($idsTemp!=null)
			{
				$listaETTareaTemp=$this->Model_ET_Tarea->ETTareaPorIdTareaGanttYNoIds($idTareaGantt, $idsTemp);

				foreach($listaETTareaTemp as $key => $value)
				{
					$listaETDocumentoEjecucionTemp=$this->Model_ET_Documento_Ejecucion->ETDocumentoEjecucionPorIdTareaET($value->id_tarea_et);

					foreach($listaETDocumentoEjecucionTemp as $index => $item)
					{
						$rutaArchivoTemp='./uploads/DocumentoTareaGanttET/'.$item->id_doc_ejecucion.'.'.$item->extension_doc_ejecucion;

						if(file_exists($rutaArchivoTemp))
						{
							unlink($rutaArchivoTemp);
						}
					}
				}

				$this->Model_ET_Tarea->eliminarParaActualizar($idTareaGantt, $idsTemp);
			}
			else
			{
				$listaETTareaTemp=$this->Model_ET_Tarea->ETTareaPorIdTareaGantt($idTareaGantt);

				foreach($listaETTareaTemp as $key => $value)
				{
					$listaETDocumentoEjecucionTemp=$this->Model_ET_Documento_Ejecucion->ETDocumentoEjecucionPorIdTareaET($value->id_tarea_et);

					foreach($listaETDocumentoEjecucionTemp as $index => $item)
					{
						$rutaArchivoTemp='./uploads/DocumentoTareaGanttET/'.$item->id_doc_ejecucion.'.'.$item->extension_doc_ejecucion;

						if(file_exists($rutaArchivoTemp))
						{
							unlink($rutaArchivoTemp);
						}
					}
				}

				$this->Model_ET_Tarea->eliminarETTareaPorIdTareaGantt($idTareaGantt);
			}

			foreach($tareas as $key => $value)
			{
				$predecesoraTarea='NULL';

				$value->start=date("Y-m-d H:i:s", ($value->start/1000));
				$value->end=date('Y-m-d', strtotime('-1 day', strtotime(date("Y-m-d H:i:s", ($value->end/1000)))));

				if($value->level!=0)
				{
					$countTemp=0;

					for($i=$key; $i>=0; $i--)
					{
						if($tareas[$i]->level!=$value->level && $tareas[$i]->level<$value->level)
						{
							$predecesoraTarea=$key-$countTemp+1;

							break;
						}

						$countTemp++;
					}
				}

				if(trim($value->name)=='')
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Debe asignar nombre a todas las actividades creadas.']);exit;
				}

				if(trim($value->code)!='')
				{
					$this->Model_ET_Tarea->editar($value->code, ($predecesoraTarea!='NULL' ? $this->Model_ET_Tarea->ETTareaPorIdTareaGanttYNumeracion($idTareaGantt, $predecesoraTarea)->id_tarea_et : $predecesoraTarea), '', $value->name, $value->start, $value->end, 0, $value->progress, $value->status, $value->level, $predecesoraTarea, 0, ($key+1), (($value->depends>count($tareas) || $value->depends==($key+1)) ? '' : $value->depends));
				}
				else
				{
					$this->Model_ET_Tarea->insertar($idTareaGantt, ($predecesoraTarea!='NULL' ? $this->Model_ET_Tarea->ETTareaPorIdTareaGanttYNumeracion($idTareaGantt, $predecesoraTarea)->id_tarea_et : $predecesoraTarea), '', $value->name, $value->start, $value->end, 0, $value->progress, $value->status, $value->level, $predecesoraTarea, 0, ($key+1), (($value->depends>count($tareas) || $value->depends==($key+1)) ? '' : $value->depends));
				}
			}

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Actividades guardadas correctamente.']);exit;
		}
	}

	public function administrarDetalleETTarea()
	{
		$idTareaET=$this->input->post('idTareaET');

		$etTarea=$this->Model_ET_Tarea->ETTareaPorIdTareaET($idTareaET);

		$listaPersona=$this->Model_Personal->verTodo();

		$listaETTareaObservacion=$this->Model_ET_Tarea_Observacion->ETTareaObservacionPorIdTareaET($idTareaET);
		$listaETResponsableTarea=$this->Model_ET_Responsable_Tarea->ETResponsableTareaPorIdTareaET($idTareaET);
		$listaETDocumentoEjecucion=$this->Model_ET_Documento_Ejecucion->ETDocumentoEjecucionPorIdTareaET($idTareaET);
		$listaEspecialidad=$this->Model_Especialidad->ListarEspecialidad();
		$listaEspecialidadTarea=$this->Model_ET_Especialista_Tarea->EspecialidadTareaPorIdTarea($idTareaET);

		return $this->load->view('Front/Ejecucion/ETTarea/administrardetalleettarea', ['listaETTareaObservacion' => $listaETTareaObservacion, 'listaETResponsableTarea' => $listaETResponsableTarea, 'listaETDocumentoEjecucion' => $listaETDocumentoEjecucion, 'etTarea' => $etTarea, 'listaPersona' => $listaPersona, 'listaEspecialidad' => $listaEspecialidad, 'listaEspecialidadTarea' => $listaEspecialidadTarea]);
	}
}
?>
