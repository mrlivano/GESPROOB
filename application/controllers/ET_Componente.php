<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Componente extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_Unidad_Medida');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Analisis_Unitario');
		$this->load->model('Model_ET_Presupuesto_Ejecucion');
		$this->load->model('Model_ET_Etapa_Ejecucion');
		$this->load->model('Model_ET_Analitico_Partida');
	}

	private function updateNumerationComponentPresupuestoEjecucion($idExpedienteTecnico, $idPresupuestoEjecucion, $estado)
	{
		$numberRoman=[0 => 'I', 1 => 'II', 2 => 'III', 3 => 'IV', 4 => 'V', 5 => 'VI', 6 => 'VII', 7 => 'VIII', 8 => 'IX', 9 => 'X', 10 => 'XI', 11 => 'XII', 12 => 'XIII', 13 => 'XIV', 14 => 'XV', 15 => 'XVI', 16 => 'XVII', 17 => 'XVIII', 18 => 'XIX', 19 => 'XX', 20 => 'XXI', 21 => 'XXII', 22 => 'XXIII', 23 => 'XXIV', 24 => 'XXV', 25 => 'XXVI', 26 => 'XXVII', 27 => 'XXVIII', 28 => 'XXIX', 29 => 'XXX', 30 => 'XXXI', 31 => 'XXXII', 32 => 'XXXIII', 33 => 'XXXIV', 34 => 'XXXV', 35 => 'XXXVI', 36 => 'XXXVII', 37 => 'XXXVIII', 38 => 'XXXIX', 39 => 'XL', 40 => 'XLI', 41 => 'XLII', 42 => 'XLIII', 43 => 'XLIV', 44 => 'XLV', 45 => 'XLVI', 46 => 'XLVII', 47 => 'XLVIII', 48 => 'XLIX', 49 => 'L', 50 => 'LI', 51 => 'LII', 52 => 'LIII', 53 => 'LIV', 54 => 'LV', 55 => 'LVI', 56 => 'LVII', 57 => 'LVIII', 58 => 'LIX', 59 => 'LX', 60 => 'LXI', 61 => 'LXII', 62 => 'LXIII', 63 => 'LXIV', 64 => 'LXV', 65 => 'LXVI', 66 => 'LXVII', 67 => 'LXVIII', 68 => 'LXIX', 69 => 'LXX', 70 => 'LXXI', 71 => 'LXXII', 72 => 'LXXIII', 73 => 'LXXIV', 74 => 'LXXV', 75 => 'LXXVI', 76 => 'LXXVII', 77 => 'LXXVIII', 78 => 'LXXIX', 79 => 'LXXX', 80 => 'LXXXI', 81 => 'LXXXII', 82 => 'LXXXIII', 83 => 'LXXXIV', 84 => 'LXXXV', 85 => 'LXXXVI', 86 => 'LXXXVII', 87 => 'LXXXVIII', 88 => 'LXXXIX', 89 => 'XC', 90 => 'XCI', 91 => 'XCII', 92 => 'XCIII', 93 => 'XCIV', 94 => 'XCV', 95 => 'XCVI', 96 => 'XCVII', 97 => 'XCVIII', 98 => 'XCIX', 99 => 'C'];

		$listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, $idPresupuestoEjecucion, $estado);

		foreach($listaETComponente as $key => $value)
		{
			$this->Model_ET_Componente->updateNumeracionPorIdComponente($value->id_componente, $numberRoman[$key]);

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, ($key+1).'.'.($index+1));

				$this->updateNumerationMetaAndChild($item, ($key+1).'.'.($index+1));
			}
		}
	}

	private function updateNumerationMetaAndChild($meta, $numeracionMetaActual)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;

		if(count($temp)==0)
		{
			$meta->childPartida=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

			foreach($meta->childPartida as $key => $value)
			{
				$this->Model_ET_Partida->updateNumeracionPorIdPartida($value->id_partida, $numeracionMetaActual.'.'.($key+1));
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->Model_ET_Meta->updateNumeracionPorIdMeta($value->id_meta, $numeracionMetaActual.'.'.($key+1));

			$this->updateNumerationMetaAndChild($value, $numeracionMetaActual.'.'.($key+1));
		}
	}

	public function insertar()
	{
		if($_POST)
		{
			$this->db->trans_start();

			if(count($this->Model_ET_Componente->ETComponentePorIdETAndDescripcion($this->input->post('idET'), $this->input->post('idPresupuestoEjecucion'), $this->input->post('idPresupuestoEjecucion')))>0)
			{
				$this->db->trans_rollback();

				echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede agregar dos veces el mismo componente.']);exit;
			}

			$c_data['id_et']=$this->input->post('idET');
			$c_data['descripcion']=$this->input->post('descripcionComponente');
			$c_data['id_presupuesto_ej']=$this->input->post('idPresupuestoEjecucion');
			$c_data['estado']="EXPEDIENTETECNICO";

			$ultimoIdComponente=$this->Model_ET_Componente->insertarComponente($c_data);

			$this->updateNumerationComponentPresupuestoEjecucion($this->input->post('idET'),$this->input->post('idPresupuestoEjecucion'),'EXPEDIENTETECNICO');	

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Componente registrado correctamente.', 'idComponente' => $ultimoIdComponente]);exit;
		}

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));
		
		$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

		$PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

		$expedienteTecnico->childPresupuestoEjecucion=$PresupuestoEjecucion;

		foreach ($expedienteTecnico->childPresupuestoEjecucion as $key => $value) 
		{
			$value->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, $value->id_presupuesto_ej, 'EXPEDIENTETECNICO');

			foreach($value->childComponente as $key => $item)
			{
				$item->childMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($item->id_componente);

				foreach($item->childMeta as $index => $temp)
				{
					$temp->nivel = substr_count($temp->numeracion, '.'); 
					$this->obtenerMetaAnidada($temp);
				}
			}
		}		

		$listaPartidaNivel1 = $this->Model_Unidad_Medida->listaPartidaNivel1();

		foreach ($listaPartidaNivel1 as $key => $value) 
		{
			$value->hasChild = (count($this->Model_Unidad_Medida->listaPartidaNivel1($value->CodPartida, ($value->Nivel+1)))==0 ? false : true);
		}

		$selectPresupuesto = $this->Model_ET_Presupuesto_Ejecucion->listarPresupuesto($expedienteTecnico->codigo_unico_pi);

		$this->load->view('front/Ejecucion/ETComponente/insertar.php', ['expedienteTecnico'=>$expedienteTecnico, 'listaUnidadMedida'=>$listaUnidadMedida,'listaPartidaNivel1'=>$listaPartidaNivel1,'PresupuestoEjecucion'=>$PresupuestoEjecucion,"SelectPresupuesto"=>$selectPresupuesto]);
	}
	public function cargarSelectSubPresupuesto(){
		$Codigo_Presupuesto=$this->input->post('Codigo_Presupuesto');
		$Codigo_Proyecto=$this->input->post('Codigo_Proyecto');
		$selectSubPresupuesto = $this->Model_ET_Presupuesto_Ejecucion->listarComponente($Codigo_Proyecto,$Codigo_Presupuesto);
		echo json_encode(['data' => $selectSubPresupuesto]);exit;
	}

	public function editarDescComponente()
	{
		$idComponente=$this->input->post('idComponente');
		$descripcionComponente=$this->input->post('descripcionComponente');

		if($this->Model_ET_Componente->existsDiffIdComponenteAndSameDescripcion($idComponente, $descripcionComponente))
		{
			$this->db->trans_rollback();

			echo json_encode(['proceso' => 'Error', 'mensaje' => 'Nombre del componente existente.']);exit;
		}

		$this->Model_ET_Componente->updateDescComponente($idComponente, trim($descripcionComponente));

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Cambios guardados correctamente.']);exit;
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

			foreach($meta->childPartida as $key => $value)
			{
				$value->partidaCompleta=true;

				$value->childDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartidaPorIdPartida($value->id_partida);

				foreach($value->childDetallePartida as $index => $item)
				{
					$item->childAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ETClasificadorPorIdDetallePartida($item->id_detalle_partida);

					foreach($item->childAnalisisUnitario as $i => $v)
					{
						if($v->id_analitico==null)
						{
							$value->partidaCompleta=false;

							break 2;
						}
					}

					if(count($item->childAnalisisUnitario)==0)
					{
						$value->partidaCompleta=false;

						break;
					}
				}
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidada($value);
		}
	}

	public function eliminar()
	{
		$this->db->trans_start();

		$idComponente=$this->input->post('idComponente');
		$idPresupuestoEjecucion=$this->input->post('idPresupuestoEjecucion');

		$listaMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($idComponente);

		foreach($listaMeta as $key => $value)
		{
			$this->eliminarMetaAnidada($value);
		}

		$idExpedienteTecnico=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente)->id_et;

		$this->Model_ET_Componente->eliminar($idComponente);

		$this->updateNumerationComponentPresupuestoEjecucion($idExpedienteTecnico,$idPresupuestoEjecucion,'EXPEDIENTETECNICO');

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Componente eliminado correctamente.']);exit;
	}

	public function cargarNivel()
	{
		$codigoPartida=$this->input->post('codigoPartida');
		$nivel=$this->input->post('nivel');
		$data=$this->Model_Unidad_Medida->listaPartidaporNivel($codigoPartida, $nivel);

		foreach($data as $key => $value)
		{
			$value->hasChild=(count($this->Model_Unidad_Medida->listaPartidaporNivel($value->CodPartida, ($value->Nivel+1)))==0 ? false : true);
		}
		echo json_encode($data);exit;
	}

	private function eliminarMetaAnidada($meta)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		foreach($temp as $key => $value)
		{
			$this->eliminarMetaAnidada($value);
		}

		if(count($temp)==0)
		{
			$tempP=$this->Model_ET_Partida->mostrarPartidaPorIdMeta($meta->id_meta);
			foreach($tempP as $key => $valueP)
			{
				$this->Model_ET_Analisis_Unitario->eliminarCU($valueP->id_partida);
			}
			$this->Model_ET_Partida->eliminarPorIdMeta($meta->id_meta);
		}

		$this->Model_ET_Meta->eliminar($meta->id_meta);
	}

	public function cargarMetaS10(){
		$idSubpresupuesto=$this->input->post('idSubpresupuesto');
		$idComponente=$this->input->post('idComponente');
		$elementP = [];
		$metaSubpresupuesto = $this->Model_ET_Presupuesto_Ejecucion->listarMetaSubpresupuesto($idSubpresupuesto);
		foreach ($metaSubpresupuesto as $key => $value) {
			if($value->Cod_Titulo!='9999999'){
				if($value->Nivel===0){
					$idmeta = $this->insertarmetaS10($idComponente,'',$value->Titulo);
					$elementP[$value->Nivel]= $idmeta;
				} else {
					$idmeta = $this->insertarmetaS10('',$elementP[($value->Nivel-1)],$value->Titulo);
					$elementP[$value->Nivel]= $idmeta;
				}
			}
			else{
				$this->insertarPartidaS10($elementP[($value->Nivel-1)],$value->UnidadDesc,$value->Partida,$value->Rendimiento_MO,$value->Metrado,$value->Precio_Unitario);
				$idpartida = $this->db->insert_id();
				$costoUnitario = $this->Model_ET_Analisis_Unitario->listarCostoUnitario($value->Id);
				foreach ($costoUnitario as $key => $valueC) {
					//insertar costos unitarios
					$c_data['cod_insumo']=$valueC->Codigo_Insumo;
					$c_data['descripcion']=$valueC->Descripcion;
					$c_data['tipo']=$valueC->Tipo;
					$c_data['unidad']=$valueC->Unidad;
					$c_data['cuadrilla']=$valueC->Cuadrilla;
					$c_data['cantidad']=$valueC->Cantidad;
					$c_data['precio']=$valueC->Precio;
					$c_data['parcial']=$valueC->Parcial;
					$c_data['id_partida']=$idpartida;
					$idAnalisis = $this->Model_ET_Analisis_Unitario->insertarAnalisisCUS10($c_data);
				}
			}
		}
		echo json_encode(['data' => $metaSubpresupuesto]);exit;
	}

	public function insertarPartidaS10($idMeta, $unidad, $descripcionPartida, $rendimientoPartida, $cantidadPartida, $precioUnitarioPartida)
	{
		$this->db->trans_start();

		$idListaPartida=6;

		if($unidad!="")
		{
			$data = $this->Model_Unidad_Medida->validarInsumo($unidad);
			$idUnidad=$data->id_unidad;
		}

		$etEtapaEjecucion=$this->Model_ET_Etapa_Ejecucion->ETEtapaEjecucionPorDescEtaoaET('Elaboración de expediente técnico');

		$this->Model_ET_Partida->insertar($idMeta, $idUnidad, $idListaPartida, $descripcionPartida, $rendimientoPartida, $cantidadPartida);

		$unidadMedida=$this->Model_Unidad_Medida->UnidadMedida($idUnidad)[0];

		$ultimoIdPartida=$this->Model_ET_Partida->ultimoId();

		$this->Model_ET_Detalle_Partida->insertar($ultimoIdPartida, $idUnidad, $etEtapaEjecucion->id_etapa_et, $rendimientoPartida, $cantidadPartida, $precioUnitarioPartida, true);

		$ultimoIdDetallePartida=$this->Model_ET_Detalle_Partida->ultimoId();

		$listaETAnaliticoPartida=$this->Model_ET_Analitico_Partida->ETAnaliticoPartidaPorIdListaPartida($idListaPartida);

		foreach($listaETAnaliticoPartida as $key => $value)
		{
			$this->Model_ET_Analisis_Unitario->insertar('NULL', $value->id_recurso, $ultimoIdDetallePartida);

			$ultimoIdAnalisisUnitario=$this->Model_ET_Analisis_Unitario->ultimoId();

			$value->childETDetalleAnaliticoPartida=$this->Model_ET_Detalle_Analitico_Partida->ETDetalleAnaliticoPartidaPorIdAnaliticoPartida($value->id_analitico_partida);

			foreach($value->childETDetalleAnaliticoPartida as $index => $item)
			{
				$this->Model_ET_Detalle_Analisis_Unitario->insertar($ultimoIdAnalisisUnitario, $item->id_unidad, $item->desc_insumo, $item->cuadrilla, 1, $item->precio, $item->rendimiento);
			}
		}

		$ultimoETDetallePartida=$this->Model_ET_Detalle_Partida->ultimoETDetallePartida();

		$this->updateNumerationPartida($idMeta);

		$this->db->trans_complete();

		return true;
	}

	private function updateNumerationPartida($idMeta)
	{
		$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($idMeta);

		$listaETPartidaTemporal=$this->Model_ET_Partida->ETPartidaPorIdMeta($meta->id_meta);

		foreach($listaETPartidaTemporal as $key => $value)
		{
			$this->Model_ET_Partida->updateNumeracionPorIdPartida($value->id_partida, $meta->numeracion.'.'.($key+1));
		}
	}

	public function insertarmetaS10($idComponente,$idMetaPadre,$descripcionMeta)
	{
		$this->db->trans_start();

		$this->Model_ET_Meta->insertar(($idComponente=='' ? null : $idComponente), ($idMetaPadre=='' ? null : $idMetaPadre), $descripcionMeta);

		$ultimoIdMeta=$this->Model_ET_Meta->ultimoId();

		$this->updateNumerationMeta($idComponente=='' ? null : $idComponente, $idMetaPadre=='' ? null : $idMetaPadre);

		$this->db->trans_complete();

		return $ultimoIdMeta;
	}

	private function updateNumerationMeta($idComponente, $idMetaPadre)
	{
		if($idComponente!=null)
		{
			$numberFromRoman=['I' => 1, 'II' => 2, 'III' => 3, 'IV' => 4, 'V' => 5, 'VI' => 6, 'VII' => 7, 'VIII' => 8, 'IX' => 9, 'X' => 10, 'XI' => 11, 'XII' => 12, 'XIII' => 13, 'XIV' => 14, 'XV' => 15, 'XVI' => 16, 'XVII' => 17, 'XVIII' => 18, 'XIX' => 19, 'XX' => 20, 'XXI' => 21, 'XXII' => 22, 'XXIII' => 23, 'XXIV' => 24, 'XXV' => 25, 'XXVI' => 26, 'XXVII' => 27, 'XXVIII' => 28, 'XXIX' => 29, 'XXX' => 30, 'XXXI' => 31, 'XXXII' => 32, 'XXXIII' => 33, 'XXXIV' => 34, 'XXXV' => 35, 'XXXVI' => 36, 'XXXVII' => 37, 'XXXVIII' => 38, 'XXXIX' => 39, 'XL' => 40, 'XLI' => 41, 'XLII' => 42, 'XLIII' => 43, 'XLIV' => 44, 'XLV' => 45, 'XLVI' => 46, 'XLVII' => 47, 'XLVIII' => 48, 'XLIX' => 49, 'L' => 50, 'LI' => 51, 'LII' => 52, 'LIII' => 53, 'LIV' => 54, 'LV' => 55, 'LVI' => 56, 'LVII' => 57, 'LVIII' => 58, 'LIX' => 59, 'LX' => 60, 'LXI' => 61, 'LXII' => 62, 'LXIII' => 63, 'LXIV' => 64, 'LXV' => 65, 'LXVI' => 66, 'LXVII' => 67, 'LXVIII' => 68, 'LXIX' => 69, 'LXX' => 70, 'LXXI' => 71, 'LXXII' => 72, 'LXXIII' => 73, 'LXXIV' => 74, 'LXXV' => 75, 'LXXVI' => 76, 'LXXVII' => 77, 'LXXVIII' => 78, 'LXXIX' => 79, 'LXXX' => 80, 'LXXXI' => 81, 'LXXXII' => 82, 'LXXXIII' => 83, 'LXXXIV' => 84, 'LXXXV' => 85, 'LXXXVI' => 86, 'LXXXVII' => 87, 'LXXXVIII' => 88, 'LXXXIX' => 89, 'XC' => 90, 'XCI' => 91, 'XCII' => 92, 'XCIII' => 93, 'XCIV' => 94, 'XCV' => 95, 'XCVI' => 96, 'XCVII' => 97, 'XCVIII' => 98, 'XCIX' => 99, 'C' => 100];

			$etComponenteTemporal=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($idComponente);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, $numberFromRoman[$etComponenteTemporal->numeracion].'.'.($index+1));

				$this->updateNumerationMetaAndChild($item, $numberFromRoman[$etComponenteTemporal->numeracion].'.'.($index+1));
			}
		}
		else
		{
			$etMetaTemporal=$this->Model_ET_Meta->ETMetaPorIdMeta($idMetaPadre);

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($idMetaPadre);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, $etMetaTemporal->numeracion.'.'.($index+1));

				$this->updateNumerationMetaAndChild($item, $etMetaTemporal->numeracion.'.'.($index+1));
			}
		}
	}


}