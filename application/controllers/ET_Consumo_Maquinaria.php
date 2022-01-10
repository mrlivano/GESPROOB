<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Consumo_Maquinaria extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Unidad_Medida');
        $this->load->model('Model_ET_Consumo_Maquinaria');
        $this->load->model('Model_ET_Maquinaria');
        $this->load->model('Model_ET_Expediente_Tecnico');
        $this->load->library('mydompdf');
    }

    public function index()
    {
        if($_POST)
        {
        }
        $idMaquinaria=$this->input->get('id_maquinaria');  
        $listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
        $listaConsumoMaquinaria=$this->Model_ET_Consumo_Maquinaria->listaConsumoDiario($idMaquinaria);       
        $this->load->view('Front/Ejecucion/ETConsumoMaquinaria/index',['idMaquinaria'=>$idMaquinaria,'listaUnidadMedida'=>$listaUnidadMedida,'listaConsumoMaquinaria'=>$listaConsumoMaquinaria]);
    }

    public function insertar()
    {
        if($_POST)
        {
            $c_data['id_maquinaria']=$this->input->post('hdIdMaquinaria');
            $c_data['fecha']=$this->input->post('txtFecha');
            $c_data['tipo_consumo']=$this->input->post('selectTipoConsumo');
            $c_data['descripcion']=$this->input->post('txtDescripcion');
            $c_data['id_unidad']=$this->input->post('selectUnidadMedida');
            $c_data['cantidad']=$this->input->post('txtCantidad');
            $c_data['precio_unitario']=$this->input->post('txtPrecioUnitario');

            $data = $this->Model_ET_Consumo_Maquinaria->insertar($this->security->xss_clean($c_data));

            $msg = ($data!="" ? (['proceso'=>'Correcto', 'mensaje'=>'el registro ha sigo guardado correctamente']) : (['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error inesperado']));
            echo json_encode($msg);
        }
    }

    function eliminar()
    {
        if($_POST)
        {
            $data = $this->Model_ET_Consumo_Maquinaria->eliminar($this->input->post('idConsumo'));
            $msg = ($data>0 ? (['proceso'=>'Correcto', 'mensaje'=>'el registro ha sigo guardado correctamente']) : (['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error inesperado']));
            echo json_encode($msg);
        }
    }

    function reportePdf()
    {
        $idExpediente=$this->input->post('hdIdExpediente');
        $anio = ($this->input->post('txtAnio')!='' ? $this->input->post('txtAnio') : date('Y'));
        $mes = ($this->input->post('selectMes')!='' ? $this->input->post('selectMes') : date('m'));
        $fecha = $mes." - ".$anio;
        if($_GET)
        {
            $idExpedienteTecnico = $this->input->get('query');
        }
        $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
        $listadoMaquinaria=$this->Model_ET_Maquinaria->MaquinariaPorIdEt($idExpedienteTecnico);    
        foreach ($listadoMaquinaria as $key => $value) 
        {
            $listaConsumoMaquinaria=$this->Model_ET_Consumo_Maquinaria->ListaFechaConsumo($value->id_maquinaria, $mes, $anio);
            $value->childConsumo=$listaConsumoMaquinaria;
        }
        $html= $this->load->view('Front/Ejecucion/ETConsumoMaquinaria/reportepdf',['listadoMaquinaria'=>$listadoMaquinaria,'fecha'=>$fecha, 'proyectoInversion'=>$proyectoInversion],true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->render();
        $this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));
    }
}
