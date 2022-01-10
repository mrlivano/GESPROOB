<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ET_Detalle_Analisis_Unitario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_ET_Detalle_Analisis_Unitario');
		$this->load->model('Model_ET_Detalle_Partida');
		$this->load->model('Model_ET_Recurso_Insumo');
		$this->load->model('Model_Unidad_Medida');
		$this->load->model('Model_ET_Insumo');
	}

	public function insertar()
	{
		if($_POST)
		{					
			$flag=0;
			$idEt=$this->input->post('hdIdEt');
			$idPartida=$this->input->post('hdIdPartida');
			$idRecurso=$this->input->post('hdIdRecurso');
			$metradoPartida=$this->input->post('hdMetrado');
			$idAnalisis=$this->input->post('idAnalisis');
			$descripcion=$this->input->post('txtInsumo');
			$cuadrilla=$this->input->post('txtCuadrilla');
			$unidad=$this->input->post('selectUnidadMedida');
			$rendimiento=$this->input->post('txtRendimiento');
			$cantidad=$this->input->post('txtCantidad');
			$precioUnitario=$this->input->post('txtPrecioUnitario');
			$desc_unidad=$this->input->post('hdUnidad');
			$cuadrilla=(($cuadrilla=='' || $cuadrilla==null) ? NULL : $cuadrilla);
			$rendimiento=(($rendimiento=='' || $rendimiento==null) ? NULL : $rendimiento);
			if($unidad!="")
			{
				$data = $this->Model_Unidad_Medida->validarUnidadMedida($unidad);
				if(count($data)>0)
				{
					$idUnidad=$data[0]->id_unidad;
				}
				else
				{
					$um_data['descripcion']=$descripcion;
					$idUnidad=$this->Model_Unidad_Medida->insertarUnidadMedida($c_data);
				}				
			}	

			if($this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisUnitarioPorIdAnalisisAndDescDetalleAnalisis($idAnalisis, $descripcion)!=null)
			{
				$msg=(['proceso'=>'Error', 'mensaje'=>'No se puede registrar el mismo analisis unitario']); 
				echo json_encode($msg);exit;
			}
			else
			{
				$this->db->trans_start();	
				$idDetalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->insertar($idAnalisis, $idUnidad, $descripcion, $cuadrilla, $cantidad, $precioUnitario, $rendimiento);
				$insumo = $this->Model_ET_Insumo->ETInsumoPorDescripcion($descripcion, $idUnidad);
				if($insumo==null)
				{
					$c_data['id_unidad']=$idUnidad;
					$c_data['desc_insumo']=$descripcion;
					$idInsumo=$this->Model_ET_Insumo->insertar($c_data);
				}
				else
				{
					$idInsumo=$insumo->id_insumo;
				}

				$detallePartida=$this->Model_ET_Detalle_Analisis_Unitario->ETDetallePartidaPorIdAnalisis($idAnalisis);

				$r_data['id_detalle_analisis_u']=$idDetalleAnalisisUnitario;
				$r_data['id_recurso']=$idRecurso;
				$r_data['id_insumo']=$idInsumo;
				$r_data['id_et']=$idEt;
				$r_data['precio_unitario']=$precioUnitario;
				$r_data['cantidad']=$cantidad*$detallePartida[0]->cantidad;
				$id_recurso_insumo=$this->Model_ET_Recurso_Insumo->insertar($r_data);
				$this->db->trans_complete();
				$msg=($id_recurso_insumo!='' && $idDetalleAnalisisUnitario!=""?(['proceso'=>'Correcto', 'mensaje'=>'El registro fue guardado correctamente']):(['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error en el registro de la inferomación']));
				echo json_encode($msg);exit;
			}	
		}
		else
		{
			$idAnalisis=$this->input->get('id_AnalisisUnitario');
			$Partida = $this->Model_ET_Detalle_Partida->partidaAnaliticoEt($idAnalisis);
			$idET = $this->input->get('id_Et');
			$listaUnidadMedida = $this->Model_Unidad_Medida->UnidadMedidad_Listar();
			$listaInsumoNivel1 = $this->Model_Unidad_Medida->listaInsumoNivel1();
			foreach ($listaInsumoNivel1 as $key => $value) 
			{
				$value->hasChild = (count($this->Model_Unidad_Medida->listaInsumoporNivel($value->CodInsumo, ($value->Nivel+1)))==0 ? false : true);
			}
			$this->load->view('Front/Ejecucion/ETAnalisisUnitario/insertardetalleanalisisunitario',['idAnalisis'=>$idAnalisis,'listaUnidadMedida'=>$listaUnidadMedida,'partida' =>$Partida, 'listaNivel1' => $listaInsumoNivel1 , 'idET'=>$idET ]);
		}		
	}

	public function eliminar()
	{
		$this->db->trans_start();

		$idDetalleAnalisisUnitario=$this->input->post('idDetalleAnalisisUnitario');

		$this->Model_ET_Detalle_Analisis_Unitario->eliminar($idDetalleAnalisisUnitario);

		$this->db->trans_complete();

		echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Detalle de análisis eliminado correctamente.']);exit;
	}
}