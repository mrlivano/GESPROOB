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

		if($idComponente==''){
			$this->updateNumerationMeta($idComponente=='' ? null : $idComponente, $idMetaPadre=='' ? null : $idMetaPadre);
		} else {
			$etComponenteT=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);
			$this->updateNumerationComponentPresupuestoEjecucion($etComponenteT->id_et,$etComponenteT->id_presupuesto_ej,'EXPEDIENTETECNICO');
		}
		
		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Meta registrada correctamente.', 'idMeta' => $ultimoIdMeta]);exit;
	}

	private function updateNumerationComponentPresupuestoEjecucion($idExpedienteTecnico, $idPresupuestoEjecucion, $estado)
	{
		$listaETComponente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstado($idExpedienteTecnico, $idPresupuestoEjecucion, $estado);
		$indice = 1;
		foreach($listaETComponente as $key => $value)
		{
			$this->Model_ET_Componente->updateNumeracionPorIdComponente($value->id_componente, "");

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($value->id_componente);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, sprintf("%02d", $indice));
				$this->updateNumerationMetaAndChild($item, sprintf("%02d", $indice));
				$indice++;
			}
		}
	}

	private function updateNumerationMeta($idComponente, $idMetaPadre)
	{
		if($idComponente!=null)
		{
			$etComponenteTemporal=$this->Model_ET_Componente->ETComponentePorIdComponente($idComponente);

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdComponente($idComponente);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, sprintf("%02d",($index+1)));

				$this->updateNumerationMetaAndChild($item, sprintf("%02d",($index+1)));
			}
		}
		else
		{
			$etMetaTemporal=$this->Model_ET_Meta->ETMetaPorIdMeta($idMetaPadre);

			$listaETMeta=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($idMetaPadre);

			foreach($listaETMeta as $index => $item)
			{
				$this->Model_ET_Meta->updateNumeracionPorIdMeta($item->id_meta, $etMetaTemporal->numeracion.'.'.sprintf("%02d",($index+1)));

				$this->updateNumerationMetaAndChild($item, $etMetaTemporal->numeracion.'.'.sprintf("%02d",($index+1)));
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
				$this->Model_ET_Partida->updateNumeracionPorIdPartida($value->id_partida, $numeracionMetaActual.'.'. sprintf("%02d",($key+1)));
			}

			return false;
		}

		foreach($meta->childMeta as $key => $value)
		{
			$this->Model_ET_Meta->updateNumeracionPorIdMeta($value->id_meta, $numeracionMetaActual.'.'. sprintf("%02d",($key+1)));

			$this->updateNumerationMetaAndChild($value, $numeracionMetaActual.'.'. sprintf("%02d",($key+1)));
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