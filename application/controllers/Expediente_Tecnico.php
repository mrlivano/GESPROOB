<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Expediente_Tecnico extends CI_Controller
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
		$this->load->library('mydompdf');
		$this->load->helper('FormatNumber_helper');
	}

	function _load_layout($template, $data)
	{
		$this->load->view('layout/Ejecucion/header');
		$this->load->view($template, $data);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function reportePdfExpedienteTecnico()
	{
		$id_ExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$responsableElaboracion=$this->Model_Personal->ResponsableExpediente($id_ExpedienteTecnico,'001');

		$responsableEjecucion=$this->Model_Personal->ResponsableExpediente($id_ExpedienteTecnico,'002');

		$Opcion="ReporteFichaTecnica01";

		$ImagenesExpediente=$this->Model_ET_Expediente_Tecnico->ET_Img($id_ExpedienteTecnico);
		$listarComponentes=$this->Model_ET_Expediente_Tecnico->listarComponentes($id_ExpedienteTecnico);
		$listarComponentesAD=$this->Model_ET_Expediente_Tecnico->listarComponentesAD($id_ExpedienteTecnico);
		$listarComponentesAI=$this->Model_ET_Expediente_Tecnico->listarComponentesAI($id_ExpedienteTecnico);
		$listarResponsables=$this->Model_ET_Expediente_Tecnico->listarResponsables($id_ExpedienteTecnico);
		$listarExpedienteFicha001=$this->Model_ET_Expediente_Tecnico->reporteExpedienteFicha001($Opcion,$id_ExpedienteTecnico);

		$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reporteExpedienteTecnico',["listarExpedienteFicha001" => $listarExpedienteFicha001, "ImagenesExpediente" =>$ImagenesExpediente,"responsableElaboracion" => $responsableElaboracion,"responsableEjecucion" => $responsableEjecucion,"listarComponentes" => $listarComponentes,"listarComponentesAD" => $listarComponentesAD,"listarComponentesAI" => $listarComponentesAI,"listarResponsables" => $listarResponsables],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "portrait");
		$this->mydompdf->render();
		$this->mydompdf->stream("FormatoFF-01.pdf", array("Attachment" => false));


	}

	public function importadorS10()
	{
		$lista = $this->db->query("select * from BD_S10");
         $result = $lista->result();
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/importadorS10.php',['listaBD'=>$result]);
		$this->load->view('layout/Ejecucion/footer');
	}
	public function index()
	{
		$listaExpedienteTecnicoElaboracion=$this->Model_ET_Expediente_Tecnico->ExpedienteListarElaboracion('LISTARETAPA',1);

		$listaExpedientesAprobados=$this->Model_ET_Expediente_Tecnico->ListaExpedienteAprobado(1);

		$listaETExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ListarExpedienteTecnico();

		foreach($listaETExpedienteTecnico as $key => $value)
		{
			$value->primeraETTarea=$this->Model_ET_Tarea->primeraETTareaPorIdET($value->id_et);
			$value->ultimaETTarea=$this->Model_ET_Tarea->ultimaETTareaPorIdET($value->id_et);

			//echo "ETAPA::".$value->primeraETTarea;
			
			
			$value->existeGantt=false;

			if($value->primeraETTarea!=null)
			{
				$value->existeGantt=true;
			}
		}
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/index.php',['listaExpedienteTecnicoElaboracion'=>$listaExpedienteTecnicoElaboracion,'listaETExpedienteTecnico'=>$listaETExpedienteTecnico,'listaExpedientesAprobados'=>$listaExpedientesAprobados]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function MemoriaDescriptiva()
	{
		if($_POST)
		{
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($this->input->post("hdIdExpedienteTecnico"));

			$this->db->trans_start();

			if (file_exists("uploads/MemoriaDescriptiva/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_memoria_descriptiva))
			{
				unlink("uploads/MemoriaDescriptiva/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_memoria_descriptiva);
			}

			$config['upload_path'] = './uploads/MemoriaDescriptiva/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $this->input->post('hdIdExpedienteTecnico');
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('fileMemoriaDescriptiva'))
			{
				$c_data['url_memoria_descriptiva']= $this->upload->data('file_ext');
				$data = $this->Model_ET_Expediente_Tecnico->PeriodoEjecucion($this->input->post('hdIdExpedienteTecnico'),$c_data);
				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Memoria Descriptiva guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			}
			else
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
			}
			$this->db->trans_complete();
			echo json_encode($msg);exit;
		}
		else
		{
			$idExpedienteTecnico=$this->input->get('id_et');
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
			return $this->load->view('front/Ejecucion/ExpedienteTecnico/memoriadescriptiva',['expedienteTecnico'=>$expedienteTecnico]);
		}		
	}

	public function ImpactoAmbiental()
	{
		if($_POST)
		{
			$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($this->input->post("hdIdExpedienteTecnico"));
			if (file_exists("uploads/ImpactoAmbiental/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_impacto_ambiental))
			{
				unlink("uploads/ImpactoAmbiental/".$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_impacto_ambiental);
			}

			$nombreArchivo = $_FILES['fileResolucion']['name'];
			if($nombreArchivo != '' || $nombreArchivo != null)
            {
				if (file_exists("uploads/ImpactoAmbiental/".'CR'.$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_categoria_impacto))
				{
					unlink("uploads/ImpactoAmbiental/".'CR'.$this->input->post("hdIdExpedienteTecnico").$expedienteTecnico[0]->url_categoria_impacto);
				}
			}

			$this->db->trans_start();

			$formato['upload_path'] = './uploads/ImpactoAmbiental/';
			$formato['allowed_types'] = 'pdf|doc|docx';
			$formato['file_name'] = $this->input->post('hdIdExpedienteTecnico');
			$this->load->library('upload', $formato);
			$this->upload->initialize($formato);
			if ($this->upload->do_upload('fileImpactoAmbiental'))
			{
				$c_data['url_impacto_ambiental']= $this->upload->data('file_ext');
			}

			if($nombreArchivo != '' || $nombreArchivo != null)
			{
				$resol['upload_path'] = './uploads/ImpactoAmbiental/';
				$resol['allowed_types'] = 'pdf|doc|docx';
				$resol['file_name'] = 'CR'.$this->input->post('hdIdExpedienteTecnico');
				$this->load->library('upload', $resol);
				$this->upload->initialize($resol);
				if ($this->upload->do_upload('fileResolucion'))
				{
					$c_data['url_categoria_impacto']= $this->upload->data('file_ext');
				}
			}

			$data = $this->Model_ET_Expediente_Tecnico->PeriodoEjecucion($this->input->post('hdIdExpedienteTecnico'),$c_data);
			$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Evaluación de Impacto Ambiental guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			$this->db->trans_complete();
			echo json_encode($msg);exit;
		}
		$idExpedienteTecnico=$this->input->get('id_et');
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
		$this->load->view('front/Ejecucion/ExpedienteTecnico/impactoAmbiental',['expedienteTecnico'=>$expedienteTecnico]);
	}

	public function reporteS10($codigo='')
	{
		$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
		$result = [];
		$lista_ue = $this->db->query("select * from BD_S10");
        if($lista_ue->num_rows()>0){
            $result = $lista_ue->result();
        }
		$this->_load_layout('front/Ejecucion/ExpedienteTecnico/reporteS10.php', ['listaBds10' => $result,'codigo' => $codigo]);

	}
	public function monitorCoordinador()
	{
		$listaETExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteListarElaboracion('LISTARETAPA',1);

		foreach($listaETExpedienteTecnico as $key => $value)
		{
			$value->primeraETTarea=$this->Model_ET_Tarea->primeraETTareaPorIdET($value->id_et);
			$value->ultimaETTarea=$this->Model_ET_Tarea->ultimaETTareaPorIdET($value->id_et);

			$value->existeGantt=false;

			if($value->primeraETTarea!=null)
			{
				$value->existeGantt=true;
			}
		}
		$this->_load_layout('front/Ejecucion/ExpedienteTecnico/monitorcoordinador.php', ['listaETExpedienteTecnico' => $listaETExpedienteTecnico]);

	}

	public function ejecucion()
	{
		$listaEjecucion = $this->Model_ET_Expediente_Tecnico->ListarExpedientePorEtapa(3);
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/ejecucion.php',['listaEjecucion' => $listaEjecucion]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function insertar()
	{
       if($_POST)
		{
	       	$this->db->trans_start();

			$Etapa_Ejecucion='Elaboración de expediente técnico';

			$nombreEtapa=$this->Model_ET_Etapa_Ejecucion->BuscarNombreEtapaEjecucion($Etapa_Ejecucion);

			$id_etapa_et=$nombreEtapa->id_etapa_et;

            $c_data['id_pi']=$this->input->post('txtIdPi');
			$c_data['nombre_ue']=$this->input->post('txtNombreUe');
			$c_data['direccion_ue']=$this->input->post('txtDireccion');
			$c_data['distrito_provincia_departamento_ue']=$this->input->post('txtDPR');
			$c_data['telefono_ue']=$this->input->post('txtTelefono');
			$c_data['ruc_ue']=$this->input->post('txtRUC');
			$c_data['num_beneficiarios_indirectos']=$this->input->post('txtNumBeneficiarios');
			$c_data['costo_total_preinv_et']=$this->input->post('txtMontoInv');
			$c_data['costo_total_inv_et']=$this->input->post('txtCostoEstudio');
			$c_data['funcion_programatica']=$this->input->post('txtFuncion')."/".$this->input->post('txtPrograma')."/".$this->input->post('txtSubPrograma');
			$c_data['funcion_et']=$this->input->post('txtFuncion');
			$c_data['programa_et']=$this->input->post('txtPrograma');
			$c_data['sub_programa_et']=$this->input->post('txtSubPrograma');
			$c_data['proyecto_et']=$this->input->post('txtProyecto');
			$c_data['id_etapa_et']=$id_etapa_et;

			$idExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->insertar($c_data);

			$this->db->trans_complete();

			if($idExpedienteTecnico!='')
			{
				$this->session->set_flashdata('correcto', 'Expediente Tecnico registrado correctamente.');
				return redirect('/Expediente_Tecnico/verdetalle?id_et='.$idExpedienteTecnico);
			}
			else
			{
				$this->session->set_flashdata('error', 'Ha ocurrido un error inesperado.');
				return redirect('/Expediente_Tecnico/index');
			}
		}
		if($this->input->get('buscar')=="true")
		{
			$codigo_unico_pi=$this->input->get('CodigoUnico');
			$Listarproyectobuscado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoBuscar($codigo_unico_pi);
			$this->load->view('front/Ejecucion/ExpedienteTecnico/insertar',['Listarproyectobuscado'=>$Listarproyectobuscado]);
		}
	}

	function editar()
	{
		if($this->input->post('hdIdExpediente'))
		{
			$this->db->trans_start();

			$url=(string)$this->input->post('Editurl');

			$flag=0;

			$hdIdExpediente=$this->input->post('hdIdExpediente');

			if($url!='')
			{
				if (file_exists("uploads/ResolucioExpediente/".$hdIdExpediente.'.docx'))
       			{
				   	unlink("uploads/ResolucioExpediente/".$hdIdExpediente.'.docx');
				}
				if (file_exists("uploads/ResolucioExpediente/".$hdIdExpediente.'.pdf'))
       			{
				   	unlink("uploads/ResolucioExpediente/".$hdIdExpediente.'.pdf');
				}
			}

			$config['upload_path']   = './uploads/ResolucioExpediente/';
	        $config['allowed_types'] = 'pdf|docx';
	        $config['max_size']      = 500000;
	        $config['encrypt_name']  = false;
	        $config['file_name']	 = $hdIdExpediente;
	        $this->load->library('upload', $config);
            $this->upload->do_upload('Documento_Resolucion');

			$c_data['nombre_ue']=$this->input->post('txtNombreUe');
			$c_data['direccion_ue']=$this->input->post('txtDireccionUE');
			$c_data['distrito_provincia_departamento_ue']=$this->input->post('txtUbicacionUE');
			$c_data['telefono_ue']=$this->input->post('txtTelefonoUE');
			$c_data['ruc_ue']=$this->input->post('txtRucUE');
			$c_data['costo_total_preinv_et']=floatval(str_replace(",","",$this->input->post('txtCostoTotalPreInversion')));
			$c_data['costo_directo_preinv_et']=floatval(str_replace(",","",$this->input->post('txtCostoDirectoPre')));
			$c_data['costo_indirecto_preinv_et']=floatval(str_replace(",","",$this->input->post('txtCostoIndirectoPre')));
			$c_data['costo_total_inv_et']=floatval(str_replace(",","",$this->input->post('txtCostoTotalInversion')));
			$c_data['costo_directo_inv_et']=floatval(str_replace(",","",$this->input->post('txtCostoDirectoInversion')));
			$c_data['gastos_generales_et']=floatval(str_replace(",","",$this->input->post('txtGastosGenerales')));
			$c_data['gastos_supervision_et']=floatval(str_replace(",","",$this->input->post('txtGastosSupervision')));
			$c_data['funcion_programatica']=$this->input->post('txtFuncion')."/".$this->input->post('txtPrograma')."/".$this->input->post('txtSubPrograma');
			$c_data['funcion_et']=$this->input->post('txtFuncion');
			$c_data['programa_et']=$this->input->post('txtPrograma');
			$c_data['sub_programa_et']=$this->input->post('txtSubPrograma');
			$c_data['proyecto_et']=$this->input->post('txtProyecto');
			$c_data['componente_et']=$this->input->post('txtComponente');
			$c_data['meta_et']=$this->input->post('txtMeta');
			$c_data['fuente_financiamiento_et']=$this->input->post('txtFuenteFinanciamiento');
			$c_data['tiempo_ejecucion_pi_et']=$this->input->post('txtTiempoEjecucionPip');
			$c_data['num_beneficiarios_indirectos']=$this->input->post('txtNumBeneficiarios');
			
			$c_data['costo_liquidacion']=floatval(str_replace(",","",$this->input->post('txtCostoLiquidacion')));
			$c_data['costo_IGV']=floatval(str_replace(",","",$this->input->post('txtCostoIGV')));
			$c_data['costo_utilidad']=floatval(str_replace(",","",$this->input->post('txtCostoUtilidad')));
			$c_data['costo_administracion_contratos']=floatval(str_replace(",","",$this->input->post('txtCostoAdministracion')));
			$c_data['costo_elaboracion_ET']=floatval(str_replace(",","",$this->input->post('txtCostoElaboracionET')));
			$c_data['costo_supervision_ET']=floatval(str_replace(",","",$this->input->post('txtCostoSupervisionET')));


			if($url!='')
			{
				$c_data['url_doc_aprobacion_et']=$url;
			}

			$c_data['desc_situacion_actual_et']=$this->input->post('txtSituacioActual');
			$c_data['relevancia_economica_et']=$this->input->post('txtSituacioDeseada');
			$c_data['resumen_pi_et']=$this->input->post('txtContribucioInterv');
			$c_data['num_folios']=$this->input->post('txtNumFolio');
			$c_data['fecha_aprobacion']=$this->input->post('txtFechaAprobacion');
			$c_data['num_meses']=$this->input->post('txtTiempoEjecucionPip');

			$q1 = $this->Model_ET_Expediente_Tecnico->update($c_data, $hdIdExpediente);

			// Editar Responsables de Ejecución y Elaboración

			$id_tipo_responsableElabo=$this->input->post('idTipoResponsableElaboracion');
			$comboCargoElaboracion =$this->input->post('comboCargoElaboracion');
			$comboResponsableElaboracion =$this->input->post('comboResponsableElaboracion');

			if($comboResponsableElaboracion!='')
			{
				($id_tipo_responsableElabo=="" ? $this->Model_ET_Responsable->insertarET_Epediente($hdIdExpediente,$comboResponsableElaboracion,$this->input->post('comboTipoResponsableElaboracion'),$comboCargoElaboracion) : $this->Model_ET_Expediente_Tecnico->EditarResponsableET($id_tipo_responsableElabo,$comboCargoElaboracion,$comboResponsableElaboracion));
			}

			$id_tipo_responsableEjecucion=$this->input->post('idTipoResponsableEjecucion');
			$comboCargoEjecucion =$this->input->post('comboCargoEjecucion');
			$ComboResponsableEjecucion =$this->input->post('ComboResponsableEjecucion');

			if($ComboResponsableEjecucion!='')
			{
				($id_tipo_responsableEjecucion=="" ? $this->Model_ET_Responsable->insertarET_Epediente($hdIdExpediente,$ComboResponsableEjecucion,$this->input->post('ComboTipoResponsableEjecucion'),$comboCargoEjecucion) : $this->Model_ET_Expediente_Tecnico->EditarResponsableET($id_tipo_responsableEjecucion,$comboCargoEjecucion,$ComboResponsableEjecucion));
			}

			// Subir Imagenes de Expediente Tecnico

			$configImg = array(
				"upload_path" => "./uploads/ImageExpediente",
				'allowed_types' => "*"
			);

			if($_FILES['imagen']['name'][0]!='')
			{
				for ($i=0; $i < count($_FILES['imagen']['name']); $i++)
				{
					$path = $_FILES['imagen']['name'][$i];
					$ext = pathinfo($path, PATHINFO_EXTENSION);

					$c_imagen['id_et'] = $hdIdExpediente;
					$c_imagen['desc_img'] = ".".$ext;

					$idImagen = $this->Model_ET_Img->insertarImgExpediente($c_imagen);

					$_FILES['archivo']['name'] = $idImagen.".".$ext;
					$_FILES['archivo']['type'] = $_FILES['imagen']['type'][$i];
					$_FILES['archivo']['tmp_name'] = $_FILES['imagen']['tmp_name'][$i];
					$_FILES['archivo']['error'] = $_FILES['imagen']['error'][$i];
					$_FILES['archivo']['size'] = $_FILES['imagen']['size'][$i];

					$this->load->library('upload', $configImg);

					$this->upload->initialize($configImg);

					if (!$this->upload->do_upload('archivo'))
					{
						$this->session->set_flashdata('error', $this->upload->display_errors('', ''));
						return redirect('/Expediente_Tecnico/verdetalle?id_et='.$hdIdExpediente);
					}
					else
					{
						$final_files_data[] = $this->upload->data();
					}
				}
			}

			$this->db->trans_complete();

			$this->session->set_flashdata('correcto', 'Expediente Tecnico modificado correctamente.');

			return redirect('/Expediente_Tecnico/verdetalle?id_et='.$hdIdExpediente);
		}

		$id_et=$this->input->GET('id_et');
		$listaimg=$this->Model_ET_Img->ListarImagen($id_et);
		$listarUResponsableERespoElabo=$this->Model_ET_Expediente_Tecnico->ListaResponsableEt($id_et,'001');
		$listarUResponsableERespoEjecucion=$this->Model_ET_Expediente_Tecnico->ListaResponsableEt($id_et,'002');

		$listarCargo=$this->Cargo_Modal->getcargo();

		$listaTipoResponsableElaboracion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable('001');
		$listaTipoResponsableEjecucion=$this->Model_ET_Tipo_Responsable->NombreTipoResponsable('002');

		$listarPersona=$this->Model_Personal->listarPersona();
		$ExpedienteTecnicoM=$this->Model_ET_Expediente_Tecnico->DatosExpediente($id_et);
		$costoIndirectoComponente=$this->Model_ET_Expediente_Tecnico->CostoIndirectoComponente($id_et);

		$listaModalidadEjecucion=$this->Model_ModalidadE->GetModalidadE();
		$listaFuenteFinanciamiento=$this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento();
		$listaPresupuestoEj=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucionCostoDirecto($ExpedienteTecnicoM->modalidad_ejecucion_et);
		foreach ($listaPresupuestoEj as $key => $value) {
			$value->costo_presupuesto_ej=$this->Model_ET_Expediente_Tecnico->ListarCostos($id_et,$value->id_presupuesto_ej);
		}

		return $this->load->view('front/Ejecucion/ExpedienteTecnico/editar',['ExpedienteTecnicoM'=>$ExpedienteTecnicoM, 'listaimg'=>$listaimg,'listarCargo' => $listarCargo,'listaTipoResponsableElaboracion' => $listaTipoResponsableElaboracion,'listaTipoResponsableEjecucion' => $listaTipoResponsableEjecucion,'listarPersona'=>$listarPersona,'listarUResponsableERespoElabo' =>$listarUResponsableERespoElabo,'listarUResponsableERespoEjecucion' =>$listarUResponsableERespoEjecucion, 'listaModalidadEjecucion' => $listaModalidadEjecucion , 'listaFuenteFinanciamiento' => $listaFuenteFinanciamiento,'costoIndirectoComponente' => $costoIndirectoComponente,'listaPresupuestoEj'=>$listaPresupuestoEj ]);
	}

	function modalidad()
	{
		if($this->input->post('hdIdExpediente'))
		{
			$this->db->trans_start();
			$hdIdExpediente=$this->input->post('hdIdExpediente');
			$modalidad=$this->input->post('txtModalidadEjecucion');
			$c_data['modalidad_ejecucion_et']=$this->input->post('txtModalidadEjecucion');
			$q1 = $this->Model_ET_Expediente_Tecnico->update($c_data, $hdIdExpediente);
			
			if (($modalidad=='ADMINISTRACION INDIRECTA') || ($modalidad=="MIXTO")) {
				$presupuestoEjec= $this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucionAdmInCostoDirecto();
				foreach($presupuestoEjec as $key =>$presupuesto){
					$existe = $this->Model_ET_Presupuesto_Ejecucion->siExiste($hdIdExpediente,$presupuesto->desc_presupuesto_ej); 
					if ($existe[0]->existe == 0) {
						$Comp_data['id_et']=$hdIdExpediente;
						$Comp_data['descripcion']=$presupuesto->desc_presupuesto_ej;
						$Comp_data['id_presupuesto_ej']=$presupuesto->id_presupuesto_ej_padre;
						$Comp_data['estado']="EXPEDIENTETECNICO";
						$Comp_data['tipo_ejecucion']='ADMINISTRACION INDIRECTA';
						$this->Model_ET_Componente->insertarComponente($Comp_data);
					}
					
			}
			}
			$this->db->trans_complete();

			$this->session->set_flashdata('correcto', 'Expediente Tecnico modificado correctamente.');

			return redirect('/Expediente_Tecnico/verdetalle?id_et='.$hdIdExpediente);
		}

		$id_et=$this->input->GET('id_et');
		$ExpedienteTecnicoM=$this->Model_ET_Expediente_Tecnico->DatosExpediente($id_et);

		$listaModalidadEjecucion=$this->Model_ModalidadE->GetModalidadE();

		return $this->load->view('front/Ejecucion/ExpedienteTecnico/modalidad',['ExpedienteTecnicoM'=>$ExpedienteTecnicoM, 'listaModalidadEjecucion' => $listaModalidadEjecucion]);
	}

    function registroBuscarProyecto()
    {
		$CodigoUnico=$this->input->get('inputValue');
		$Registrosproyectobuscos=$this->Model_ET_Expediente_Tecnico->ExpedienteContarRegistros($CodigoUnico);
		if(count($Registrosproyectobuscos)>0)
		{
			$verificar=$this->Model_ET_Expediente_Tecnico->VerificarExpedienteTecnico($Registrosproyectobuscos[0]->id_pi);

			if(count($verificar)>0)
			{
				echo json_encode(true);
			}
			else
			{
				echo json_encode(false);
			}
		}
		else
		{
			echo json_encode('noexiste');
		}
    }

	function reportePdfMetrado()
	{
		$id_ExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$opcion="BuscarExpedienteID";
		$MostraExpedienteNombre=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoSelectBuscarId($opcion,$id_ExpedienteTecnico);
		$MostraExpedienteTecnicoExpe=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoSelectBuscarId($opcion,$id_ExpedienteTecnico);

	    $MostraExpedienteTecnicoExpe->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($id_ExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

	    foreach ($MostraExpedienteTecnicoExpe->childComponente as $key => $value)
	    {
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidada($item);
			}
		}

		$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reporteMetrado',['MostraExpedienteTecnicoExpe'=>$MostraExpedienteTecnicoExpe,'MostraExpedienteNombre' =>$MostraExpedienteNombre], false);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));
	}

    public function reportePdfPresupuestoAnalitico()
    {
    	$id_et = isset($_GET['id_et']) ? $_GET['id_et'] : null;
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

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($id_et);

		$PresupuestoEjecucionListar=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

		$costoDirecto=0;
		$costoIndirecto=0;

		foreach ($PresupuestoEjecucionListar as $key => $value)
		{
			$Presupuesto=$this->Model_ET_Presupuesto_Ejecucion->PresupuestoEjPorIdPadre($value->id_presupuesto_ej);
			if(count($Presupuesto)==0)
			{
				$value->childPresupuesto=[];
				$value->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($id_et,$value->id_presupuesto_ej);
				foreach ($value->ChilpresupuestoAnalitico as $key  => $presupuesto)
				{
					$presupuesto->ChilCostoDetallePartida=$this->Model_ET_Detalle_Partida->CostoDetallePartida($presupuesto->id_analitico);
					foreach ($presupuesto->ChilCostoDetallePartida as $key => $costoDetalle)
					{
						$costoDirecto+=$costoDetalle->costoDirecto;
					}
				}
			}
			if(count($Presupuesto)>0)
			{
				$value->childPresupuesto=$Presupuesto;
				foreach ($value->childPresupuesto as $key => $temp)
				{
					$temp->ChilpresupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoAnaliticoDetalles($id_et,$temp->id_presupuesto_ej);

					foreach ($temp->ChilpresupuestoAnalitico as $key  => $presupuesto)
					{
						$presupuesto->ChilCostoDetallePartida=$this->Model_ET_Detalle_Partida->CostoDetallePartida($presupuesto->id_analitico);
						foreach ($presupuesto->ChilCostoDetallePartida as $key => $costoDetalle)
						{
							$costoIndirecto+=$costoDetalle->costoDirecto;
						}
					}
				}
			}
		}

		$this->load->library('mydompdf');
        $html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePdfPresupuestoAnalitico',['expedienteTecnico' => $expedienteTecnico,'PresupuestoEjecucionListar' => $PresupuestoEjecucionListar,'PresupuestoEjecucion'=>$PresupuestoEjecucion,'costoDirecto'=>$costoDirecto,'costoIndirecto'=>$costoIndirecto], true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->set_paper('A4', 'landscape');
        $this->mydompdf->render();
        $this->mydompdf->stream("reportePdfPresupuestoAnalitico.pdf", array("Attachment" => false));
    }

    public function reportePdfAnalisisPrecioUnitarioFF11()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('idExpediente');	
			$childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, 2, 'EXPEDIENTETECNICO');
			$this->load->view('front/Ejecucion/ETAnalisisUnitario/listaComponente',['childComponente'=>$childComponente, 'idExpedienteTecnico'=>$idExpedienteTecnico]);			
		}
		else
		{
			$id_et = isset($_GET['query']) ? $_GET['query'] : null;
			$etExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($id_et);
			$etExpedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($etExpedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');
			foreach($etExpedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaReporteFF11($item);
				}
			}
			$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reporteAnalisisPreciosFF11', ["etExpedienteTecnico" => $etExpedienteTecnico], true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper("A4", "portrait");
			$this->mydompdf->render();
			$this->mydompdf->stream("reporteAnalisisPreciosFF11.pdf", array("Attachment" => false));	
		}		
	}
	
	public function reportePdfAnalisisUnitarioPorComponente()
	{
		$idComponente=$this->input->get('query');
		$componente=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);
		$componente->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($componente->id_componente);
		foreach($componente->childMeta as $index => $item)
		{
			$this->obtenerMetaAnidadaParaReporteFF11($item);
		}
		$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reporteAnalisisUnitario', ["componente" => $componente], true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "portrait");
		$this->mydompdf->render();
		$this->mydompdf->stream("reporteAnalisisPreciosFF11.pdf", array("Attachment" => false));	
	}
	
	public function reportePdfPresupuestoFF05()
	{
		$id_ExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$opcion="BuscarExpedienteID";
		$MostraExpedienteNombre=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoSelectBuscarId($opcion,$id_ExpedienteTecnico);
		$MostraExpedienteTecnicoExpe=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoSelectBuscarId($opcion,$id_ExpedienteTecnico);

	  $MostraExpedienteTecnicoExpe->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($id_ExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

		$costoDirectoTotal=0;
		foreach ($MostraExpedienteTecnicoExpe->childComponente as $key => $value)
	    {
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$costoComponente+=$item->costoMeta;
			}
			$costoDirectoTotal+=$costoComponente;
			$value->costoComponente=$costoComponente;
		}
		$MostraExpedienteTecnicoExpe->costoDirecto=$costoDirectoTotal;

		$MostraExpedienteTecnicoExpe->childComponenteIndirecta=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($id_ExpedienteTecnico, 1030, 'EXPEDIENTETECNICO');

		$costoDirectoTotalIndirecta=0;
		foreach ($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value)
	    {
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$costoComponente+=$item->costoMeta;
			}
			$costoDirectoTotalIndirecta+=$costoComponente;
			$value->costoComponente=$costoComponente;
		}
		$MostraExpedienteTecnicoExpe->costoDirectoIndirecta=$costoDirectoTotalIndirecta;
    //COSTOS INDIRECTOS
	  $MostraExpedienteTecnicoExpe->childCostoIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($id_ExpedienteTecnico, 16, 'EXPEDIENTETECNICO');

		$costoIndirectoTotal=0;
	    foreach ($MostraExpedienteTecnicoExpe->childCostoIndirecto as $key => $value)
	    {
			$costoComponente=0;
			// $value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			// foreach ($value->childMeta as $index => $item)
			// {
			// 	$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
			// 	$costoComponente+=$item->costoMeta;
			// }
			$costoIndirectoTotal+=$value->monto;
			$value->costoComponente=$value->monto;
		}
		$MostraExpedienteTecnicoExpe->costoIndirecto=$costoIndirectoTotal;

		$MostraExpedienteTecnicoExpe->childCostoIndirectoIndirecta=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($id_ExpedienteTecnico, 1031, 'EXPEDIENTETECNICO');

		$costoIndirectoTotalIndirecta=0;
	    foreach ($MostraExpedienteTecnicoExpe->childCostoIndirectoIndirecta as $key => $value)
	    {
			$costoComponente=0;
			// $value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			// foreach ($value->childMeta as $index => $item)
			// {
			// 	$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
			// 	$costoComponente+=$item->costoMeta;
			// }
			$costoIndirectoTotalIndirecta+=$value->monto;
			$value->costoComponente=$value->monto;
		}
		$MostraExpedienteTecnicoExpe->costoIndirectoIndirecta=$costoIndirectoTotalIndirecta;

		$MostraExpedienteTecnicoExpe->presupuestoGeneral=$costoIndirectoTotal+$costoDirectoTotal;
		$MostraExpedienteTecnicoExpe->presupuestoGeneralIndirecta=$costoIndirectoTotalIndirecta+$costoDirectoTotalIndirecta;

		$html= $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePresupuestoFF05',['MostraExpedienteTecnicoExpe'=>$MostraExpedienteTecnicoExpe,'MostraExpedienteNombre' => $MostraExpedienteNombre], true);
		$this->mydompdf->set_paper('latter','landscape');
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("reportePresupuestoFF05.pdf", array("Attachment" => false));
	}

	public function reporteDesagGastosGenerales()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'GENERAL','EXPEDIENTETECNICO');

	    foreach ($expedienteTecnico->childComponente as $key => $value)
	    {
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$item->nivel = substr_count($item->numeracion, '.');
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$this->obtenerMetaAnidada($item);
			}
		}

		$expedienteTecnico->childCostoIndirecto=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'GENERAL','EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childCostoIndirecto as $key => $value)
		{
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='NO ASIGNADO';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$costoComponente+=$item->costoMeta;
			}
			$value->costoComponente=$costoComponente;
		}

		$html= $this->load->view('front/Ejecucion/Reporte/DesagregadoGastosGenerales',['expedienteTecnico'=>$expedienteTecnico], true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("DesagGastosGenerales.pdf", array("Attachment" => false));
	}

	public function reporteDesagGastosSupervision()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'SUPERV','EXPEDIENTETECNICO');

	    foreach ($expedienteTecnico->childComponente as $key => $value)
	    {
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$item->nivel = substr_count($item->numeracion, '.');
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$this->obtenerMetaAnidada($item);
			}
		}

		$expedienteTecnico->childCostoIndirecto=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'SUPERV','EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childCostoIndirecto as $key => $value)
		{
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='NO ASIGNADO';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$costoComponente+=$item->costoMeta;
			}
			$value->costoComponente=$costoComponente;
		}

		$html= $this->load->view('front/Ejecucion/Reporte/DesagregadoGastosSupervision',['expedienteTecnico'=>$expedienteTecnico], true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("DesagGastosSupervision.pdf", array("Attachment" => false));
	}

	public function reporteDesagGastosLiquidacion()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'LIQUID','EXPEDIENTETECNICO');

	    foreach ($expedienteTecnico->childComponente as $key => $value)
	    {
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach ($value->childMeta as $index => $item)
			{
				$item->nivel = substr_count($item->numeracion, '.');
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$this->obtenerMetaAnidada($item);
			}
		}

		$expedienteTecnico->childCostoIndirecto=$this->Model_ET_Componente->ETCostoIndirectoPorDescripcion($idExpedienteTecnico,16,'LIQUID','EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childCostoIndirecto as $key => $value)
		{
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$clasificadorMeta=$this->Model_ET_Meta_Analitico->ClasificadorPorMeta($item->id_meta);
				if(count($clasificadorMeta)==0)
				{
					$item->clasificador='NO ASIGNADO';
				}
				else
				{
					$item->clasificador=$clasificadorMeta[0]->num_clasificador;
				}
				$costoComponente+=$item->costoMeta;
			}
			$value->costoComponente=$costoComponente;
		}

		$html= $this->load->view('front/Ejecucion/Reporte/DesagregadoGastosLiquidacion',['expedienteTecnico'=>$expedienteTecnico], true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("DesagGastosLiquidacion.pdf", array("Attachment" => false));
	}

	public function reporteListaInsumos()
	{
		$idExpedienteTecnico=isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$listarecurso=$this->Model_ET_Recurso->RecursoListar('R');
		$costoDirectoExpediente=0;
		foreach($listarecurso as $key => $recurso)
		{
			$insumo=$this->Model_ET_Recurso_Insumo->listaInsumoPorRecurso($recurso->id_recurso,$idExpedienteTecnico);
			$sumatoria=0;
			foreach($insumo as $key => $value)
			{
				$sumatoria+=$value->parcial;
				if($value->cantidad>0)
				{
					$value->precioUnitario=$value->parcial/$value->cantidad;
				}
				else
				{
					$value->precioUnitario=0;
				}
			}
			$costoDirectoExpediente+=$sumatoria;
			$recurso->childInsumo=$insumo;
			$recurso->costoTotalRecurso=$sumatoria;
		}

		$expedienteTecnico->costoDirecto=$costoDirectoExpediente;
		$html= $this->load->view('front/Ejecucion/Reporte/RelaciondeInsumos',['expedienteTecnico'=>$expedienteTecnico,'recurso'=>$listarecurso],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("RelacionInsumos.pdf", array("Attachment" => false));
	}

	public function reporteDesagHerramientas()
	{
		$idExpedienteTecnico=isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$listarecurso=$this->Model_ET_Recurso->Recurso('3');
		$costoDirectoExpediente=0;
		foreach($listarecurso as $key => $recurso)
		{
			$insumo=$this->Model_ET_Recurso_Insumo->listaInsumoPorRecurso($recurso->id_recurso,$idExpedienteTecnico);
			$sumatoria=0;
			foreach($insumo as $key => $value)
			{
				if($value->cantidad!=0)
				{
					$value->precioUnitario=$value->parcial/$value->cantidad;
				}
				else
				{
					$value->precioUnitario=0;
				}				
				$sumatoria+=$value->parcial;
			}
			$costoDirectoExpediente+=$sumatoria;
			$recurso->childInsumo=$insumo;
			$recurso->costoTotalRecurso=$sumatoria;
		}
		$expedienteTecnico->costoDirecto=$costoDirectoExpediente;
		$html= $this->load->view('front/Ejecucion/Reporte/DesagregadoHerramientas',['expedienteTecnico'=>$expedienteTecnico,'recurso'=>$listarecurso],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->render();
		$this->mydompdf->stream("DesagEquiposyHerramientas.pdf", array("Attachment" => false));

	}

	public function CronogramacionRecurso()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$listarecurso=$this->Model_ET_Recurso->RecursoListar('R');

		$this->load->view('front/Ejecucion/ExpedienteTecnico/cronogramacionRecurso',['recurso'=>$listarecurso,'id_et'=>$idExpedienteTecnico]);
	}

	public function valorizacionEjecucionProyecto()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($expedienteTecnico->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/index');
			}
        }

        if($expedienteTecnico->aprobado==1)
        {
        	$this->session->set_flashdata('error', 'Este expediente Tecnico ya esta en fase de Ejecución');
			redirect('Expediente_Tecnico/index');
        }

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}

		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/valorizacionEjecucionProyecto', ['expedienteTecnico' => $expedienteTecnico]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function cronogramaEjecucionProyecto()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}

		$html = $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePdfCronogramaEjecucion',['expedienteTecnico'=>$expedienteTecnico],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "landscape");
		$this->mydompdf->render();
		$this->mydompdf->stream("reporteCronogramaEjecucion.pdf", array("Attachment" => false));
    }

	public function reportePdfValorizacionEjecucion()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}

		$html = $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePdfValorizacionEjecucion',['expedienteTecnico'=>$expedienteTecnico],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "landscape");
		$this->mydompdf->render();
		$this->mydompdf->stream("reporteValorizacionEjecucion.pdf", array("Attachment" => false));
    }

	public function reportePdfEjecucion007()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}

		$expedienteTecnico->childComponenteIndirecta=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 1030, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childComponenteIndirecta as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}

		$expedienteTecnico->childCostoIndirecto=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 16, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childCostoIndirecto as $key => $value)
		{
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$costoComponente+=$item->costoMeta;
			}
			$value->costoComponente=$costoComponente;
		}

		$expedienteTecnico->childCostoIndirectoIndirecta=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 1031, 'EXPEDIENTETECNICO');

		foreach($expedienteTecnico->childCostoIndirectoIndirecta as $key => $value)
		{
			$costoComponente=0;
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$item->costoMeta=$this->obtenerAnidadaCostoIndirecto($item);
				$costoComponente+=$item->costoMeta;
			}
			$value->costoComponente=$costoComponente;
		}

		$html = $this->load->view('front/Ejecucion/ExpedienteTecnico/reportePdfEjecucion007',['expedienteTecnico'=>$expedienteTecnico],true);
		$this->mydompdf->load_html($html);
		$this->mydompdf->set_paper("A4", "portrait");
		$this->mydompdf->render();
		$this->mydompdf->stream("reporteValorizacionEjecucion.pdf", array("Attachment" => false));
	}

	private function obtenerAnidadaCostoIndirecto($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		$sumatoria=0;

		if(count($temp)==0)
		{
			$data = $this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($data as $key => $value)
			{
				$sumatoria+=$value->parcial;
			}

			return $sumatoria;

		}
		else
		{
			$data = $this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($data as $key => $value)
			{
				$sumatoria+=$value->parcial;
			}

		}

		$costoPorMeta=$sumatoria;

		foreach($meta->childMeta as $key => $value)
		{

			$costoPorMeta+=$this->obtenerAnidadaCostoIndirecto($value);

		}

		return $costoPorMeta;
	}

	private function obtenerMetaAnidadaReporteF005($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaMontoff05($meta->id_meta);

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaReporteF005($value);
		}
	}

	private function updateMetaAnidadaCostoIndirecto($meta,$analitico)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		$meta->nivel = substr_count($meta->numeracion, '.');

		if(count($temp)==0)
		{
			$meta->nivel = substr_count($meta->numeracion, '.');

			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $item)
			{
				$u_data['id_analitico']=$analitico;
				$this->Model_ET_Analisis_Unitario->update($u_data,$item->id_detalle_partida);
			}
		}

		foreach($meta->childMeta as $key => $value1)
		{
			$this->updateMetaAnidadaCostoIndirecto($value1);
		}
	}

	private function obtenerMetaAnidada($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		$meta->nivel = substr_count($meta->numeracion, '.');

		if(count($temp)==0)
		{
			$meta->nivel = substr_count($meta->numeracion, '.');

			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidada($value);
		}
	}

	private function obtenerMetaAnidadaEjecucion($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach ($meta->childPartida as $key => $item)
			{
				$item->childDetSegValorizacion=$this->Model_DetSegOrden->PartidasEjecutadasPeriodo2(date('Y-m-d'),$item->id_partida);
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaEjecucion($value);
		}
	}

	private function obtenerMetaAnidadaParaValorizacion($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{

				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaParaValorizacion($value->id_partida);

				$value->childDetallePartida->childMesValorizacion=$this->Model_ET_Mes_Valorizacion->ETMesValorizacionPorIdDetallePartida($value->childDetallePartida->id_detalle_partida);

				$sumatoriaValorizacion=$this->Model_ET_Mes_Valorizacion->sumCantidadPorIdDetallePartida($value->childDetallePartida->id_detalle_partida);
				$value->saldo=$value->cantidad-$sumatoriaValorizacion;
			}

			return false;
		}
		else {
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{

				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaParaValorizacion($value->id_partida);

				$value->childDetallePartida->childMesValorizacion=$this->Model_ET_Mes_Valorizacion->ETMesValorizacionPorIdDetallePartida($value->childDetallePartida->id_detalle_partida);

				$sumatoriaValorizacion=$this->Model_ET_Mes_Valorizacion->sumCantidadPorIdDetallePartida($value->childDetallePartida->id_detalle_partida);
				$value->saldo=$value->cantidad-$sumatoriaValorizacion;
			}
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaParaValorizacion($value);
		}
	}

	private function obtenerMetaAnidadaParaReporteFF11($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{
				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartida($value->id_partida);

				foreach($value->childDetallePartida as $index => $item)
				{
					$item->childAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetallePartida($item->id_detalle_partida);

					foreach ($item->childAnalisisUnitario as $k => $v)
					{
						$v->childDetalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisUnitarioPorIdAnalisis($v->id_analisis);
					}
				}
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaParaReporteFF11($value);
		}
	}

	public function eliminar()
	{
		if ($this->input->is_ajax_request())
	    {
			$flat="ELIMINAR";
			$id_et=$this->input->post('id_et');

			if((count($this->Model_ET_Expediente_Tecnico->VerificarComponenteExpedienteAntesEliminar($id_et))>0) || (count($this->Model_ET_Expediente_Tecnico->VerificarETPresupuestoAnaliticoExpedienteAntesEliminar($id_et))>0) || (count($this->Model_ET_Expediente_Tecnico->VerificarETTareaGantt($id_et))>0) )
            {
            	echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede eliminar este expediente.']);exit;
            }
           	else
           	{
           		$eliminarImg=$this->Model_ET_Expediente_Tecnico->ET_Img($id_et);
           		foreach ($eliminarImg as $value)
           		{
           			if (file_exists("uploads/ImageExpediente/".$value->desc_img))
           			{
					   	unlink("uploads/ImageExpediente/".$value->desc_img);
					}else
					{

					}
           		}
           		if($this->Model_ET_Expediente_Tecnico->eliminar($flat,$id_et)==true)
	            {
	            	echo json_encode(['proceso' => 'correcto', 'mensaje' => 'El registro fue eliminado correctamente.']);exit;
	            }
           	}
		}
	}

	public function ResponsableExpediente()
	{
		$flat="LISTAREXPEDIENTERESPONSABLE";
		$id_et=$this->input->post('id_et');

		$detalleExpediente=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($id_et);
		if($detalleExpediente[0]->id_etapa_et==3)
		{
			$listaResponsableExpediente=$this->Model_ET_Responsable->personalActualPorET($id_et);
		}
		if($detalleExpediente[0]->id_etapa_et==10)
		{
			$listaResponsableExpediente=$this->Model_ET_Responsable->personalActualPorET($id_et);
		}
		if($detalleExpediente[0]->id_etapa_et==1)
		{
			$listaResponsableExpediente=$this->Model_ET_Expediente_Tecnico->ListarResponsableExpediente($flat,$id_et);
		}

		$this->load->view('front/Ejecucion/ExpedienteTecnico/responsableExpediente.php',['listaResponsableExpediente'=>$listaResponsableExpediente,'etapa'=>$detalleExpediente[0]->id_etapa_et]);

	}

	public function DocumentoExpediente()
	{
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('id_et'));

		$id_et=$this->input->get('id_et');
		$ListarDocumentoExpediente=$this->Model_ET_Expediente_Tecnico->ListarDocumentoExpediente($id_et);
		$this->load->view('front/Ejecucion/ExpedienteTecnico/documentoExpediente.php',['ListarDocumentoExpediente'=>$ListarDocumentoExpediente,'expedienteTecnico' => $expedienteTecnico,'id_et' => $id_et]);
	}

	public function DetalleExpediente()
	{
		$id_et=$this->input->post('id_et');
		$detalleExpediente=$this->Model_ET_Expediente_Tecnico->DetalleExpediente($id_et);
		$this->load->view('front/Ejecucion/ExpedienteTecnico/detalleExpediente.php',["detalleExpediente" => $detalleExpediente]);
	}

	public function vistoBueno()
	{
		if($_POST)
        {
            $darvistobueno=$this->input->post('id_et');
            $vistoBueno=$this->Model_ET_Expediente_Tecnico->darvistobueno($darvistobueno);
			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se dio el visto bueno al expediente técnico correctamente.']);
			exit;
        }

		$id_ExpedienteTecnico=$this->input->GET('id_ExpedienteTecnico');
		$expedienteVistoBueno=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($id_ExpedienteTecnico);
		$this->load->view('front/Ejecucion/ExpedienteTecnico/modalParaVistoBueno',['expedienteVistoBueno'=>$expedienteVistoBueno]);
	}

	public function clonacion()
	{
		$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
		$idEtapa=$this->input->post('idEtapaExpedienteTecnico');
		$txtUrlDocAprobacion=$this->input->post('url');
		$txtFechaAprobacion=$this->input->post('txtFechaAprobacion');

		if($idExpedienteTecnico!=null && $idEtapa!=null)
		{
			$expediente=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idExpedienteTecnico);

			if($expediente[0]->estado_revision!=1)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'Aún no se ha dado el visto bueno a este expediente técnico para proceder con el pase de etapa.']);exit;
			}

			if($expediente[0]->id_etapa_et==$idEtapa)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico para la misma etapa.']);exit;
			}

			if($this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorIdETPadre($expediente[0]->id_et)!=null)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar dos veces de un mismo expediente técnico.']);exit;
			}

			// $listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

			// foreach($listaETComponente as $key => $value)
			// {
			// 	$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			// 	foreach($listaETMeta as $index => $item)
			// 	{
			// 		if($this->analisisUnitarioSinAnalitico($item))
			// 		{
			// 			echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico porque existen análisis unitarios sin asignación de analítico.']);exit;
			// 		}
			// 	}
			// }

			if($this->input->post('url')!='')
			{
				$config['upload_path']   = './uploads/ResolucioExpediente/';
				$config['allowed_types'] = '*';
				$config['encrypt_name']  = false;
				$config['file_name'] =$idExpedienteTecnico;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('fileResolucion');

				$this->Model_ET_Expediente_Tecnico->AprobarExpediente($txtUrlDocAprobacion, $txtFechaAprobacion, $idExpedienteTecnico);
			}

			$this->db->trans_start();			
			
			foreach($expediente as $exp)
			{
				$exp_data['id_pi']=$exp->id_pi;
				$exp_data['nombre_ue']=$exp->nombre_ue;
				$exp_data['direccion_ue']=$exp->direccion_ue;
				$exp_data['distrito_provincia_departamento_ue']=$exp->distrito_provincia_departamento_ue;
				$exp_data['telefono_ue']=$exp->telefono_ue;
				$exp_data['ruc_ue']=$exp->ruc_ue;
				$exp_data['costo_total_preinv_et']=$exp->costo_total_preinv_et;
				$exp_data['costo_directo_preinv_et']=$exp->costo_directo_preinv_et;
				$exp_data['costo_indirecto_preinv_et']=$exp->costo_indirecto_preinv_et;
				$exp_data['costo_total_inv_et']=$exp->costo_total_inv_et;
				$exp_data['costo_directo_inv_et']=$exp->costo_directo_inv_et;
				$exp_data['gastos_generales_et']=$exp->gastos_generales_et;
				$exp_data['gastos_supervision_et']=$exp->gastos_supervision_et;
				$exp_data['funcion_programatica']=$exp->funcion_programatica;
				$exp_data['funcion_et']=$exp->funcion_et;
				$exp_data['programa_et']=$exp->programa_et;
				$exp_data['sub_programa_et']=$exp->sub_programa_et;
				$exp_data['proyecto_et']=$exp->proyecto_et;
				$exp_data['componente_et']=$exp->componente_et;
				$exp_data['meta_et']=$exp->meta_et;
				$exp_data['fuente_financiamiento_et']= $exp->fuente_financiamiento_et;
				$exp_data['modalidad_ejecucion_et']= $exp->modalidad_ejecucion_et;
				$exp_data['tiempo_ejecucion_pi_et']= $exp->tiempo_ejecucion_pi_et;
				$exp_data['num_beneficiarios_indirectos']= $exp->num_beneficiarios_indirectos;
				$exp_data['fecha_inicio_et']= $exp->fecha_inicio_et;
				$exp_data['fecha_fin_et']= $exp->fecha_fin_et;
				$exp_data['url_doc_aprobacion_et']= $exp->url_doc_aprobacion_et;
				$exp_data['desc_situacion_actual_et']= $exp->desc_situacion_actual_et;
				$exp_data['relevancia_economica_et']= $exp->relevancia_economica_et;
				$exp_data['resumen_pi_et']= $exp->resumen_pi_et;
				$exp_data['num_folios']= $exp->num_folios;
				$exp_data['estado_revision']= $exp->estado_revision;
				$exp_data['id_et_padre']= $exp->id_et;
				$exp_data['id_etapa_et']= $idEtapa;
				$exp_data['fecha_registro']= $exp->fecha_registro;
				$exp_data['aprobado']= $exp->aprobado;
				$exp_data['url_memoria_descriptiva']= $exp->url_memoria_descriptiva;
				$exp_data['url_impacto_ambiental']= $exp->url_impacto_ambiental;
				$exp_data['url_categoria_impacto']= $exp->url_categoria_impacto;
				$exp_data['num_meses']= $exp->num_meses;
				$exp_data['generalidad_especificacion_tecnica']=$exp->generalidad_especificacion_tecnica;			
				$lastExpediente=$this->Model_ET_Expediente_Tecnico->insertar($exp_data);
				if(file_exists('./uploads/ResolucioExpediente/'.$exp->id_et.'.'.$exp->url_doc_aprobacion_et))
				{
					copy('./uploads/ResolucioExpediente/'.$exp->id_et.'.'.$exp->url_doc_aprobacion_et, './uploads/ResolucioExpediente/'.$lastExpediente.'.'.$exp->url_doc_aprobacion_et);
				}
			}

			$presupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoPorIdET($idExpedienteTecnico);
			foreach ($presupuestoAnalitico as $pres) 
			{
				$pres_data['id_clasificador']=$pres->id_clasificador;
				$pres_data['id_et']=$lastExpediente;
				$pres_data['id_presupuesto_ej']=$pres->id_presupuesto_ej;
				$pres_data['fecha_presupuesto']=$pres->fecha_presupuesto;
				$lastPres=$this->Model_ET_Presupuesto_Analitico->insertar($pres_data);
			}

			$responsable=$this->Model_ET_Responsable->ETResponsablePorIdET($idExpedienteTecnico);
			foreach ($responsable as $resp) 
			{
				$resp_data['id_et']=$lastExpediente;
				$resp_data['id_persona']=$resp->id_persona;
				$resp_data['id_tipo_responsable_et']=$resp->id_tipo_responsable_et;
				$resp_data['id_cargo']=$resp->id_cargo;
				$resp_data['num_registro_prof']=$resp->num_registro_prof;
				$resp_data['fecha_asignacion_resp_et']=$resp->fecha_asignacion_resp_et;
				$resp_data['estado_responsable_et']=$resp->estado_responsable_et;
				$resp_data['fecha_inicio']=$resp->fecha_inicio;
				$resp_data['fecha_fin']=$resp->fecha_fin;
				$lastResp=$this->Model_ET_Responsable->insertar($resp_data);
			}

			$imagen=$this->Model_ET_Img->ListarImagen($idExpedienteTecnico);
			foreach ($imagen as $img) 
			{
				$data_img['id_et']=$lastExpediente;
				$data_img['desc_img']=$img->desc_img;
				$lastImg=$this->Model_ET_Img->insertarImgExpediente($data_img);

				if(file_exists('./uploads/ImageExpediente/'.$img->id_img.''.$img->desc_img))
				{
					copy('./uploads/ImageExpediente/'.$img->id_img.''.$img->desc_img, './uploads/ImageExpediente/'.$lastImg.''.$img->desc_img);
				}
			}

			$componente=$this->Model_ET_Componente->ETComponentePorIdET($idExpedienteTecnico);
			foreach ($componente as $comp) 
			{
				$comp_data['id_et']=$lastExpediente;
				$comp_data['descripcion']=$comp->descripcion;
				$comp_data['numeracion']=$comp->numeracion;
				$comp_data['id_presupuesto_ej']=$comp->id_presupuesto_ej;
				$comp_data['estado']=$comp->estado;
				$comp_data['url']=$comp->url;
				$comp_data['tipo_ejecucion']=$comp->tipo_ejecucion;
				$comp_data['monto']=$comp->monto;
				$comp_data['porcentaje']=$comp->porcentaje;
				$lastComponente=$this->Model_ET_Componente->insertarComponente($comp_data);
				
				$meta=$this->Model_ET_Meta->ETMetaPorIdComponente($comp->id_componente);
				foreach($meta as $item)
				{
					$meta_data['id_componente']=$lastComponente;
					$meta_data['desc_meta']=$item->desc_meta;
					$meta_data['numeracion']=$item->numeracion;
					$meta_data['url']=$item->url;
					$lastMeta=$this->Model_ET_Meta->insertarMeta($meta_data);
					$this->obtenerMetaAnidadaParaClonacion($item, $lastMeta, $lastExpediente);
				}
			}

			$this->Model_ET_Expediente_Tecnico->updateAprobacion(1,$idExpedienteTecnico);

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'el Expediente paso a etapa de ejecucion satisfactoriamente']);exit;
		}

	}

	public function clonacionModificatoria()
	{
		$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
		$idEtapa=$this->input->post('idEtapaExpedienteTecnico');
		$txtUrlDocAprobacion=$this->input->post('url');
		$txtFechaAprobacion=$this->input->post('txtFechaAprobacion');
		$txtDescripcionModificatoria=$this->input->post('txtDescripcionModificatoria');

		if($idExpedienteTecnico!=null && $idEtapa!=null)
		{
			$expediente=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($idExpedienteTecnico);

			if($expediente[0]->estado_revision!=1)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'Aún no se ha dado el visto bueno a este expediente técnico para proceder con la modificatoria.']);exit;
			}

			if($expediente[0]->id_etapa_et==$idEtapa && $expediente[0]->id_etapa_et!=10)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede crear la modificatoria de expediente técnico para la misma etapa.']);exit;
			}

			if($this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorIdETPadre($expediente[0]->id_et)!=null)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede crear la modificatoria dos veces de un mismo expediente técnico.']);exit;
			}

			// $listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

			// foreach($listaETComponente as $key => $value)
			// {
			// 	$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			// 	foreach($listaETMeta as $index => $item)
			// 	{
			// 		if($this->analisisUnitarioSinAnalitico($item))
			// 		{
			// 			echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede crear la modificatoria de expediente técnico porque existen análisis unitarios sin asignación de analítico.']);exit;
			// 		}
			// 	}
			// }

			if($this->input->post('url')!='')
			{
				$config['upload_path']   = './uploads/ResolucioExpediente/';
				$config['allowed_types'] = '*';
				$config['encrypt_name']  = false;
				$config['file_name'] =$idExpedienteTecnico;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('fileResolucion');

				$this->Model_ET_Expediente_Tecnico->AprobarExpediente($txtUrlDocAprobacion, $txtFechaAprobacion, $idExpedienteTecnico);
			}

			$this->db->trans_start();			
			
			foreach($expediente as $exp)
			{
				$exp_data['id_pi']=$exp->id_pi;
				$exp_data['nombre_ue']=$exp->nombre_ue;
				$exp_data['direccion_ue']=$exp->direccion_ue;
				$exp_data['distrito_provincia_departamento_ue']=$exp->distrito_provincia_departamento_ue;
				$exp_data['telefono_ue']=$exp->telefono_ue;
				$exp_data['ruc_ue']=$exp->ruc_ue;
				$exp_data['costo_total_preinv_et']=$exp->costo_total_preinv_et;
				$exp_data['costo_directo_preinv_et']=$exp->costo_directo_preinv_et;
				$exp_data['costo_indirecto_preinv_et']=$exp->costo_indirecto_preinv_et;
				$exp_data['costo_total_inv_et']=$exp->costo_total_inv_et;
				$exp_data['costo_directo_inv_et']=$exp->costo_directo_inv_et;
				$exp_data['gastos_generales_et']=$exp->gastos_generales_et;
				$exp_data['gastos_supervision_et']=$exp->gastos_supervision_et;
				$exp_data['funcion_programatica']=$exp->funcion_programatica;
				$exp_data['funcion_et']=$exp->funcion_et;
				$exp_data['programa_et']=$exp->programa_et;
				$exp_data['sub_programa_et']=$exp->sub_programa_et;
				$exp_data['proyecto_et']=$exp->proyecto_et;
				$exp_data['componente_et']=$exp->componente_et;
				$exp_data['meta_et']=$exp->meta_et;
				$exp_data['fuente_financiamiento_et']= $exp->fuente_financiamiento_et;
				$exp_data['modalidad_ejecucion_et']= $exp->modalidad_ejecucion_et;
				$exp_data['tiempo_ejecucion_pi_et']= $exp->tiempo_ejecucion_pi_et;
				$exp_data['num_beneficiarios_indirectos']= $exp->num_beneficiarios_indirectos;
				$exp_data['fecha_inicio_et']= $exp->fecha_inicio_et;
				$exp_data['fecha_fin_et']= $exp->fecha_fin_et;
				$exp_data['url_doc_aprobacion_et']= $exp->url_doc_aprobacion_et;
				$exp_data['desc_situacion_actual_et']= $exp->desc_situacion_actual_et;
				$exp_data['relevancia_economica_et']= $exp->relevancia_economica_et;
				$exp_data['resumen_pi_et']= $exp->resumen_pi_et;
				$exp_data['num_folios']= $exp->num_folios;
				$exp_data['estado_revision']= $exp->estado_revision;
				$exp_data['id_et_padre']= $exp->id_et;
				$exp_data['id_etapa_et']= $idEtapa;
				$exp_data['fecha_registro']= $exp->fecha_registro;
				$exp_data['aprobado']= $exp->aprobado;
				$exp_data['url_memoria_descriptiva']= $exp->url_memoria_descriptiva;
				$exp_data['url_impacto_ambiental']= $exp->url_impacto_ambiental;
				$exp_data['url_categoria_impacto']= $exp->url_categoria_impacto;
				$exp_data['num_meses']= $exp->num_meses;
				$exp_data['generalidad_especificacion_tecnica']=$exp->generalidad_especificacion_tecnica;
				$exp_data['descripcion_modificatoria']=$txtDescripcionModificatoria;			
				$lastExpediente=$this->Model_ET_Expediente_Tecnico->insertar($exp_data);
				if(file_exists('./uploads/ResolucioExpediente/'.$exp->id_et.'.'.$exp->url_doc_aprobacion_et))
				{
					copy('./uploads/ResolucioExpediente/'.$exp->id_et.'.'.$exp->url_doc_aprobacion_et, './uploads/ResolucioExpediente/'.$lastExpediente.'.'.$exp->url_doc_aprobacion_et);
				}
			}

			$presupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoPorIdET($idExpedienteTecnico);
			foreach ($presupuestoAnalitico as $pres) 
			{
				$pres_data['id_clasificador']=$pres->id_clasificador;
				$pres_data['id_et']=$lastExpediente;
				$pres_data['id_presupuesto_ej']=$pres->id_presupuesto_ej;
				$pres_data['fecha_presupuesto']=$pres->fecha_presupuesto;
				$lastPres=$this->Model_ET_Presupuesto_Analitico->insertar($pres_data);
			}

			$responsable=$this->Model_ET_Responsable->ETResponsablePorIdET($idExpedienteTecnico);
			foreach ($responsable as $resp) 
			{
				$resp_data['id_et']=$lastExpediente;
				$resp_data['id_persona']=$resp->id_persona;
				$resp_data['id_tipo_responsable_et']=$resp->id_tipo_responsable_et;
				$resp_data['id_cargo']=$resp->id_cargo;
				$resp_data['num_registro_prof']=$resp->num_registro_prof;
				$resp_data['fecha_asignacion_resp_et']=$resp->fecha_asignacion_resp_et;
				$resp_data['estado_responsable_et']=$resp->estado_responsable_et;
				$resp_data['fecha_inicio']=$resp->fecha_inicio;
				$resp_data['fecha_fin']=$resp->fecha_fin;
				$lastResp=$this->Model_ET_Responsable->insertar($resp_data);
			}

			$imagen=$this->Model_ET_Img->ListarImagen($idExpedienteTecnico);
			foreach ($imagen as $img) 
			{
				$data_img['id_et']=$lastExpediente;
				$data_img['desc_img']=$img->desc_img;
				$lastImg=$this->Model_ET_Img->insertarImgExpediente($data_img);

				if(file_exists('./uploads/ImageExpediente/'.$img->id_img.''.$img->desc_img))
				{
					copy('./uploads/ImageExpediente/'.$img->id_img.''.$img->desc_img, './uploads/ImageExpediente/'.$lastImg.''.$img->desc_img);
				}
			}

			$componente=$this->Model_ET_Componente->ETComponentePorIdET($idExpedienteTecnico);
			foreach ($componente as $comp) 
			{
				$comp_data['id_et']=$lastExpediente;
				$comp_data['descripcion']=$comp->descripcion;
				$comp_data['numeracion']=$comp->numeracion;
				$comp_data['id_presupuesto_ej']=$comp->id_presupuesto_ej;
				$comp_data['estado']=$comp->estado;
				$comp_data['url']=$comp->url;
				$comp_data['tipo_ejecucion']=$comp->tipo_ejecucion;
				$comp_data['monto']=$comp->monto;
				$comp_data['porcentaje']=$comp->porcentaje;
				$lastComponente=$this->Model_ET_Componente->insertarComponente($comp_data);
				
				$meta=$this->Model_ET_Meta->ETMetaPorIdComponente($comp->id_componente);
				foreach($meta as $item)
				{
					$meta_data['id_componente']=$lastComponente;
					$meta_data['desc_meta']=$item->desc_meta;
					$meta_data['numeracion']=$item->numeracion;
					$meta_data['url']=$item->url;
					$lastMeta=$this->Model_ET_Meta->insertarMeta($meta_data);
					$this->obtenerMetaAnidadaParaClonacionModificatoria($item, $lastMeta, $lastExpediente);
				}
			}

			$this->Model_ET_Expediente_Tecnico->updateAprobacion(1,$idExpedienteTecnico);

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se creó la Modificatoria de Expediente Tecnico satisfactoriamente', 'id_et' => $lastExpediente]);exit;
		}

	}

	private function obtenerMetaAnidadaParaClonacion($meta, $lastMeta, $lastExpediente)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;		

		$idUltimo=$lastMeta;

		foreach ($meta->childMeta as $item) 
		{
			$meta_data['id_meta_padre']=$idUltimo;
			$meta_data['desc_meta']=$item->desc_meta;
			$meta_data['numeracion']=$item->numeracion;
			$meta_data['url']=$item->url;
			$lastMeta=$this->Model_ET_Meta->insertarMeta($meta_data);
			
			$this->obtenerMetaAnidadaParaClonacion($item, $lastMeta, $lastExpediente);
		}

		if(count($temp)==0)
		{
			$partida=$this->Model_ET_Partida->ETPartidaDetallePartidaPorIdMeta($meta->id_meta);
			foreach ($partida as $part) 
			{
				$part_data['id_meta']=$lastMeta;
				$part_data['id_unidad']=$part->id_unidad;
				$part_data['desc_partida']=$part->desc_partida;
				$part_data['rendimiento']=$part->rendimiento;
				$part_data['cantidad']=$part->cantidad;
				$part_data['id_lista_partida']=$part->id_lista_partida;
				$part_data['numeracion']=$part->numeracion;
				$part_data['url']=$part->url;
				$lastPartida=$this->Model_ET_Partida->insertarPartida($part_data);
				$det_data['id_partida']=$lastPartida;
				$det_data['id_unidad']=$part->id_unidad;
				$det_data['id_etapa_et']=$part->id_etapa_et;
				$det_data['rendimiento']=$part->rendimiento;
				$det_data['cantidad']=$part->cantidad;
				$det_data['precio_unitario']=$part->precio_unitario;
				$det_data['estado']=$part->estado;
				$det_data['especificacion_tecnica']=$part->especificacion_tecnica;
				$det_data['parcial']=$part->parcial;
				$lastDetallePartida=$this->Model_ET_Detalle_Partida->insertarDetallePartida($det_data);

				$analisisUnitario=$this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetalle($part->id_detalle_partida);				
				foreach($analisisUnitario as $analisis)
				{
					if($analisis->id_analitico){
						$presupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoPorIdAnalitico($analisis->id_analitico);
						$tempPresupestoAnalitico=$this->Model_ET_Presupuesto_Analitico->verificarPresupuestoAnaliticoTipoClasi($lastExpediente,$presupuestoAnalitico[0]->id_clasificador, $presupuestoAnalitico[0]->id_presupuesto_ej);
						$au_data['id_analitico']=$tempPresupestoAnalitico[0]->id_analitico;
					} else {
						$au_data['id_analitico']=$analisis->id_analitico;
					}
					$au_data['id_recurso']=$analisis->id_recurso;
					$au_data['id_detalle_partida']=$lastDetallePartida;
					$lastAnalisisUnitario=$this->Model_ET_Analisis_Unitario->insertar($au_data);
					
					$detalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisPorIdAnalisis($analisis->id_analisis);
					foreach($detalleAnalisisUnitario as $detalle)
					{
						$detuni_data['id_analisis']=$lastAnalisisUnitario;
						$detuni_data['id_unidad']=$detalle->id_unidad;
						$detuni_data['desc_detalle_analisis']=$detalle->desc_detalle_analisis;
						$detuni_data['cuadrilla']=$detalle->cuadrilla;
						$detuni_data['cantidad']=$detalle->cantidad;
						$detuni_data['precio_unitario']=$detalle->precio_unitario;
						$detuni_data['rendimiento']=$detalle->rendimiento;
						$lastDetalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->insertarDetalleAnalisisUnitario($detuni_data);
					}
				}

				$mesValorizacion=$this->Model_ET_Mes_Valorizacion->ETMesValorizacionPorIdDetallePartida($part->id_detalle_partida);				
				foreach($mesValorizacion as $valor)
				{
					$mes_data['id_detalle_partida']=$lastDetallePartida;
					$mes_data['numero_mes']=$valor->numero_mes;
					$mes_data['cantidad']=$valor->cantidad;
					$mes_data['precio']=$valor->precio;
					$lastValorizacion=$this->Model_ET_Mes_Valorizacion->insertarMesValorizacion($mes_data);
				}
			}
		}
	}

	private function obtenerMetaAnidadaParaClonacionModificatoria($meta, $lastMeta, $lastExpediente)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;		

		$idUltimo=$lastMeta;

		foreach ($meta->childMeta as $item) 
		{
			$meta_data['id_meta_padre']=$idUltimo;
			$meta_data['desc_meta']=$item->desc_meta;
			$meta_data['numeracion']=$item->numeracion;
			$meta_data['url']=$item->url;
			$lastMeta=$this->Model_ET_Meta->insertarMeta($meta_data);
			
			$this->obtenerMetaAnidadaParaClonacionModificatoria($item, $lastMeta, $lastExpediente);
		}

		if(count($temp)==0)
		{
			$partida=$this->Model_ET_Partida->ETPartidaDetallePartidaPorIdMeta($meta->id_meta);
			foreach ($partida as $part) 
			{
				$part_data['id_meta']=$lastMeta;
				$part_data['id_unidad']=$part->id_unidad;
				$part_data['desc_partida']=$part->desc_partida;
				$part_data['rendimiento']=$part->rendimiento;
				$part_data['cantidad']=$part->cantidad;
				$part_data['id_lista_partida']=$part->id_lista_partida;
				$part_data['numeracion']=$part->numeracion;
				$part_data['url']=$part->url;
				$lastPartida=$this->Model_ET_Partida->insertarPartida($part_data);
				$det_data['id_partida']=$lastPartida;
				$det_data['id_unidad']=$part->id_unidad;
				$det_data['id_etapa_et']=$part->id_etapa_et;
				$det_data['rendimiento']=$part->rendimiento;
				$det_data['cantidad']=$part->cantidad;
				$det_data['precio_unitario']=$part->precio_unitario;
				$det_data['estado']=$part->estado;
				$det_data['especificacion_tecnica']=$part->especificacion_tecnica;
				$det_data['parcial']=$part->parcial;
				$lastDetallePartida=$this->Model_ET_Detalle_Partida->insertarDetallePartida($det_data);

				$analisisUnitario=$this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetalle($part->id_detalle_partida);				
				foreach($analisisUnitario as $analisis)
				{
					if($analisis->id_analitico){
						$presupuestoAnalitico=$this->Model_ET_Presupuesto_Analitico->ETPresupuestoPorIdAnalitico($analisis->id_analitico);
						$tempPresupestoAnalitico=$this->Model_ET_Presupuesto_Analitico->verificarPresupuestoAnaliticoTipoClasi($lastExpediente,$presupuestoAnalitico[0]->id_clasificador, $presupuestoAnalitico[0]->id_presupuesto_ej);
						$au_data['id_analitico']=$tempPresupestoAnalitico[0]->id_analitico;
					} else {
						$au_data['id_analitico']=$analisis->id_analitico;
					}
					$au_data['id_recurso']=$analisis->id_recurso;
					$au_data['id_detalle_partida']=$lastDetallePartida;
					$lastAnalisisUnitario=$this->Model_ET_Analisis_Unitario->insertar($au_data);
					
					$detalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisPorIdAnalisis($analisis->id_analisis);
					foreach($detalleAnalisisUnitario as $detalle)
					{
						$detuni_data['id_analisis']=$lastAnalisisUnitario;
						$detuni_data['id_unidad']=$detalle->id_unidad;
						$detuni_data['desc_detalle_analisis']=$detalle->desc_detalle_analisis;
						$detuni_data['cuadrilla']=$detalle->cuadrilla;
						$detuni_data['cantidad']=$detalle->cantidad;
						$detuni_data['precio_unitario']=$detalle->precio_unitario;
						$detuni_data['rendimiento']=$detalle->rendimiento;
						$lastDetalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->insertarDetalleAnalisisUnitario($detuni_data);
					}
				}

				$mesValorizacion=$this->Model_ET_Mes_Valorizacion->ETMesValorizacionPorIdDetallePartida($part->id_detalle_partida);				
				foreach($mesValorizacion as $valor)
				{
					$mes_data['id_detalle_partida']=$lastDetallePartida;
					$mes_data['numero_mes']=$valor->numero_mes;
					$mes_data['cantidad']=$valor->cantidad;
					$mes_data['precio']=$valor->precio;
					$lastValorizacion=$this->Model_ET_Mes_Valorizacion->insertarMesValorizacion($mes_data);
				}

				$cronogramaEjecucion=$this->Model_ET_Cronograma_Ejecucion->ETCronogramaEjecucionPorIdDetallePartida($part->id_detalle_partida);				
				foreach($cronogramaEjecucion as $cronograma)
				{
					$cronograma_data['id_detalle_partida']=$lastDetallePartida;
					$cronograma_data['numero_mes']=$cronograma->numero_mes;
					$cronograma_data['anio']=$cronograma->anio;
					$cronograma_data['cantidad']=$cronograma->cantidad;
					$cronograma_data['precio']=$cronograma->precio;
					$lastCronogramaEjecucion=$this->Model_ET_Cronograma_Ejecucion->insertar($cronograma_data);
				}

				$detValorizacion=$this->Model_DetSegOrden->listarValorizacionPorDetallePartida($part->id_detalle_partida);				
				foreach($detValorizacion as $detValor)
				{
					$lastDetValorizacion=$this->Model_DetSegOrden->insertar($detValor->etapa_valorizacion, $detValor->fecha, $detValor->cantidad, $detValor->sub_total, $detValor->fecha_dia, $lastDetallePartida, $detValor->descripcion);
				}
			}
		}
	}

	public function clonar()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
			$idEtapaExpedienteTecnico=$this->input->post('idEtapaExpedienteTecnico');
			$txtUrlDocAprobacion=$this->input->post('url');
			$txtFechaAprobacion=$this->input->post('txtFechaAprobacion');

			if($idExpedienteTecnico!=null && $idEtapaExpedienteTecnico!=null)
			{
				$this->db->trans_start();

				$etExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

				if($etExpedienteTecnico->estado_revision!=1)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Aún no se ha dado el visto bueno a este expediente técnico para proceder con el pase de etapa.']);exit;
				}

				if($etExpedienteTecnico->id_etapa_et==$idEtapaExpedienteTecnico)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico para la misma etapa.']);exit;
				}

				if($this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorIdETPadre($etExpedienteTecnico->id_et)!=null)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar dos veces de un mismo expediente técnico.']);exit;
				}

				$listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

				foreach($listaETComponente as $key => $value)
				{
					$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

					foreach($listaETMeta as $index => $item)
					{
						if($this->analisisUnitarioSinAnalitico($item))
						{
							echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico porque existen análisis unitarios sin asignación de analítico.']);exit;
						}
					}
				}

				if($this->input->post('url')!='')
				{
					$config['upload_path']   = './uploads/ResolucioExpediente/';
					$config['allowed_types'] = '*';
					$config['max_size']      = 50000;
					$config['encrypt_name']  = false;
					$config['file_name'] =$idExpedienteTecnico;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('fileResolucion');

					$this->Model_ET_Expediente_Tecnico->AprobarExpediente($txtUrlDocAprobacion, $txtFechaAprobacion, $idExpedienteTecnico);
				}

				$this->Model_ET_Expediente_Tecnico->clonar($etExpedienteTecnico->id_et, $idEtapaExpedienteTecnico);

				$this->Model_ET_Expediente_Tecnico->updateAprobacion(1,$idExpedienteTecnico);

				$idUltimoExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->UltimoExpedienteTecnico()->id_et;

				$listaETImgOrigen=$this->Model_ET_Img->ListarImagen($etExpedienteTecnico->id_et);
				$listaETImgDestino=$this->Model_ET_Img->ListarImagen($idUltimoExpedienteTecnico);

				foreach($listaETImgOrigen as $key => $value)
				{
					$nombreImgTemp=$listaETImgDestino[$key]->id_img.'.'.(explode('.', $value->desc_img)[count(explode('.', $value->desc_img))-1]);

					$this->Model_ET_Img->updateDescImagePorIdImg($listaETImgDestino[$key]->id_img, $nombreImgTemp);

					if(file_exists('./uploads/ImageExpediente/'.$value->desc_img))
					{
						copy('./uploads/ImageExpediente/'.$value->desc_img, './uploads/ImageExpediente/'.$nombreImgTemp);
					}
				}

				if(file_exists('./uploads/ResolucioExpediente/'.$etExpedienteTecnico->id_et.'.'.$etExpedienteTecnico->url_doc_aprobacion_et))
				{
					copy('./uploads/ResolucioExpediente/'.$etExpedienteTecnico->id_et.'.'.$etExpedienteTecnico->url_doc_aprobacion_et, './uploads/ResolucioExpediente/'.$idUltimoExpedienteTecnico.'.'.$etExpedienteTecnico->url_doc_aprobacion_et);
				}

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Clonación de expediente en la etapa seleccionada realizado correctamente.']);exit;
			}
		}
		else
		{
			$listaETEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucion_Listar('R');

			$idExpedienteTecnico= $this->input->get('idExpedienteTecnico');

			$ExpedienteTecnico = $this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

			$fechaAprobacion = '';

			if($ExpedienteTecnico->url_doc_aprobacion_et!=null && $ExpedienteTecnico->fecha_aprobacion != null)
			{
				$fechaAprobacion = $ExpedienteTecnico->fecha_aprobacion;
			}

			return $this->load->view('front/Ejecucion/ExpedienteTecnico/modalParaClonar', ['idExpedienteTecnico' => $idExpedienteTecnico, 'listaETEtapaEjecucion' => $listaETEtapaEjecucion,'fechaAprobacion' => $fechaAprobacion]);
		}
	}

	public function crearModificatoria()
	{
		if($_POST)
		{
			$idExpedienteTecnico=$this->input->post('idExpedienteTecnico');
			$idEtapaExpedienteTecnico=$this->input->post('idEtapaExpedienteTecnico');
			$txtUrlDocAprobacion=$this->input->post('url');
			$txtFechaAprobacion=$this->input->post('txtFechaAprobacion');

			if($idExpedienteTecnico!=null && $idEtapaExpedienteTecnico!=null)
			{
				$this->db->trans_start();

				$etExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

				if($etExpedienteTecnico->estado_revision!=1)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Aún no se ha dado el visto bueno a este expediente técnico para proceder con el pase de etapa.']);exit;
				}

				if($etExpedienteTecnico->id_etapa_et==$idEtapaExpedienteTecnico)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico para la misma etapa.']);exit;
				}

				if($this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorIdETPadre($etExpedienteTecnico->id_et)!=null)
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar dos veces de un mismo expediente técnico.']);exit;
				}

				$listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, 2, 'EXPEDIENTETECNICO');

				foreach($listaETComponente as $key => $value)
				{
					$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

					foreach($listaETMeta as $index => $item)
					{
						if($this->analisisUnitarioSinAnalitico($item))
						{
							echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede clonar expediente técnico porque existen análisis unitarios sin asignación de analítico.']);exit;
						}
					}
				}

				if($this->input->post('url')!='')
				{
					$config['upload_path']   = './uploads/ResolucioExpediente/';
					$config['allowed_types'] = '*';
					$config['max_size']      = 50000;
					$config['encrypt_name']  = false;
					$config['file_name'] =$idExpedienteTecnico;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('fileResolucion');

					$this->Model_ET_Expediente_Tecnico->AprobarExpediente($txtUrlDocAprobacion, $txtFechaAprobacion, $idExpedienteTecnico);
				}

				$this->Model_ET_Expediente_Tecnico->clonarModificatoria($etExpedienteTecnico->id_et, $idEtapaExpedienteTecnico);

				$this->Model_ET_Expediente_Tecnico->updateAprobacion(1,$idExpedienteTecnico);

				$idUltimoExpedienteTecnico=$this->Model_ET_Expediente_Tecnico->UltimoExpedienteTecnico()->id_et;

				$listaETImgOrigen=$this->Model_ET_Img->ListarImagen($etExpedienteTecnico->id_et);
				$listaETImgDestino=$this->Model_ET_Img->ListarImagen($idUltimoExpedienteTecnico);

				foreach($listaETImgOrigen as $key => $value)
				{
					$nombreImgTemp=$listaETImgDestino[$key]->id_img.'.'.(explode('.', $value->desc_img)[count(explode('.', $value->desc_img))-1]);

					$this->Model_ET_Img->updateDescImagePorIdImg($listaETImgDestino[$key]->id_img, $nombreImgTemp);

					if(file_exists('./uploads/ImageExpediente/'.$value->desc_img))
					{
						copy('./uploads/ImageExpediente/'.$value->desc_img, './uploads/ImageExpediente/'.$nombreImgTemp);
					}
				}

				if(file_exists('./uploads/ResolucioExpediente/'.$etExpedienteTecnico->id_et.'.'.$etExpedienteTecnico->url_doc_aprobacion_et))
				{
					copy('./uploads/ResolucioExpediente/'.$etExpedienteTecnico->id_et.'.'.$etExpedienteTecnico->url_doc_aprobacion_et, './uploads/ResolucioExpediente/'.$idUltimoExpedienteTecnico.'.'.$etExpedienteTecnico->url_doc_aprobacion_et);
				}

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Clonación de expediente en la etapa seleccionada realizado correctamente.']);exit;
			}
		}
		else
		{
			$listaETEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucion_Listar('R');

			$idExpedienteTecnico= $this->input->get('idExpedienteTecnico');

			$ExpedienteTecnico = $this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

			$fechaAprobacion = '';

			if($ExpedienteTecnico->url_doc_aprobacion_et!=null && $ExpedienteTecnico->fecha_aprobacion != null)
			{
				$fechaAprobacion = $ExpedienteTecnico->fecha_aprobacion;
			}

			return $this->load->view('front/Ejecucion/ExpedienteTecnico/modalParaCrearModificatoria', ['idExpedienteTecnico' => $idExpedienteTecnico, 'listaETEtapaEjecucion' => $listaETEtapaEjecucion,'fechaAprobacion' => $fechaAprobacion]);
		}
	}

	private function analisisUnitarioSinAnalitico($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{
				if(count($this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdPartidaFromDetallePartida($value->id_partida))>0)
				{
					return true;
				}
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			if($this->analisisUnitarioSinAnalitico($value))
			{
				return true;
			}
		}

		return false;
	}

	public function verdetalle()
	{
		$id_et = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$ExpedienteAprobado=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnicoPorId($id_et);

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

		$aprobado = 0;

		if($ExpedienteAprobado[0]->aprobado==1)
		{
			$ExpedienteTecnicoElaboracion=$this->Model_ET_Expediente_Tecnico->ExpedienteAprobado(1,$id_et);
			$aprobado=1;
		}
		else
		{
			$ExpedienteTecnicoElaboracion=$this->Model_ET_Expediente_Tecnico->ExpedienteListarElaboracionPorId($id_et);
		}
		$et_documentos_f01 = $this->Model_ET_Expediente_Tecnico->getETDocumento($id_et,1);
		$et_documentos_f08 = $this->Model_ET_Expediente_Tecnico->getETDocumento($id_et,8);
		$et_documentos_f09 = $this->Model_ET_Expediente_Tecnico->getETDocumento($id_et,9);
		$et_documentos_f09B = $this->Model_ET_Expediente_Tecnico->getETDocumento($id_et,99);

		$listaContraActual = $this->Model_ET_Expediente_Tecnico->ListarExpedientePorEtapaProyecto(3,$ExpedienteAprobado[0]->id_pi);
		$listaModificatoria = $this->Model_ET_Expediente_Tecnico->ListarExpedientePorEtapaProyecto(10,$ExpedienteAprobado[0]->id_pi);
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/verdetalle',['aprobado'=>$aprobado, 'ExpedienteTecnicoElaboracion'=>$ExpedienteTecnicoElaboracion, 'et_documentos_f01' => $et_documentos_f01,'et_documentos_f08' => $et_documentos_f08,'et_documentos_f09' => $et_documentos_f09,'et_documentos_f09B' => $et_documentos_f09B, 'listaContraActual' => $listaContraActual, 'listaModificatoria' => $listaModificatoria]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function CalcularNumeroMeses()
	{
		$fechaInicio = $this->input->post('txtFecha1');
		$fechaFin = $this->input->post('txtFecha2');
		$ts1 = strtotime($fechaInicio);
		$ts2 = strtotime($fechaFin);
		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);
		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);
		$numerodemeses = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
		echo json_encode(['numerodemeses' => $numerodemeses]); exit;

	}

	public function ListarPartida($id_et)
	{
		$listaPartida = $this->Model_ET_Expediente_Tecnico->listarPartidaporEt($id_et);
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/ExpedienteTecnico/listarpartida',['listaPartida' => $listaPartida]);
		$this->load->view('layout/Ejecucion/footer');
	}

	public function AsignarOrden()
	{
		if ($_POST)
		{
			$idPartida=$this->input->post('hdIdPartida');
			$numeroOrden=$this->input->post('txtNumeroOrden');
			$concepto=$this->input->post('txtConceptoOrden');
			$data = $this->Model_DetSegOrden->insertar($idPartida,$numeroOrden,$concepto);
			if ($data==true)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			$idPartida=$this->input->get('id_partida');
			$partida=$this->Model_ET_Expediente_Tecnico->DetallePartida($idPartida);
			$listaOrden = $this->Model_DetSegOrden->listarOrdenPorPartida($idPartida);
			$this->load->view('front/Ejecucion/ExpedienteTecnico/asignarorden',['partida' => $partida,'listaOrden' =>$listaOrden ]);
		}
	}

	public function registroBuscarMeta()
    {
    	$CodigoUnico=$this->input->get('txtCodigoUnico');
		$txtOrden=$this->input->get('inputValue');
		$listaAcumuladoMeta = $this->Model_DetSegOrden->listarAcumuladoMeta($CodigoUnico);
		$ultimaMeta = '';
		$anio = date('Y');
		foreach ($listaAcumuladoMeta as $key => $value)
		{
			if ($value->ano_eje == $anio)
			{
				$ultimaMeta = $value->meta;
			}
		}
		$orden = $this->Model_DetSegOrden->buscarOrden($anio,$ultimaMeta,$txtOrden);
		echo json_encode($orden);
	}
	
    public function ControlMetrado()
    {
    	$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : '';
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($expedienteTecnico->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/ejecucion');
			}
        }

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et,2,'EXPEDIENTETECNICO');

			$expedienteTecnico->childComponenteAdicional=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et,2,'ADICIONAL');

			$countValorizacionDiaria  = $this->Model_DetSegOrden->sumatoriaValorizacion();

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacion($item);
				}
			}

			foreach($expedienteTecnico->childComponenteAdicional as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);
				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacion($item);
				}
			}

			$this->load->view('layout/Ejecucion/header');
			$this->load->view('front/Ejecucion/EControlMetrado/controlmetrado', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida,'countValorizacionDiaria' => $countValorizacionDiaria]);
			$this->load->view('layout/Ejecucion/footer');
		}
	}

    public function AsignarValorizacion()
	{
		if ($_POST)
		{
			$etapa=$this->input->post('selectEtapaValorizacion');

			$idDetallePartida=$this->input->post('hdIdDetallePartida');

			$cantidad=$this->input->post('txtCantidad');

			$descripcion=$this->input->post('txtDescripcion');

			$subtotal=floatval(str_replace(",", "", $this->input->post('txtCosto')));

			$fechadia=$this->input->post('txtFecha');

			$fecha = date('Y-m-d H:i:s');

			if($etapa=='valorizacion')
			{
				$DetallePartida = $this->Model_ET_Detalle_Partida->ETPDetallePartida($idDetallePartida);

				$sumatoria = $this->Model_DetSegOrden->sumatoriaAcumuladoValorizado($idDetallePartida, 'valorizacion');

				if(($sumatoria[0]->acumulado+$cantidad)>$DetallePartida->cantidad)
				{
					$mayorMetrado = ($sumatoria[0]->acumulado+$cantidad) - $DetallePartida->cantidad;

					$valorizacionNormal = $cantidad - $mayorMetrado;

					$precioUnitario = 0;

					if($cantidad!=0)
					{
						$precioUnitario = $subtotal/$cantidad;
					}

					if($valorizacionNormal!=0)
					{
						$data = $this->Model_DetSegOrden->insertar('valorizacion', $fecha, $valorizacionNormal, $valorizacionNormal*$precioUnitario, $fechadia,$idDetallePartida,$descripcion);
					}

					$dataMayorMetrado = $this->Model_DetSegOrden->insertar('mayor metrado', $fecha, $mayorMetrado, $mayorMetrado*$precioUnitario, $fechadia,$idDetallePartida,$descripcion);

					$q1 = $this->Model_DetSegOrden->sumatoriaValorizacionPartida($idDetallePartida);

					$acumulado = $q1[0]->acumulado;

					$msg=(["proceso" => "Correcto", "mensaje" => "Se registro '$valorizacionNormal' valoriacion normal  y '$mayorMetrado' como mayor metrado", "acumulado" => $acumulado]);

					echo json_encode($msg);exit;
				}
				else
				{
					$data = $this->Model_DetSegOrden->insertar($etapa, $fecha, $cantidad, $subtotal, $fechadia,$idDetallePartida,$descripcion);
				}
			}
			else
			{
				$data = $this->Model_DetSegOrden->insertar($etapa, $fecha, $cantidad, $subtotal, $fechadia,$idDetallePartida,$descripcion);
			}

			$q1 = $this->Model_DetSegOrden->sumatoriaValorizacionPartida($idDetallePartida);

			$acumulado = $q1[0]->acumulado;

			$msg=($data!='' ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado correctamente', 'acumulado' => $acumulado]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));

			echo json_encode($msg);exit;
		}
		else
		{
			$fechaActual=date('Y-m-d');

			$idDetallePartida=$this->input->get('id_DetallePartida');

			$idExpedienteTecnico=$this->input->get('idExpediente');

			$DetallePartida = $this->Model_ET_Detalle_Partida->ETPDetallePartida($idDetallePartida);
			$listaValorizacion = $this->Model_DetSegOrden->listarValorizacionPorDetallePartida($idDetallePartida);
			$cantidadDetalleTotal=0;
			$costoDetalleTotal=0;
			foreach ($listaValorizacion as $key => $value)
			{
				$cantidadDetalleTotal+=$value->cantidad;
				$costoDetalleTotal+=$value->sub_total;
			}
			$cantidadRestante=$DetallePartida->cantidad-$cantidadDetalleTotal;
			$costoRestante=$DetallePartida->parcial-$costoDetalleTotal;
			$this->load->view('front/Ejecucion/EControlMetrado/valorizacionpartida', ['DetallePartida' => $DetallePartida, 'fecha' => $fechaActual, 'listaValorizacion' => $listaValorizacion,'idExpedienteTecnico' => $idExpedienteTecnico,'cantidadRestante'=>$cantidadRestante,'costoRestante'=>$costoRestante]);
		}
	}

	public function eliminarValorizacionPartida()
	{
		$id_detSegValorizacion =$this->input->get('idDetSegValorizacion');
		$data = $this->Model_DetSegOrden->eliminar($id_detSegValorizacion);
		if ($data==true)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	public function ValorizacionFisicaMetrado()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : '';
		$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');
		$anio = isset($_GET['anio']) ? $_GET['anio'] : date('Y');
		$mostrar = isset($_GET['mostrar']) ? true : false;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($expedienteTecnico->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/ejecucion');
			}
        }

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

			$meses = $this->listaMeses();

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacionFisica($item,$mes,$anio,'valorizacion');
				}
			}
			$this->load->view('layout/Ejecucion/header');
			$this->load->view('front/Ejecucion/EControlMetrado/valorizacionfisica', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida, 'listaMeses' =>$meses, 'mes'=>$mes, 'anio'=>$anio, 'mostrar'=>$mostrar]);
			$this->load->view('layout/Ejecucion/footer');
		}
	}

	public function reportePdfValorizacionFisica()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$mesActual =  strftime("%B");
		$mes = $this->mes($mesActual);

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacionFisica($item, date('m'), date('Y'),'valorizacion');
				}
			}

			// $this->load->view('front/Ejecucion/EControlMetrado/reportepdfvalorizacionfisica', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida , 'mes' => $mes]);
			
			$html = $this->load->view('front/Ejecucion/EControlMetrado/reportepdfvalorizacionfisica', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida , 'mes' => $mes],true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper("A4", "landscape");
			$this->mydompdf->render();
			$this->mydompdf->stream("reporteValorizacionFisica.pdf", array("Attachment" => false));
		}
	}

	public function reportePdfValorizacionMayorMetrado()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$mesActual =  strftime("%B");
		$mes = $this->mes($mesActual);

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacionFisica($item, date('m'), date('Y'),'mayor metrado');
				}
			}

			$html = $this->load->view('front/Ejecucion/EControlMetrado/reportePdfValorizacionMayorMetrado', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida , 'mes' => $mes],true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper("A4", "landscape");
			$this->mydompdf->render();
			$this->mydompdf->stream("reporteValorizacionMayorMetrado.pdf", array("Attachment" => false));
		}
	}

	public function reportePdfValorizacionDeductivo()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$mesActual =  strftime("%B");
		$mes = $this->mes($mesActual);

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacionFisica($item, date('m'), date('Y'),'deductivo');
				}
			}

			$html = $this->load->view('front/Ejecucion/EControlMetrado/reportePdfValorizacionDeductivo', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida , 'mes' => $mes],true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper("A4", "landscape");
			$this->mydompdf->render();
			$this->mydompdf->stream("reporteValorizacionDeductivo.pdf", array("Attachment" => false));
		}
	}

	public function reportePdfValorizacionFisicaAdicionales()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);
		$mesActual =  strftime("%B");
		$mes = $this->mes($mesActual);

		if($expedienteTecnico->id_etapa_et == 1)
		{
			show_404();
		}
		else
		{
			$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'ADICIONAL');

			foreach($expedienteTecnico->childComponente as $key => $value)
			{
				$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

				foreach($value->childMeta as $index => $item)
				{
					$this->obtenerMetaAnidadaParaValorizacionFisica($item, date('m'), date('Y'),'valorizacion');
				}
			}

			$html = $this->load->view('front/Ejecucion/EControlMetrado/reportepdfvalorizacionfisicaAdicional', ['expedienteTecnico' => $expedienteTecnico, 'listaUnidadMedida' => $listaUnidadMedida , 'mes' => $mes],true);
			$this->mydompdf->load_html($html);
			$this->mydompdf->set_paper("A4", "landscape");
			$this->mydompdf->render();
			$this->mydompdf->stream("reporteValorizacionAdicionalFisica.pdf", array("Attachment" => false));
		}
	}

	public function InformeMensual()
	{
		if($_GET)
		{
			$idEt = $this->input->get('idExpedienteTecnico');
			$proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idEt);
			$metaPresupuestal=$this->Model_Dashboard_Reporte->ConsultaMetaProyecto($proyectoInversion->codigo_unico_pi);
			$meses = $this->listaMeses();
			$this->load->view('layout/Ejecucion/header');
			$this->load->view('front/Ejecucion/InformeMensual/index',['idEt'=>$idEt, 'metaPresupuestal'=>$metaPresupuestal, 'mes'=>$meses]);
			$this->load->view('layout/Ejecucion/footer');
		}
	}

	public function formatoFE11()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE11', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function formatoFE12()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE12', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function formatoFE13()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE13', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function formatoFE14()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE14', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function formatoFE15()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE15', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function formatoFE16()
	{
		$idExpedienteTecnico = isset($_GET['id_et']) ? $_GET['id_et'] : null;

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($idExpedienteTecnico);

		$this->load->view('front/Ejecucion/Formato/formatoFE16', ['expedienteTecnico' => $expedienteTecnico]);

	}

	public function ReporteEstadistico()
	{
		$id_et = isset($_GET['id_et']) ? $_GET['id_et'] : null;
		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($id_et);

		$tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario!=9 && $tipoUsuario!=1)
        {
        	$data=$this->UsuarioProyecto_model->ProyectoAsignado($expedienteTecnico->id_pi);
        	if(count($data)==0)
			{
				$this->session->set_flashdata('error', 'Usted no tiene acceso a este Expediente Tecnico');
				redirect('Expediente_Tecnico/index');
			}
        }

		$expedienteTecnico->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, 2, 'EXPEDIENTETECNICO');
		foreach($expedienteTecnico->childComponente as $key => $value)
		{
			$value->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($value->childMeta as $index => $item)
			{
				$this->obtenerMetaAnidadaParaValorizacion($item);
			}
		}
		$this->load->view('layout/Ejecucion/header');
		$this->load->view('front/Ejecucion/Reporte/estadisticasejecucion', ['expedienteTecnico' => $expedienteTecnico]);
		$this->load->view('layout/Ejecucion/footer');
	}

	private function obtenerMetaAnidadaParaValorizacionFisica($meta,$mes,$anio,$etapa)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);
			foreach($meta->childPartida as $key => $value)
			{
				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartidaParaValorizacion($value->id_partida);

				$value->childDetallePartida->childDetSegValorizacion=$this->Model_DetSegOrden->valorizadaActual($value->childDetallePartida->id_detalle_partida, $mes, $anio, $etapa);

				$value->childDetallePartida->childDetSegValorizacionAnterior=$this->Model_DetSegOrden->valorizadoAnterior($value->childDetallePartida->id_detalle_partida, $mes, $anio, $etapa);

				$value->childDetallePartida->childDetSegValorizacionDescripcion=$this->Model_DetSegOrden->valorizacionDescripcion($value->childDetallePartida->id_detalle_partida, $mes, $anio, $etapa);
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaParaValorizacionFisica($value, $mes, $anio,$etapa);
		}
	}

	public function insertActaEntregaTerreno() {
		if ($this->input->is_ajax_request())
		{
				$id_et = $_POST['id_et'];
				// $nombreArchivo = $_FILES['inputFileDoc']['name'];
				//
				// $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

				$nombreArchivo = trim(addslashes($_FILES['inputFileDocF01']['name']));

				$path_parts = pathinfo($nombreArchivo);

				$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '.' . $path_parts['extension'] );

				$this->db->trans_start();

				$c_data['filename']= $nombreArchivo;
				$c_data['id_et']=$id_et;
				$c_data['tipo']=1;

				$ultimoId = $this->Model_ET_Expediente_Tecnico->insertETDocumento($c_data);

				if($nombreArchivo != '' || $nombreArchivo != null)
				{
						$config['upload_path'] = './uploads/ActaDeEntrega/';
						$config['allowed_types'] = '*';
						// $config['max_size'] = 50000;
						// $config['max_width'] = 2000;
						$config['max_height'] = '20048';
						$config['file_name'] = $nombreArchivo;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload('inputFileDocF01'))
						{
								$error = array('error' => $this->upload->display_errors());
								$this->load->view('front/json/json_view',['datos' => $error]);
						}
				}

				$this->db->trans_complete();

				$msg = array();

				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
				$this->load->view('front/json/json_view', ['datos' => $msg]);
		}
		else
		{
				show_404();
		}
	}

	public function insertDesagregadoGastos() {
		if ($this->input->is_ajax_request())
		{
				$id_et = $_POST['id_et'];
				// $nombreArchivo = $_FILES['inputFileDoc']['name'];
				//
				// $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

				$nombreArchivo = trim(addslashes($_FILES['inputFileDocF08']['name']));

				$path_parts = pathinfo($nombreArchivo);

				$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '.' . $path_parts['extension'] );

				$this->db->trans_start();

				$c_data['filename']= $nombreArchivo;
				$c_data['id_et']=$id_et;
				$c_data['tipo']=8;

				$ultimoId = $this->Model_ET_Expediente_Tecnico->insertETDocumento($c_data);

				if($nombreArchivo != '' || $nombreArchivo != null)
				{
						$config['upload_path'] = './uploads/DesagregadoGastos/';
						$config['allowed_types'] = '*';
						// $config['max_size'] = 50000;
						// $config['max_width'] = 2000;
						$config['max_height'] = '20048';
						$config['file_name'] = $nombreArchivo;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload('inputFileDocF08'))
						{
								$error = array('error' => $this->upload->display_errors());
								$this->load->view('front/json/json_view',['datos' => $error]);
						}
				}

				$this->db->trans_complete();

				$msg = array();

				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
				$this->load->view('front/json/json_view', ['datos' => $msg]);
		}
		else
		{
				show_404();
		}
	}
	public function insertDesagregadoGastosSupervision() {
		if ($this->input->is_ajax_request())
		{
				$id_et = $_POST['id_et'];
				// $nombreArchivo = $_FILES['inputFileDoc']['name'];
				//
				// $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

				$nombreArchivo = trim(addslashes($_FILES['inputFileDocF09']['name']));

				$path_parts = pathinfo($nombreArchivo);

				$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '.' . $path_parts['extension'] );

				$this->db->trans_start();

				$c_data['filename']= $nombreArchivo;
				$c_data['id_et']=$id_et;
				$c_data['tipo']=9;

				$ultimoId = $this->Model_ET_Expediente_Tecnico->insertETDocumento($c_data);

				if($nombreArchivo != '' || $nombreArchivo != null)
				{
						$config['upload_path'] = './uploads/DesagregadoGastos/';
						$config['allowed_types'] = '*';
						// $config['max_size'] = 50000;
						// $config['max_width'] = 2000;
						$config['max_height'] = '20048';
						$config['file_name'] = $nombreArchivo;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload('inputFileDocF09'))
						{
								$error = array('error' => $this->upload->display_errors());
								$this->load->view('front/json/json_view',['datos' => $error]);
						}
				}

				$this->db->trans_complete();

				$msg = array();

				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
				$this->load->view('front/json/json_view', ['datos' => $msg]);
		}
		else
		{
				show_404();
		}
	}
	public function insertDesagregadoGastosLiquidacion() {
		if ($this->input->is_ajax_request())
		{
				$id_et = $_POST['id_et'];
				// $nombreArchivo = $_FILES['inputFileDoc']['name'];
				//
				// $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

				$nombreArchivo = trim(addslashes($_FILES['inputFileDocF09B']['name']));

				$path_parts = pathinfo($nombreArchivo);

				$nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '.' . $path_parts['extension'] );

				$this->db->trans_start();

				$c_data['filename']= $nombreArchivo;
				$c_data['id_et']=$id_et;
				$c_data['tipo']=99;

				$ultimoId = $this->Model_ET_Expediente_Tecnico->insertETDocumento($c_data);

				if($nombreArchivo != '' || $nombreArchivo != null)
				{
						$config['upload_path'] = './uploads/DesagregadoGastos/';
						$config['allowed_types'] = '*';
						// $config['max_size'] = 50000;
						// $config['max_width'] = 2000;
						$config['max_height'] = '20048';
						$config['file_name'] = $nombreArchivo;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload('inputFileDocF09B'))
						{
								$error = array('error' => $this->upload->display_errors());
								$this->load->view('front/json/json_view',['datos' => $error]);
						}
				}

				$this->db->trans_complete();

				$msg = array();

				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
				$this->load->view('front/json/json_view', ['datos' => $msg]);
		}
		else
		{
				show_404();
		}
	}

	private function Mes($mes)
	{
		$mesenespaniol = '';
		if ($mes=="January") $mesenespaniol="Enero";
		if ($mes=="February") $mesenespaniol="Febrero";
		if ($mes=="March") $mesenespaniol="Marzo";
		if ($mes=="April") $mesenespaniol="Abril";
		if ($mes=="May") $mesenespaniol="Mayo";
		if ($mes=="June") $mesenespaniol="Junio";
		if ($mes=="July") $mesenespaniol="Julio";
		if ($mes=="August") $mesenespaniol="Agosto";
		if ($mes=="September") $mesenespaniol="Setiembre";
		if ($mes=="October") $mesenespaniol="Octubre";
		if ($mes=="November") $mesenespaniol="Noviembre";
		if ($mes=="December") $mesenespaniol="Diciembre";
		return $mesenespaniol;
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
	public function listarBds10()
	{
		$CodigoUnico = $this->input->post("CodigoUnico");
        $listaPresupuesto = $this->db->query("select 'subpresupuesto' as SubPresupuesto, p.codpresupuesto as Codigo,p.descripcion as Descripcion,i.descripcion as Cliente,  
		p.Fecha,p.Plazo,p.Jornada,p.fechaproceso as Fecha_Proceso, p.CostoDirectoBase1 as Costo_Directo_Base, p.CostoIndirectoBase1 as Costo_Indirecto_Base,
		p.CostoBase1 as Costo_Base, p.CostodirectoOferta1 as Costo_Directo_Oferta, p.CostoIndirectoOferta1 as Costo_Indirecto_Oferta, p.CostoOferta1 as Costo_Oferta,
		p.CostodirectoOfertatotal1 as Costo_Directo_Oferta_Total, p.CostoIndirectoOfertaTotal1 as Costo_Indirecto_Oferta_Total, p.CostoOfertaTotal1 as Costo_Oferta_Total
		from ([".$CodigoUnico."].dbo.presupuesto p inner join [".$CodigoUnico."].dbo.identificador i
		ON p.codidentificador=i.codidentificador)");
        $nuevoarray=$listaPresupuesto->result();
		foreach($nuevoarray as $valor){
			$subPresupuesto= $this->db->query("select p.Fecha, p.codpresupuesto as CodigoPresupuesto,p.descripcion  AS DescripcionPresupuesto,sp.codsubpresupuesto as CodSubpresupuesto,sp.descripcion AS Descripcion
			from [".$CodigoUnico."].[dbo].presupuesto p inner join  [".$CodigoUnico."].[dbo].subpresupuesto sp 
			ON p.codpresupuesto=sp.codpresupuesto where p.Nivel=3 and sp.codsubpresupuesto!='999' and p.codpresupuesto='".$valor->Codigo."'");
				$valor->SubPresupuesto=$subPresupuesto->result();
		}
		
		echo json_encode($nuevoarray);exit;
	}
	public function HojaPresupuesto()
	{	
		$CodigoUnico = $this->input->post("CodigoUnico");
		$CodigoPresupuesto = $this->input->post("CodigoPresupuesto");
		$CodigoSubPresupuesto = $this->input->post("CodigoSubPresupuesto");
        $listaHoja = $this->db->query("select spd.codpresupuesto,spd.codsubpresupuesto,spd.secuencial,spd.nivel,spd.orden,t.Descripcion as titulos,p.descripcion as partida,u.simbolo, 
		spd.metrado, spd.precio1 as Precio, spd.parcial1 as Parcial, spd.Tipo,spd.codtitulo,spd.codpartida,(spd.codpresupuesto+' '+spd.propiopartida) as Codigo
		,p.Jornada,spd.ManodeObra1 as Mano_Obra,spd.Material1 as Materiales,spd.Equipo1 as Equipos,spd.subcontrato1 as Subcontratos,spd.subpartida1 as Subpartidas,
		p.Horashombrepartida as Productividadhh,p.HorasMaquinaPotencia as Productividadhm,p.RendimientoMO as Rendimiento_MO,p.rendimientoEQ as Rendimiento_EQ ,p.peso,p.precio1 as Precio_Unitario
		from (([".$CodigoUnico."].dbo.subpresupuestodetalle spd inner JOIN [".$CodigoUnico."].dbo.titulo t
		on spd.codtitulo=t.codtitulo)
		LEFT join [".$CodigoUnico."].dbo.partida p
		on spd.codpartida=p.codpartida) left join [".$CodigoUnico."].dbo.unidad u on p.codunidad=u.codunidad
		where spd.codpresupuesto='".$CodigoPresupuesto."' and (p.PropioPartida='01' or p.PropioPartida='99') and  spd.codsubpresupuesto='".$CodigoSubPresupuesto."' and(p.codpresupuesto='".$CodigoPresupuesto."' or p.codpartida='999999999999') 
		order by spd.orden,spd.secuencial");

		foreach($listaHoja->result() as $valor){
			$sumaManoObra = $this->db->query("select sum(ppa.Parcial1) AS Mano_Obra 
			from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
			on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
			ON i.codinsumo=ppa.codinsumo
			where pd.codpresupuesto='".$CodigoPresupuesto."' and pd.codpartida='".$valor->codpartida."' and ppa.codpresupuesto='".$CodigoPresupuesto."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."'
			and ppa.codpartida='".$valor->codpartida."' and ppa.tipo=1");
	
			$sumaMateriales = $this->db->query("select sum(ppa.Parcial1) AS Materiales from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
			on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
			ON i.codinsumo=ppa.codinsumo
			where pd.codpresupuesto='".$CodigoPresupuesto."' and pd.codpartida='".$valor->codpartida."' and ppa.codpresupuesto='".$CodigoPresupuesto."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."'
			and ppa.codpartida='".$valor->codpartida."' and ppa.tipo=2");
	
			$sumaEquipos = $this->db->query("select sum(ppa.Parcial1) AS Equipos from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
			on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
			ON i.codinsumo=ppa.codinsumo
			where pd.codpresupuesto='".$CodigoPresupuesto."' and pd.codpartida='".$valor->codpartida."' and ppa.codpresupuesto='".$CodigoPresupuesto."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."'
			and ppa.codpartida='".$valor->codpartida."' and ppa.tipo=3");
			$valor->Mano_Obra=$sumaManoObra->result()[0]->Mano_Obra;
			$valor->Materiales=$sumaMateriales->result()[0]->Materiales;
			$valor->Equipos=$sumaEquipos->result()[0]->Equipos;
		}
	
		echo json_encode($listaHoja->result());exit;
	}
	public function ImprimirReporte()
	{	
		$CodigoUnico = $this->input->post("CodigoUnico");
		$CodigoPresupuesto = $this->input->post("CodigoPresupuesto");
		$CodigoSubPresupuesto = $this->input->post("CodigoSubPresupuesto");
		$imprimir = $this->db->query("select spd.codpresupuesto,spd.codsubpresupuesto,spd.secuencial,spd.nivel,spd.orden,p.descripcion as partida,u.simbolo, 
		spd.Tipo,p.RendimientoMO as Rendimiento_MO,p.rendimientoEQ as Rendimiento_EQ ,
		p.precio1 as Precio_Unitario,pd.codpartida,i.codinsumo,i.descripcion,ppa.tipo,ppa.unidad,pd.cuadrilla,ppa.cantidad,
		ppa.precio1 as Precio,ppa.parcial1 as Parcial
		from ((((([".$CodigoUnico."].dbo.subpresupuestodetalle spd inner JOIN [".$CodigoUnico."].dbo.titulo t
		on spd.codtitulo=t.codtitulo)	LEFT join [".$CodigoUnico."].dbo.partida p
		on spd.codpartida=p.codpartida) left join [".$CodigoUnico."].dbo.unidad u 
		on p.codunidad=u.codunidad) inner join [".$CodigoUnico."].dbo.partidadetalle pd
		on (spd.codpresupuesto=pd.codpresupuesto and spd.codpartida=pd.codpartida )) inner join [".$CodigoUnico."].dbo.insumo i
		on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
		ON (i.codinsumo=ppa.codinsumo and spd.codpartida=ppa.codpartida and spd.codpartida=ppa.codpartida)
		where spd.codpresupuesto='".$CodigoPresupuesto."' and spd.codsubpresupuesto='".$CodigoSubPresupuesto."' and (p.codpresupuesto='".$CodigoPresupuesto."' or p.codpartida='999999999999')
		and pd.CodPresupuesto='".$CodigoPresupuesto."' and ppa.CodPresupuesto='".$CodigoPresupuesto."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."'  
		and spd.tipo=1 
		order by spd.orden,spd.secuencial,ppa.tipo");
		echo json_encode($imprimir->result());exit;
	}
	public function costoUnitario()
	{	
		$CodigoUnico = $this->input->post("CodigoUnico");
		$CodigoPresupuesto = $this->input->post("CodigoPresupuesto");
		$CodigoSubPresupuesto = $this->input->post("CodigoSubPresupuesto");
		$CodigoPartida = $this->input->post("CodigoPartida");
        $costoUnitario = $this->db->query("select pd.codpresupuesto,ppa.codsubpresupuesto,pd.codpartida,i.codinsumo,(case i.descripcion when 'REGISTRO RESTRINGIDO' then (select Descripcion from [".$CodigoUnico."].dbo.Partida where CodPresupuesto='".$CodigoPresupuesto."' and CodSubpresupuesto='".$CodigoSubPresupuesto."' and CodPartida=pd.CodPartidaR and PropioPartida='01') else i.descripcion end) as descripcion,ppa.tipo,ppa.unidad,pd.cuadrilla,ppa.cantidad,ppa.precio1 as Precio,ppa.parcial1 as Parcial 
		from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
		on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
		ON i.codinsumo=ppa.codinsumo and pd.CodPartidaR=ppa.CodPartidaR
		where pd.codpresupuesto='".$CodigoPresupuesto."' and pd.codpartida='".$CodigoPartida."' and ppa.codpresupuesto='".$CodigoPresupuesto."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."'
		and ppa.codpartida='".$CodigoPartida."' and pd.PropioPartida=(select top 1 max(pd.PropioPartida) 
		from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
		on pd.codinsumo=i.codinsumo ) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
		ON i.codinsumo=ppa.codinsumo and pd.CodPartidaR=ppa.CodPartidaR
	   where pd.codpresupuesto='".$CodigoPresupuesto."' and pd.codpartida='".$CodigoPartida."' and 
	   ppa.codpartida='".$CodigoPartida."' and ppa.codsubpresupuesto='".$CodigoSubPresupuesto."' and ppa.codpresupuesto='".$CodigoPresupuesto."'
	   group by pd.PropioPartida order by pd.PropioPartida desc)");
		echo json_encode($costoUnitario->result());exit;
	}

		function insertarResponsableElaboracion()
    {
        if($_POST)
        {
            $msg = array();
            $hdIdExpediente=$this->input->post("hdET");
						// obtener id_tipo_responsable Elaboracion
						$id_tipo_responsableElabo='2';
						$comboResponsableElaboracion =$this->input->post('comboResponsableElaboracion');
						$comboCargoElaboracion =$this->input->post('comboCargoElaboracion');
						if($comboResponsableElaboracion!='')
						{
							$responsable= $this->Model_ET_Responsable->ResponsableIdETPersonaElaboracion($hdIdExpediente,$comboResponsableElaboracion);
							if(count($responsable)>0){
								$msg =(['proceso' => 'Error', 'mensaje' => 'Responsable ya se encuentra registrado en la elaboración de expediente']);
								echo json_encode($msg);exit;
							}
						  else{
								$this->Model_ET_Responsable->insertarET_Epediente($hdIdExpediente,$comboResponsableElaboracion,$id_tipo_responsableElabo,$comboCargoElaboracion);
								$msg = (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']);
								echo json_encode($msg);exit;
							}
						}
						else{
							$msg =(['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']);
							echo json_encode($msg);exit;
						}               
            
            echo json_encode($msg);exit;
        }
        if($_GET)
        {
            $id_et=$this->input->get('id_et');
						$listarCargo=$this->Cargo_Modal->getcargo();
						$listarPersona=$this->Model_Personal->listarPersona();
            $this->load->view('front/Ejecucion/ExpedienteTecnico/insertarResponsableElaboracion', ['listarCargo'=>$listarCargo,'listarPersona'=>$listarPersona,'id_et'=>$id_et]);
        }        
    }

		function insertarResponsableEjecucion()
    {
        if($_POST)
        {
            $msg = array();
            $hdIdExpediente=$this->input->post("hdET");
						// obtener id_tipo_responsable Ejecucion
						$id_tipo_responsableElabo='3';
						$comboResponsableEjecucion =$this->input->post('comboResponsableEjecucion');
						$comboCargoEjecucion =$this->input->post('comboCargoEjecucion');
						$fechaInicio =$this->input->post('txtFechaInicio');
						$fechaFin =$this->input->post('txtFechaFin');
						if($comboResponsableEjecucion!='')
						{
							$responsable= $this->Model_ET_Responsable->ResponsableIdETPersonaEjecucion($hdIdExpediente,$comboResponsableEjecucion);
							if(count($responsable)>0){
								$msg =(['proceso' => 'Error', 'mensaje' => 'Responsable ya se encuentra registrado en la ejecución']);
								echo json_encode($msg);exit;
							}
						  else{
								$this->Model_ET_Responsable->insertarET_EpedienteEjecucion($hdIdExpediente,$comboResponsableEjecucion,$id_tipo_responsableElabo,$comboCargoEjecucion,$fechaInicio,$fechaFin);
								$msg = (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']);
								echo json_encode($msg);exit;
							}
						}
						else{
							$msg =(['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']);
							echo json_encode($msg);exit;
						}               
            
            echo json_encode($msg);exit;
        }
        if($_GET)
        {
            $id_et=$this->input->get('id_et');
						$listarCargo=$this->Cargo_Modal->getcargo();
						$listarPersona=$this->Model_Personal->listarPersona();
            $this->load->view('front/Ejecucion/ExpedienteTecnico/insertarResponsableEjecucion', ['listarCargo'=>$listarCargo,'listarPersona'=>$listarPersona,'id_et'=>$id_et]);
        }        
    }

	public function listarResponsableElaboracion()
    {
        if ($this->input->is_ajax_request())
        {
            $id_et = $this->input->post("id_et");
            $data  = $this->Model_ET_Responsable->ResponsableEtapa($id_et,'2');
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

		public function listarResponsableEjecucion()
    {
        if ($this->input->is_ajax_request())
        {
            $id_et = $this->input->post("id_et");
            $data  = $this->Model_ET_Responsable->ResponsableEtapa($id_et,'3');
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

		function eliminarResponsableElaboracion()
    {
        $msg = array();
        $data = $this->Model_ET_Responsable->eliminar($this->input->post("id_responsable_et"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
		
}
