<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ET_Maquinaria extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ET_Maquinaria');
        $this->load->model('Model_ET_Expediente_Tecnico');
        $this->load->model('Model_ET_Ejecucion_Maquinaria');
        $this->load->library('mydompdf');
    }

    public function index()
    {
        $idExpedienteTecnico=$this->input->get('query');  
        $listaMaquinaria = $this->Model_ET_Maquinaria->MaquinariaPorIdEt($idExpedienteTecnico);
        $mes = $this->listaMeses();
        $this->load->view('layout/Ejecucion/header');
        $this->load->view('Front/Ejecucion/ETMaquinaria/index',['idExpedienteTecnico'=>$idExpedienteTecnico, 'listaMaquinaria'=>$listaMaquinaria, 'listaMes'=>$mes]);
        $this->load->view('layout/Ejecucion/footer');
    }

    public function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $data=$this->Model_ET_Maquinaria->MaquinariaPorDescripcion($this->input->post('hdIdExpedienteTecnico') ,$this->input->post('txtPlaca'));
            if($data!=null)
            {
                $msg = (['proceso'=>'Error', 'mensaje'=>'No puede agregar la misma maquinaria dos veces']);
                echo json_encode($msg);exit;
            }

            $c_data['id_et']=$this->input->post('hdIdExpedienteTecnico');
            $c_data['maquinaria']=$this->input->post('txtMaquinaria');
            $c_data['capacidad']=$this->input->post('txtCapacidad');
            $c_data['potencia']=$this->input->post('txtPotencia');
            $c_data['nro_placa_motor']=$this->input->post('txtPlaca');
            $c_data['proveedor']=$this->input->post('txtProveedor');
            $c_data['costo_hora']=$this->input->post('txtCosto');
            $c_data['tipo']=$this->input->post('selectTipo');
            $data = $this->Model_ET_Maquinaria->insertar($c_data);
            ($data>0 ? $this->session->set_flashdata('correcto', 'Los datos fuerón registrados correctamente') : $this->session->set_flashdata('error', 'Ha ocurrido un error inesperado'));            
            return redirect('/ET_Maquinaria/index?query='.$this->input->post('hdIdExpedienteTecnico'));
        }
        $idExpedienteTecnico=$this->input->get('id_et');  
        $this->load->view('Front/Ejecucion/ETMaquinaria/insertar',['idExpedienteTecnico'=>$idExpedienteTecnico, 'accion'=>'insertar']);
    }

    function eliminar()
    {
        $msg = array();
        $idMaquinaria = $this->input->post('idMaquinaria');
        $data = $this->Model_ET_Maquinaria->eliminar($idMaquinaria);
        $msg = ($data>0 ? (['proceso'=>'Correcto','mensaje'=>'el registro ha sido eliminado correctamente']) : (['proceso'=>'Error', 'mensaje'=>'Ha ocurrido un error inesperado']));
        echo json_encode($msg);exit;
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();
            $u_data['maquinaria']=$this->input->post('txtMaquinaria');
            $u_data['capacidad']=$this->input->post('txtCapacidad');
            $u_data['potencia']=$this->input->post('txtPotencia');
            $u_data['nro_placa_motor']=$this->input->post('txtPlaca');
            $u_data['proveedor']=$this->input->post('txtProveedor');
            $u_data['costo_hora']=$this->input->post('txtCosto');
            $u_data['tipo']=$this->input->post('selectTipo');
            $data = $this->Model_ET_Maquinaria->editar($u_data,$this->input->post('hdIdMaquinaria'));
            ($data>0 ? $this->session->set_flashdata('correcto', 'Los datos fuerón registrados correctamente') : $this->session->set_flashdata('error', 'Ha ocurrido un error inesperado'));            
            return redirect('/ET_Maquinaria/index?query='.$this->input->post('hdIdExpedienteTecnico'));
        }

        $idMaquinaria = $this->input->get('id_maquinaria');
        $maquinaria = $this->Model_ET_Maquinaria->MaquinariaPorId($idMaquinaria);
        $this->load->view('Front/Ejecucion/ETMaquinaria/insertar',['maquinaria'=>$maquinaria,'idExpedienteTecnico'=>$this->input->get('id_et'), 'accion'=>'editar']);
    }

    function reportePdf()
    {
        $idExpedienteTecnico = $this->input->post('hdIdExpediente');
        $formato = $this->input->post('selectFormato');
        if($_GET)
        {
            $idExpedienteTecnico = $this->input->get('query');
            $formato = $this->input->get('form');
        }
        $anio = ($this->input->post('txtAnio')!='' ? $this->input->post('txtAnio') : date('Y'));
        $mes = ($this->input->post('selectMes')!='' ? $this->input->post('selectMes') : date('m'));
        $tipo = ($this->input->post('selectTipo')!='' ? $this->input->post('selectTipo') : 'Ambos');
        $proyectoInversion=$this->Model_ET_Expediente_Tecnico->DatosExpediente($idExpedienteTecnico);
        if($formato=="fe09")
        {
            if($tipo=="Ambos")
            {
                $listadoMaquinaria=$this->Model_ET_Maquinaria->MaquinariaPorIdEt($idExpedienteTecnico);                
            }
            else
            {
                $listadoMaquinaria=$this->Model_ET_Maquinaria->MaquinariaPorTipo($idExpedienteTecnico, $tipo);
            }
            foreach ($listadoMaquinaria as $key => $value) 
            {
                $value->ejecucionanterior=$this->Model_ET_Ejecucion_Maquinaria->EjecucionPorMaquinariaMensualAnterior($value->id_maquinaria, $anio, $mes);
                $value->childEjecucion=$this->Model_ET_Ejecucion_Maquinaria->EjecucionPorMaquinariaMensual($value->id_maquinaria, $anio, $mes);
            }
            $html= $this->load->view('Front/Ejecucion/ETMaquinaria/formatofe09',['proyectoInversion'=>$proyectoInversion,'listadoMaquinaria'=>$listadoMaquinaria,'fecha'=>$mes." - ".$anio], true);
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));
        }

        if($formato=="fe10")
        {
            $listadoMaquinaria=$this->Model_ET_Maquinaria->MaquinariaPorIdEt($idExpedienteTecnico);
            foreach ($listadoMaquinaria as $key => $value) 
            {
                $value->ejecucionanterior=$this->Model_ET_Ejecucion_Maquinaria->EjecucionPorMaquinariaMensualAnterior($value->id_maquinaria, $anio, $mes);
                $value->ejecucionactual=$this->Model_ET_Ejecucion_Maquinaria->EjecucionPorMaquinariaMensualActual($value->id_maquinaria, $anio, $mes);
            }

            $html= $this->load->view('Front/Ejecucion/ETMaquinaria/formatofe10',['proyectoInversion'=>$proyectoInversion,'listadoMaquinaria'=>$listadoMaquinaria,'fecha'=>$mes." - ".$anio], true);
            $this->mydompdf->load_html($html);
            $this->mydompdf->render();
            $this->mydompdf->stream("ReporteMetrado.pdf", array("Attachment" => false));
        }
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
}
