<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_Actividad extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Actividad');
        $this->load->model('Model_Unidad_Medida');
        $this->load->helper('FormatNumber_helper');
    }

    function Insertar()
    {
        if($_POST)
        {
            $msg = array();

            $existe = count($this->Model_Mo_Actividad->verificarActividad($this->input->post('hdIdProducto'),$this->input->post('txtActividad')));
            if($existe!=0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Ya existe esa actividad.']);
                echo json_encode($msg);
                exit;
            }

            $sumatoriaValoracion = $this->Model_Mo_Actividad->sumarValoracion($this->input->post('hdIdProducto'));
            $valoracionRestante = 100-$sumatoriaValoracion->sumatoria;

            if($this->input->post('txtValoracionActividad')>$valoracionRestante)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'La valorizacion ingresada supera la valorización Restante. Intente con otro valor']);
                echo json_encode($msg);
                exit;
            }

            $c_data['desc_actividad'] = $this->input->post('txtActividad');
            $c_data['uni_medida'] = $this->input->post('txtUnidad');
            $c_data['fecha_inicio'] = $this->input->post('txtFechaInicio');
            $c_data['fecha_fin'] = $this->input->post('txtFechaFin');
            $c_data['meta'] = $this->input->post('txtMeta');
            $c_data['valoracion_actividad'] = $this->input->post('txtValoracionActividad')/100;
            $c_data['costo_total']=floatval(str_replace(",", "", $this->input->post('txtCosto')));
            $c_data['id_producto'] =  $this->input->post('hdIdProducto');

            $data = $this->Model_Mo_Actividad->insertar($c_data);            

            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $idPi = $this->input->get('idPi');
        $idProducto = $this->input->get('idProducto');
        $listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();

        $sumatoriaValoracion = $this->Model_Mo_Actividad->sumarValoracion($idProducto);
        $valoracionRestante = 100-$sumatoriaValoracion->sumatoria;

        $this->load->view('front/Monitoreo/Mo_Actividad/insertar',['listaUnidadMedida' => $listaUnidadMedida, 'idPi' => $idPi, 'idProducto'=>$idProducto, 'valoracionRestante'=>$valoracionRestante]); 
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();

            $existe = count($this->Model_Mo_Actividad->verificarActividadDiferente($this->input->post('hdIdProducto'),$this->input->post('hdIdActividad'),$this->input->post('txtActividad')));
            if($existe!=0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Ya existe esa actividad.']);
                echo json_encode($msg);
                exit;
            }

            $this->db->trans_begin();

            $c_data['desc_actividad'] = $this->input->post('txtActividad');
            $c_data['uni_medida'] = $this->input->post('txtUnidad');
            $c_data['fecha_inicio'] = $this->input->post('txtFechaInicio');
            $c_data['fecha_fin'] = $this->input->post('txtFechaFin');
            $c_data['meta'] = $this->input->post('txtMeta');
            $c_data['valoracion_actividad'] = $this->input->post('txtValoracionActividad')/100;

            $c_data['costo_total']=floatval(str_replace(",", "", $this->input->post('txtCosto')));

            $data = $this->Model_Mo_Actividad->editar($c_data,$this->input->post('hdIdActividad')); 

            $sumatoriaValoracion = $this->Model_Mo_Actividad->sumarValoracion($this->input->post('hdIdProducto'));
            if($sumatoriaValoracion->sumatoria>100)
            {
                $this->db->trans_rollback();
                $msg = (['proceso' => 'Error', 'mensaje' => 'Supero la valorización Restante.']);
                echo json_encode($msg);exit;
            }

            $this->db->trans_complete(); 

            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron editados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $idPi = $this->input->get('idPi');
        $actividad = $this->Model_Mo_Actividad->actividadId($this->input->get('idActividad'));
        $listaUnidadMedida=$this->Model_Unidad_Medida->UnidadMedidad_Listar();
        $this->load->view('front/Monitoreo/Mo_Actividad/editar',['listaUnidadMedida'=>$listaUnidadMedida,'idPi'=>$idPi,'actividad'=>$actividad]);
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_Mo_Actividad->eliminar($this->input->post('idActividad'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'La actividad fue eliminada']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function calcularMontoProgramado()
    {
        $msg = array();
        $actividad=$this->Model_Mo_Actividad->actividadId($this->input->post('idActividad'));
        $precioUnitario = $actividad->costo_total/$actividad->meta;
        $monto=$this->input->post('monto')*$precioUnitario;
        $msg =(['monto'=>a_number_format($monto , 2, '.',",",3)]);
        echo json_encode($msg);exit;
    }
}
