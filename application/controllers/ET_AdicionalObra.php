<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_AdicionalObra extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_ET_Expediente_Tecnico');
		$this->load->model('Model_ET_Presupuesto_Ejecucion');
		$this->load->model('Model_ET_Componente');
		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Analisis_Unitario');
		$this->load->model('Model_ET_Detalle_Analisis_Unitario');
		$this->load->model('Model_Unidad_Medida');
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
			$c_data['estado']="ADICIONAL";

			$ultimoIdComponente=$this->Model_ET_Componente->insertarComponente($c_data);

			$this->updateNumerationComponentPresupuestoEjecucion($this->input->post('idET'),$this->input->post('idPresupuestoEjecucion'),'ADICIONAL');	

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Componente registrado correctamente.', 'idComponente' => $ultimoIdComponente]);exit;		

		}

		$expedienteTecnico=$this->Model_ET_Expediente_Tecnico->ExpedienteTecnico($this->input->get('idExpedienteTecnico'));

		$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

		$PresupuestoEjecucion=$this->Model_ET_Presupuesto_Ejecucion->ListaPresupuestoEjecucion();

		$expedienteTecnico->childPresupuestoEjecucion=$PresupuestoEjecucion;

		foreach ($expedienteTecnico->childPresupuestoEjecucion as $key => $value) 
		{
			$value->childComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($expedienteTecnico->id_et, $value->id_presupuesto_ej, 'ADICIONAL');

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

		$this->load->view('front/Ejecucion/ETAdicionalObra/insertar.php', ['expedienteTecnico'=>$expedienteTecnico, 'listaUnidadMedida'=>$listaUnidadMedida,'listaPartidaNivel1'=>$listaPartidaNivel1, 'PresupuestoEjecucion'=>$PresupuestoEjecucion]);
	}

	public function resolucionComponente()
	{
		if($_POST)
		{
			$componente=$this->Model_ET_Componente->ETComponentePorIdComponente($this->input->post("hdIdComponente")); 

			$this->db->trans_start();

			if (file_exists("uploads/ResolucionAdicional/ResolucionComponente/".$this->input->post("hdIdComponente").$componente->url))
			{
				unlink("uploads/ResolucionAdicional/ResolucionComponente/".$this->input->post("hdIdComponente").$componente->url);
			}
			
			$config['upload_path'] = './uploads/ResolucionAdicional/ResolucionComponente/';			
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $this->input->post('hdIdComponente');
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('fileResolucionComponente'))
			{
				$u_data['url']= $this->upload->data('file_ext');

				$data = $this->Model_ET_Componente->editar($this->input->post('hdIdComponente'),$u_data);

				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Resolución de Aprobación guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			}
			else
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
			}

			$this->db->trans_complete();

			echo json_encode($msg);exit;
		}

		$idComponente=$this->input->get('idComponente');

		$componente=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);

		$this->load->view('front/Ejecucion/ETAdicionalObra/resolucionComponente',['componente'=>$componente]);
	}

	public function resolucionMeta()
	{
		if($_POST)
		{
			$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($this->input->post("hdIdMeta")); 

			$this->db->trans_start();

			if (file_exists("uploads/ResolucionAdicional/ResolucionMeta/".$this->input->post("hdIdMeta").$meta->url))
			{
				unlink("uploads/ResolucionAdicional/ResolucionMeta/".$this->input->post("hdIdMeta").$meta->url);
			}
			
			$config['upload_path'] = './uploads/ResolucionAdicional/ResolucionMeta/';			
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $this->input->post('hdIdMeta');
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('fileResolucionMeta'))
			{
				$u_data['url']= $this->upload->data('file_ext');

				$data = $this->Model_ET_Meta->editar($this->input->post('hdIdMeta'),$u_data);

				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Resolución de Aprobación guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			}
			else
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
			}

			$this->db->trans_complete();

			echo json_encode($msg);exit;
		}

		$idMeta=$this->input->get('idMeta');

		$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($idMeta);

		$this->load->view('front/Ejecucion/ETAdicionalObra/resolucionMeta',['meta'=>$meta]);
	}

	public function resolucionPartida()
	{
		if($_POST)
		{
			$partida=$this->Model_ET_Partida->ETPartidaPorIdPartida($this->input->post("hdIdPartida")); 

			$this->db->trans_start();

			if (file_exists("uploads/ResolucionAdicional/ResolucionPartida/".$this->input->post("hdIdPartida").$partida->url))
			{
				unlink("uploads/ResolucionAdicional/ResolucionPartida/".$this->input->post("hdIdPartida").$partida->url);
			}
			
			$config['upload_path'] = './uploads/ResolucionAdicional/ResolucionPartida/';			
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $this->input->post('hdIdPartida');
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('fileResolucionPartida'))
			{
				$u_data['url']= $this->upload->data('file_ext');

				$data = $this->Model_ET_Partida->editar($this->input->post('hdIdPartida'),$u_data);

				$msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Resolución de Aprobación guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
			}
			else
			{
				$msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
			}

			$this->db->trans_complete();

			echo json_encode($msg);exit;
		}

		$idPartida=$this->input->get('idPartida');

		$partida=$this->Model_ET_Partida->ETPartidaPorIdPartida($idPartida);

		$this->load->view('front/Ejecucion/ETAdicionalObra/ResolucionPartida',['partida'=>$partida]);
	}
}