<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FE_Detalle_Presupuesto extends CI_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	$this->load->model('Model_FE_Presupuesto_Inv');
    	$this->load->model('Model_Unidad_Medida');
    	$this->load->model('Model_FE_Tipo_Gasto');
    	$this->load->model('Model_FE_Detalle_Presupuesto');
    	$this->load->model('Model_FE_Detalle_Gasto');
	}

	public function insertar()
	{
		if($_POST)
		{
			$idPresupuestoFE=$this->input->post('hdIdPresupuestoFE');
			$txtPorcentajeImprevistos=$this->input->post('txtPorcentajeImprevistos');
			$idsTipoGasto=$this->input->post('hdIdDetallePresupuesto');

			$this->Model_FE_Detalle_Presupuesto->EliminarPorIdPresupuestoFE($idPresupuestoFE);

			if($idsTipoGasto)
			{
				foreach($idsTipoGasto as $value)
				{
					$descripcionesDetalleGastoTemp=$this->input->post('descripcionDetalleGasto'.$value);
					$idsUnidadMedidaTemp=$this->input->post('idUnidadMedida'.$value);
					$cantidadesDetalleGastoTemp=$this->input->post('cantidadDetalleGasto'.$value);
					$costosUnitarioDetalleGastoTemp=$this->input->post('costoUnitarioDetalleGasto'.$value);
					$subTotalesDetalleGastoTemp=$this->input->post('subTotalDetalleGasto'.$value);

					$this->Model_FE_Detalle_Presupuesto->Insertar($idPresupuestoFE, $value);

					$ultimoIdDetallePresupuesto=$this->Model_FE_Detalle_Presupuesto->ObtenerUltimoIdDetallePresupuesto();

					if($descripcionesDetalleGastoTemp)
					{
						foreach($descripcionesDetalleGastoTemp as $key => $item)
						{
							$descripcioDetalleGastoTemp=$descripcionesDetalleGastoTemp[$key];
							$idUnidadMedidaTemp=$idsUnidadMedidaTemp[$key];
							$cantidadDetalleGastoTemp=$cantidadesDetalleGastoTemp[$key];
							$costoUnitarioDetalleGastoTemp=$costosUnitarioDetalleGastoTemp[$key];
							$subTotalDetalleGastoTemp=$subTotalesDetalleGastoTemp[$key];

							$this->Model_FE_Detalle_Gasto->Insertar($ultimoIdDetallePresupuesto, $descripcioDetalleGastoTemp, $idUnidadMedidaTemp, $cantidadDetalleGastoTemp, $costoUnitarioDetalleGastoTemp);
						}
					}
				}
			}

			$this->Model_FE_Presupuesto_Inv->EditarPorcentajeImprevistos($idPresupuestoFE, $txtPorcentajeImprevistos);

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos guardados correctamente.', 'idEstudioInversion' => $this->input->post('hdIdEstudioInversion')]);exit;
		}

		$idPresupuestoFE=$this->input->get('idPresupuestoFE');

		$fePresupuestoInv=$this->Model_FE_Presupuesto_Inv->FEPresupuestoInvPorIdPresupuestoFE($idPresupuestoFE);
		$listaTipoGasto=$this->Model_FE_Tipo_Gasto->ListarTipoGasto();
		$listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
		$listaFEDetallePresupuesto=$this->Model_FE_Detalle_Presupuesto->ListarPorIdPresupuestoFE($idPresupuestoFE);

		foreach($listaFEDetallePresupuesto as $key => $value)
		{
			$value->childFEDetalleGasto=$this->Model_FE_Detalle_Gasto->ListarPorIdDetallePresupuesto($value->id_detalle_presupuesto);
		}
		
	    $this->load->view('Front/PresupuestoEstudioInversion/DetallePresupuesto/insertar', ['fePresupuestoInv' => $fePresupuestoInv, 'listaTipoGasto' => $listaTipoGasto, 'listaUnidadMedida' => $listaUnidadMedida, 'listaFEDetallePresupuesto' => $listaFEDetallePresupuesto]);
	}
}