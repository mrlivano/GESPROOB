<?php
defined('BASEPATH') or exit('No direct script access allowed');

class migracion extends CI_Controller
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
        $this->load->model('Model_ET_Insumo');
		$this->load->model('Model_ET_Periodo_Ejecucion');
		$this->load->model('Model_Dashboard_Reporte');
		$this->load->library('mydompdf');
		$this->load->helper('FormatNumber_helper');
	}

    public function clonacion()
	{
		$idExpedienteTecnico=isset($_GET['id_et']) ? $_GET['id_et'] : null;
        $componente=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmDirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');
        foreach ($componente as $comp) 
        {            
            $meta=$this->Model_ET_Meta->ETMetaPorIdComponente($comp->id_componente);
            foreach($meta as $item)
            {
                $this->obtenerMetaAnidadaParaClonacion($item, $idExpedienteTecnico);
            }
        }

				$componenteInd=$this->Model_ET_Componente->ETComponentePorPresupuestoEstadoAdmIndirecCostoDirec($idExpedienteTecnico, 'EXPEDIENTETECNICO');
        foreach ($componenteInd as $comp) 
        {            
            $meta=$this->Model_ET_Meta->ETMetaPorIdComponente($comp->id_componente);
            foreach($meta as $item)
            {
                $this->obtenerMetaAnidadaParaClonacion($item, $idExpedienteTecnico);
            }
        }


        $this->db->trans_complete();

        echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'el Expediente paso a etapa de ejecucion satisfactoriamente']);exit;

    }

	private function obtenerMetaAnidadaParaClonacion($meta, $idExpedienteTecnico)
	{
		$temp=$this->Model_ET_Meta->ETMetaPorIdMetaPadre($meta->id_meta);

		$meta->childMeta=$temp;		

		if(count($temp)==0)
		{
			$partida=$this->Model_ET_Partida->ETPartidaDetallePartidaPorIdMeta($meta->id_meta);
			foreach ($partida as $part) 
			{
				$analisisUnitario=$this->Model_ET_Analisis_Unitario->ETAnalisisUnitarioPorIdDetalle($part->id_detalle_partida);				
				foreach($analisisUnitario as $analisis)
				{
					$detalleAnalisisUnitario=$this->Model_ET_Detalle_Analisis_Unitario->ETDetalleAnalisisPorIdAnalisis($analisis->id_analisis);
					foreach($detalleAnalisisUnitario as $detalle)
					{
                        $insumo = $this->Model_ET_Insumo->ETInsumoPorDescripcion($detalle->desc_detalle_analisis, $detalle->id_unidad);
                        if($insumo==null)
                        {
                            $c_data['id_unidad']=$detalle->id_unidad;
                            $c_data['desc_insumo']=$detalle->desc_detalle_analisis;
                            $idInsumo=$this->Model_ET_Insumo->insertar($c_data);
                        }
                        else
                        {
                            $idInsumo=$insumo->id_insumo;
                        }                        
                
						$c_insumo['id_detalle_analisis_u']=$detalle->id_detalle_analisis_u;
						$c_insumo['id_recurso']=$analisis->id_recurso;
						$c_insumo['id_insumo']=$idInsumo;
						$c_insumo['id_et']=$idExpedienteTecnico;
						$c_insumo['precio_unitario']=$detalle->precio_unitario;
                        $c_insumo['cantidad']=$detalle->cantidad*$part->cantidad;
                        $id_recurso_insumo=$this->Model_ET_Recurso_Insumo->insertar($c_insumo);
					}
				}
            }
            
            return false;
        }
        
        foreach($meta->childMeta as $key => $value)
		{
			$this->obtenerMetaAnidadaParaClonacion($value, $idExpedienteTecnico);
		}
	}
}
