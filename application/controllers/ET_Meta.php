<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Meta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Meta');
		$this->load->model('Model_ET_Partida');
		$this->load->model('Model_ET_Componente');
	}

	public function insertar()
	{
		$this->db->trans_start();

		$idComponente=$this->input->post('idComponente');
		$idMetaPadre=$this->input->post('idMetaPadre');
		$descripcionMeta=$this->input->post('descripcionMeta');

		if(count($this->Model_ET_Meta->ETMetaPorIdComponenteOrIdMetaPadreAndDescMeta($idComponente, $idMetaPadre, $descripcionMeta))>0)
		{
			$this->db->trans_rollback();

			echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede agregar dos metas iguales en el mismo nivel.']);exit;
		}

		if($idComponente=='' && count($this->Model_ET_Partida->ETPartidaPorIdMeta($idMetaPadre))>0)
		{
			$this->db->trans_rollback();

			echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se puede agregar submeta al mismo nivel que una partida.']);exit;
		}

		$this->Model_ET_Meta->insertar(($idComponente=='' ? null : $idComponente), ($idMetaPadre=='' ? null : $idMetaPadre), $descripcionMeta,'');

		$ultimoIdMeta=$this->Model_ET_Meta->ultimoId();

		$this->updateNumerationMeta($idComponente=='' ? null : $idComponente, $idMetaPadre=='' ? null : $idMetaPadre);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Meta registrada correctamente.', 'idMeta' => $ultimoIdMeta]);exit;
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

	public function editarDescMeta()
	{
		$idMeta=$this->input->post('idMeta');
		$descripcionMeta=$this->input->post('descripcionMeta');

		$etMetaTemp=$this->Model_ET_Meta->ETMetaPorIdMeta($idMeta);

		if($this->Model_ET_Meta->existsDiffIdMetaAndSameDescripcion($etMetaTemp->id_componente, $idMeta, $etMetaTemp->id_meta_padre, $descripcionMeta))
		{
			$this->db->trans_rollback();

			echo json_encode(['proceso' => 'Error', 'mensaje' => 'Nombre de la meta existente.']);exit;
		}

		$this->Model_ET_Meta->updateDescMeta($idMeta, trim($descripcionMeta));

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Cambios guardados correctamente.']);exit;
	}

	public function eliminar()
	{
		if($_POST)
		{
			$this->db->trans_start();

			$idMeta=$this->input->post('idMeta');

			$meta=$this->Model_ET_Meta->ETMetaPorIdMeta($idMeta);

			$this->eliminarMetaAnidada($meta);

			$this->updateNumerationMeta($meta->id_componente=='' ? null : $meta->id_componente, $meta->id_meta_padre=='' ? null : $meta->id_meta_padre);

			$this->db->trans_complete();

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Meta eliminada correctamente.']);exit;
		}

		$this->load->view('Front/Ejecucion/ETPartida/insertar');
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
			$this->Model_ET_Partida->eliminarPorIdMeta($meta->id_meta);
		}

		$this->Model_ET_Meta->eliminar($meta->id_meta);
	}
}