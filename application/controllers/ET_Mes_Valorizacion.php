<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Mes_Valorizacion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Model_ET_Mes_Valorizacion");
		$this->load->model("Model_ET_Detalle_Partida");

		$this->load->helper('FormatNumber_helper');
	}

	public function insertar()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$this->db->trans_start();

				$idDetallePartida=$this->input->post('idDetallePartida');
				$numeroMes=$this->input->post('numeroMes');
				$cantidad=$this->input->post('cantidad');
				$precio=$this->input->post('precio');

				$etMesValorizacionTemp=$this->Model_ET_Mes_Valorizacion->ETMesValorizacionPorIdDetallePartidaAndNumeroMes($idDetallePartida, $numeroMes);

				if($etMesValorizacionTemp==null)
				{
					$this->Model_ET_Mes_Valorizacion->insertar($idDetallePartida, 'NULL', $numeroMes, $cantidad, $precio);
				}
				else
				{
					$this->Model_ET_Mes_Valorizacion->editarCantidadYPrecio($etMesValorizacionTemp->id_mes_valorizacion, $cantidad, $precio);
				}

				$sumaCantidad=$this->Model_ET_Mes_Valorizacion->sumCantidadPorIdDetallePartida($idDetallePartida);
				$etDetallePartida=$this->Model_ET_Detalle_Partida->ETDetallePartida($idDetallePartida);

				$saldo=a_number_format($etDetallePartida->cantidad-$sumaCantidad, 2, '.',",",0); 

				if($sumaCantidad>$etDetallePartida->cantidad)
				{
					$this->db->trans_rollback();

					echo json_encode(['proceso' => 'Error', 'mensaje' => 'La cantidad calculada de la sumatoria total de meses no puede ser mayor al destinado en la partida.']);exit;
				}
				if($etDetallePartida->cantidad==$sumaCantidad)
				{
					$this->db->trans_complete();

					echo json_encode(['proceso' => 'Completo', 'mensaje' => 'La valorizacion fue distribuida correctamente','saldo'=>$saldo]);exit;
				}

				$this->db->trans_complete();

				echo json_encode(['proceso' => 'Correcto','saldo'=>$saldo]);exit;
			}
		}
	}
}